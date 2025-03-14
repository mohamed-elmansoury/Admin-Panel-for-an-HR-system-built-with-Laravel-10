<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentsRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Department(), array("*"), array("com_code" => $com_code), 'id', 'DESC', PC);
        return view('admin.Departments.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentsRequest $request)
    {
        $com_code = auth()->user()->com_code;
        $date = get_cols_where_row(new Department(), array("id"), array("com_code" => $com_code, 'name' => $request->name));
        if (!empty($date)) {
            return redirect()->route('Departments.index')->with(['success' => 'البيانات موجوده مسبقا']);
        }

        $data = $request->all();
        $data['added_by'] = auth()->user()->name;
        $data['com_code'] = auth()->user()->com_code;
        $department = Department::create($data);
        return Redirect::route('Departments.index')
            ->with('success', 'تم الاضافه بنجاح ');
    }


    public function edit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Department(), array("*"), array("com_code" => $com_code, 'id' => $id));
        if (!empty($data)) {
            return view('admin.Departments.update',['data' => $data]);
        }
        return redirect()->route('Departments.index')->with(['success' => 'البيانات موجوده مسبقا']);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $com_code = auth()->user()->com_code;

        // Check if the name already exists for the given com_code, excluding the current record
        $existingRecord = Department::where('com_code', $com_code)
            ->where('name', $request->name)
            ->where('id', '!=', $id)
            ->first();

        if ($existingRecord) {
            return redirect()->route('Departments.index')->with(['success' => 'البيانات موجوده مسبقا']);
        }

        // Fetch the current record
        $department = Department::findOrFail($id);

        // Update the record with new data
        $data = $request->all();
        $data['updated_by'] = auth()->user()->name;
        $data['com_code'] = auth()->user()->com_code;

        $department->update($data);

        return redirect()->route('Departments.index')->with('success', 'تم التحديث بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Department(), array("*"), array("id" => $id, 'com_code' => $com_code));
        if (!empty($data)) {
            $data->delete();
            return redirect()->route('Departments.index')->with(['success' => 'تم حذف البيانات ']);
        } else {
            return redirect()->route('Departments.index')->with(['error' => 'sorry cant deleted']);
        }
    }
}
