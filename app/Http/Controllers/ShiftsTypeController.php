<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShiftRequest;
use App\Models\Shifts_type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ShiftsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $com_code = auth()->user()->com_code;

    // جلب متغيرات البحث من الطلب
    $search = $request->input('search'); // البحث عن طريق النص
    $type = $request->input('type_search'); // البحث حسب نوع الشفت
    $hour_from = $request->input('hour_from_range'); // عدد الساعات من
    $hour_to = $request->input('hour_to_range'); // عدد الساعات إلى

    // تنفيذ الاستعلام مع البحث والتصفية
    $data = Shifts_type::where('com_code', $com_code)
        ->when($search, function ($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%");
        })
        ->when($type && $type !== 'all', function ($query) use ($type) {
            $query->where('type', $type);
        })
        ->when($hour_from, function ($query) use ($hour_from) {
            $query->where('total_hour', '>=', $hour_from);
        })
        ->when($hour_to, function ($query) use ($hour_to) {
            $query->where('total_hour', '<=', $hour_to);
        })
        ->orderBy('id', 'DESC')
        ->paginate(2)
        ->withQueryString(); // للحفاظ على القيم في روابط التصفح

    return view('admin.Shifts_type.index', ['data' => $data]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Shifts_type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShiftRequest $request)
    {
        $data = $request->all();
        $data['added_by'] = auth::user()->id;
        $data['com_code'] = auth::user()->com_code;
        $shift = Shifts_type::create($data);
        return Redirect::route('Shifts.index')
            ->with('success', 'تم الاضافه بنجاح ');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Shifts_type(), array("*"), array("id" => $id, 'com_code' => $com_code));
        if (!empty($data)) {
            $data->delete();
            return redirect()->route('Shifts.index')->with(['success' => 'deleted succcefuly']);
        } else {
            return redirect()->route('Shifts.index')->with(['error' => 'sorry cant deleted']);
        }
    }
    public function ajax_search(Request $request)
{
    if ($request->ajax()) {
        $type_search = $request->type_search;
        $hour_from_range = $request->hour_from_range;
        $hour_to_range = $request->hour_to_range;

        // Build the query
        $query = Shifts_type::query();

        // Conditionally add the search for type
        $query->when($type_search != 'all', function ($q) use ($type_search) {
            $q->where('type', '=', $type_search);
        });

        // Conditionally add the search for the hour from range
        $query->when($hour_from_range != '', function ($q) use ($hour_from_range) {
            $q->where('total_hour', '>=', $hour_from_range);
        });

        // Conditionally add the search for the hour to range
        $query->when($hour_to_range != '', function ($q) use ($hour_to_range) {
            $q->where('total_hour', '<=', $hour_to_range);
        });

        // Execute the query with pagination
        $data = $query->orderBy('id', 'DESC')->paginate(PC);

        // Return the view with data
        return view('admin.Shifts_type.ajax_search', ['data' => $data]);
    }
}
}
