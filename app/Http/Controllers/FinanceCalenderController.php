<?php

namespace App\Http\Controllers;

use App\Http\Requests\{Finance_calender_request,updatefinance,};

use App\Models\{Months, Finance_calender, Finance_cln_periods};
use DateInterval;
use DatePeriod;
use DateTime;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpParser\Node\Stmt\TryCatch;

class FinanceCalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Finance_calender::orderBy('FINANCE_YR', 'DESC')->get();
        $CheckDataOpenCounter = Finance_calender::where(['is_open' => 1])->count();

        //$data=Finance_calender::select('*')->orderby('FINANCE_YR','DESC');
        return view('admin.Finance_calender.index', compact('data', 'CheckDataOpenCounter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Finance_calender.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Finance_calender_request $request)
    {
        try {
            DB::beginTransaction();
            $dataToInsert['FINANCE_YR'] = $request->FINANCE_YR;
            $dataToInsert['FINANCE_YR_DESC'] = $request->FINANCE_YR_DESC;
            $dataToInsert['start_date'] = $request->start_date;
            $dataToInsert['end_date'] = $request->end_date;
            $dataToInsert['added_by'] = auth()->user()->id;
            $dataToInsert['com_code'] = auth()->user()->com_code;
            $flag = Finance_calender::insert($dataToInsert);
            if ($flag) {

                $dataParent = Finance_calender::select("id")->where($dataToInsert)->first();
                $startDate = new DateTime($request->start_date);
                $endDate = new DateTime($request->end_date);
                $dareInterval = new DateInterval('P1M');
                $DatePeriod = new DatePeriod($startDate, $dareInterval, $endDate);

                foreach ($DatePeriod as $date) {
                    $dataMonth['finance_calenders_id'] = $dataParent['id'];
                    $Montname_en = $date->format('F');
                    $dataParentMonth = Months::select("id")->where(['name_en' => $Montname_en])->first();
                    $dataMonth['MONTH_ID'] = $dataParentMonth['id'];
                    $dataMonth['FINANCE_YR'] = $dataToInsert['FINANCE_YR'];
                    $dataMonth['START_DATE_M'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                    $dataMonth['END_DATE_M'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                    $dataMonth['year_and_month'] = date('Y-m', strtotime($date->format('Y-m-d')));
                    $datediff = strtotime($dataMonth['END_DATE_M']) - strtotime($dataMonth['START_DATE_M']);
                    $dataMonth['number_of_days'] = round($datediff / (60 * 60 * 24)) + 1;
                    $dataMonth['com_code'] = auth()->user()->com_code;
                    $dataMonth['updated_at'] = date("Y-m-d H:i:s");
                    $dataMonth['created_at'] = date("Y-m-d H:i:s");
                    $dataMonth['added_by'] = auth()->user()->id;
                    $dataMonth['updated'] = auth()->user()->id;
                    $dataMonth['start_date_for_pasma'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                    $dataMonth['end_date_for_pasma'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                    Finance_cln_periods::insert($dataMonth);
                }
            }
            DB::commit();
            return redirect()->route('finance_calender.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطا ' . $ex->getMessage()])->withInput();
        }
    }


    public function edit($id)
    {
        $data = Finance_calender::select("*")->where(['id' => $id])->first();
        if (empty($data)) {
            return redirect()->back()->with(['error' => ' عفوا حدث خطأ ']);
        }
        if ($data['is_open'] != 0) {
            return redirect()->back()->with(['error' => ' عفوا لايمكن تعديل السنة المالية في هذه الحالة']);
        }
        return view('admin.Finance_calender.update', ['data' => $data]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(updatefinance $request, $id)
    {
        try {
            $data = Finance_calender::select("*")->where(['id' => $id])->first();
            if (empty($data)) {
                return redirect()->back()->with(['error' => ' عفوا حدث خطأ ']);
            }
            if ($data['is_open'] != 0) {
                return redirect()->back()->with(['error' => ' عفوا لايمكن تعديل السنة المالية في هذه الحالة'])->withInput();
            }
            $validator = Validator::make($request->all(), [
                'FINANCE_YR' => ['required', Rule::unique('finance_calenders')->ignore($id)],
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with(['error' => ' عفوا اسم السنة المالية مسجل من قبل'])->withInput();
            }
            DB::beginTransaction();
            $dataToUpdate['FINANCE_YR'] = $request->FINANCE_YR;
            $dataToUpdate['FINANCE_YR_DESC'] = $request->FINANCE_YR_DESC;
            $dataToUpdate['start_date'] = $request->start_date;
            $dataToUpdate['end_date'] = $request->end_date;
            $dataToUpdate['updated_by'] = auth()->user()->id;
            $falg = Finance_calender::where(['id' => $id])->update($dataToUpdate);
            if ($falg) {
                if ($data['start_date'] != $request->start_date or $data['end_date'] != $request->end_date) {
                    $flagDelete = Finance_cln_periods::where(['finance_calenders_id' => $id])->delete();
                    if ($flagDelete) {
                        $startDate = new DateTime($request->start_date);
                        $endDate = new DateTime($request->end_date);
                        $dareInterval = new DateInterval('P1M');
                        $datePerioud = new DatePeriod($startDate, $dareInterval, $endDate);
                        foreach ($datePerioud as $date) {
                            $dataMonth['finance_calenders_id'] = $id;
                            $Montname_en = $date->format('F');
                            $dataParentMonth = Months::select("id")->where(['name_en' => $Montname_en])->first();
                            $dataMonth['MONTH_ID'] = $dataParentMonth['id'];
                            $dataMonth['FINANCE_YR'] = $dataToUpdate['FINANCE_YR'];
                            $dataMonth['START_DATE_M'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                            $dataMonth['END_DATE_M'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                            $dataMonth['year_and_month'] = date('Y-m', strtotime($date->format('Y-m-d')));
                            $datediff = strtotime($dataMonth['END_DATE_M']) - strtotime($dataMonth['START_DATE_M']);
                            $dataMonth['number_of_days'] = round($datediff / (60 * 60 * 24)) + 1;
                            $dataMonth['com_code'] = auth()->user()->com_code;
                            $dataMonth['updated_at'] = date("Y-m-d H:i:s");
                            $dataMonth['created_at'] = date("Y-m-d H:i:s");
                            $dataMonth['added_by'] = auth()->user()->id;
                            $dataMonth['updated_by'] = auth()->user()->id;
                            $dataMonth['start_date_for_pasma'] = date('Y-m-01', strtotime($date->format('Y-m-d')));
                            $dataMonth['end_date_for_pasma'] = date('Y-m-t', strtotime($date->format('Y-m-d')));
                            Finance_cln_periods::insert($dataMonth);
                        }
                    }
                }
            }
            DB::commit();
            return    redirect()->route('finance_calender.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return   redirect()->back()->with(['error' => 'عفو حدث خطأ ما ' . $ex->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $data = Finance_calender::findOrFail($id);

            if ($data->is_open == 1) {
                return redirect()->back()->with(['error' => 'عفوا لايمكن حذف سنة مالية مفتوحة']);
            }

            $data->delete();

            return redirect()->route('finance_calender.index')->with(['success' => 'تم حذف البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ: ' . $ex->getMessage()]);
        }
    }

    // function show_year_monthes(Request $request)
    // {
    //     if ($request->ajax()) {
    //         // استخدام التخزين المؤقت إذا كان الاستعلام يتكرر بنفس القيم

    //         $cacheKey = 'finance_cln_periods_' . $request->id;

    //         // جلب البيانات من الكاش إذا كانت موجودة أو تنفيذ الاستعلام إذا لم تكن موجودة

    //         $finance_cln_periods = Cache::remember($cacheKey, 60 * 60, function () use ($request) {
    //             return Finance_cln_periods::select('id', 'MONTH_ID', 'FINANCE_YR', 'START_DATE_M', 'END_DATE_M', 'year_and_month', 'number_of_days')
    //                 ->where('finance_calenders_id', $request->id)
    //                 ->get();
    //         });

    //         // إعادة عرض البيانات
    //         return view('admin.Finance_calender.show_year_monthes', ['finance_cln_periods' => $finance_cln_periods]);
    //     }
    // }

    function show_year_monthes(Request $request)
    {
        if ($request->ajax()) {
            $finance_cln_periods = Finance_cln_periods::select("*")->where(['finance_calenders_id' => $request->id])->get();
            return view("admin.Finance_calender.show_year_monthes", compact('finance_cln_periods'));
        }
    }

    public function do_open($id)
    {
        try {
            $data = Finance_calender::select("*")->where(['id' => $id])->first();
            if (empty($data)) {
                return redirect()->back()->with(['error' => ' عفوا حدث خطأ ']);
            }
            if ($data['is_open'] != 0) {
                return redirect()->back()->with(['error' => ' عفوا لايمكن فتح السنة المالية في هذه الحالة']);
            }
            $CheckDataOpenCounter = Finance_calender::where(['is_open' => 1])->count();
            if ($CheckDataOpenCounter > 0) {
                return redirect()->back()->with(['error' => '   عفوا هناك بالفعل سنة مالية مازالت مفتوحة ']);
            }
            $dataToUpdate['is_open'] = 1;
            $dataToUpdate['updated_by'] = auth()->user()->id;
            $flag = Finance_calender::where(['id' => $id])->update($dataToUpdate);
            return redirect()->route('finance_calender.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => ' عفوا حدث خطأ '] . $ex->getMessage());
        }
    }
}
