<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin_panel_request;
use App\Models\Admin_panel_sitting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPanelSittingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = Admin_panel_sitting::where('com_code', $com_code)->first();

        return view('admin.panel', compact('data'));
    }

   
    
    public function edit()
    {
        $com_code = auth()->user()->com_code;
        $data = Admin_panel_sitting::select('*')->where('com_code', $com_code)->first();
    

        if (!$data) {
            return redirect()->back()->with('error', 'Record not found or access denied.');
        }

        return view('admin.editPanel', compact('data'));
    }


   
    public function update(admin_panel_request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $dataToUpdate = [
                'company_name' => $request['company_name'],
                'phones' => $request['phones'], //
                'address' => $request['address'],
                'email' => $request['email'],
                'after_minute_calculate_delay' => $request['after_minute_calculate_delay'],
                'after_minute_calculate_early_departure' => $request['after_minute_calculate_early_departure'],
                'after_minute_quarterday' => $request['after_minute_quarterday'],
                'after_time_half_deduct' => $request['after_time_half_deduct'],
                'after_time_allday_deduct' => $request['after_time_allday_deduct'],
                'monthly_vacation_balance' => $request['monthly_vacation_balance'],
                'after_days_begin_vacation' => $request['after_days_begin_vacation'],
                'first_balance_begin_vacation' => $request['first_balance_begin_vacation'],
                'sanctions_value_first_absence' => $request['sanctions_value_first_absence'],
                'sanctions_value_second_absence' => $request['sanctions_value_second_absence'],
                'sanctions_value_third_absence' => $request['sanctions_value_third_absence'],
                'sanctions_value_forth_absence' => $request['sanctions_value_forth_absence'],
                'updated_by' => auth()->user()->id,
            ];
            
          Admin_panel_sitting::where(['com_code' , $com_code])->update($dataToUpdate);
            return redirect()->route('adminSittings')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما'])->withInput();
        }
    }

   
}
