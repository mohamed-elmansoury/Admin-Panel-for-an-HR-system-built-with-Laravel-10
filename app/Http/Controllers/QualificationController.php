<?php

namespace App\Http\Controllers;

use App\Http\Requests\QualificationRequest;
use App\Models\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Qualification(), array('*'), array('com_code' => $com_code), 'id', "DESC", PC);
        return view('admin.qualification.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.qualification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QualificationRequest $request)
    {
        $com_code = auth()->user()->com_code;
        $date = get_cols_where_row(
            new Qualification(),
            array("id"),
            array("com_code" => $com_code, 'name' => $request->name)
        );

        if (empty($date)) {
            $data = $request->all();
        $data['added_by'] = auth()->user()->id;
        $data['com_code'] = auth()->user()->com_code;
        $department = Qualification::create($data);
        return Redirect::route('Qualification.index')
            ->with('success', 'تم الاضافه بنجاح ');
        }

        return redirect()->route('Qualification.index')->with(['error' => 'البيانات موجوده مسبقا']);


        
    }

    public function edit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Qualification(), array("*"),
         array("com_code" => $com_code, 'id' => $id));
       
         if (!empty($data)) {

            return view('admin.qualification.update', ['data' => $data]);
        }
        return redirect()->route('Qualification.index')->with(['success' => 'البيانات موجوده مسبقا']);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QualificationRequest $request ,$id)
    {
        $com_code = auth()->user()->com_code;

        // Check if the name already exists for the given com_code, excluding the current record
        $existingRecord = Qualification::where('com_code', $com_code)
            ->where('name', $request->name)
            ->where('id', '!=', $id)
            ->first();

        if ($existingRecord) {
            return redirect()->route('Qualification.index')->with(['error' => 'البيانات موجوده مسبقا']);
        }

        // Fetch the current record
        $department = Qualification::findOrFail($id);

        // Update the record with new data
        $data = $request->all();
        $data['updated_by'] = auth()->user()->id;
        $data['com_code'] = auth()->user()->com_code;

        $department->update($data);

        return redirect()->route('Qualification.index')->with('success', 'تم التحديث بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Qualification(), array("*"), array("id" => $id, 'com_code' => $com_code));
        if (!empty($data)) {
            $data->delete();
            return redirect()->route('Qualification.index')->with(['success' => 'تم حذف البيانات ']);
        } else {
            return redirect()->route('Qualification.index')->with(['error' => 'sorry cant deleted']);
        }
    }
}
