<?php

namespace App\Http\Controllers;

use App\Http\Requests\branchrequest;
use App\Models\Branche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrancheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $com_code = auth()->user()->com_code;

        $data = get_cols_where_p(new Branche(), array('*'), array("com_code" => $com_code), 'id', 'DESC', PC);
        return view('admin.branches.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(branchrequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $checkExsists = get_cols_where_row(new Branche(), array("id"), array("com_code" => $com_code, 'name' => $request->name));
            if (!empty($checkExsists)) {
                return redirect()->back()->with(['error' => 'عفوا اسم الفرع مسجل من قبل !'])->withInput();
            }
            DB::beginTransaction();
            $dataToInsert['name'] = $request->name;
            $dataToInsert['address'] = $request->address;
            $dataToInsert['phones'] = $request->phones;
            $dataToInsert['email'] = $request->email;
            $dataToInsert['addedBy'] = auth()->user()->id;
            $dataToInsert['com_code'] = $com_code;
            insert(new Branche(), $dataToInsert);
            DB::commit();
            return redirect()->route('branches.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }



    public function edit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Branche(), array("*"), array("id" => $id, 'com_code' => $com_code));
        if (!empty($data)) {
            return view('admin.branches.update', ['data' => $data]);
        } else {
            return redirect()->route('branches.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(branchrequest $request, $id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Branche(), array("*"),array("id" => $id, 'com_code' => $com_code));
        if (!empty($data)) {
            $data->update([
                'name' => $request->name,
                'phones' => $request->phones,
                'email' => $request->email,
                'address' => $request->address,
                'active' => $request->active,
                'updatedBy' =>auth()->user()->id,
            ]);
            return redirect()->route('branches.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } else {
            return redirect()->route('branches.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Branche(), array("*"),array("id" => $id, 'com_code' => $com_code));
        if(!empty($data)){
            $data->delete();
            return redirect()->route('branches.index')->with(['success'=>'deleted succcefuly'] );

        }else{
            return redirect()->route('branches.index')->with(['error'=>'sorry cant deleted'] );

        }
    }
}
