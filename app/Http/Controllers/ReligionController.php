<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReligionRequest;
use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ReligionController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Religion(), array('*'), array('com_code' => $com_code), 'id', "DESC", 2 );
        return view('admin.Religion.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Religion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReligionRequest $request)
    {
        $com_code = auth()->user()->com_code;
        $date = get_cols_where_row(
            new Religion(),
            array("id"),
            array("com_code" => $com_code, 'name' => $request->name)
        );

        if (empty($date)) {
            $data = $request->all();
        $data['added_by'] = auth()->user()->id;
        $data['com_code'] = auth()->user()->com_code;
        $department = Religion::create($data);
        return Redirect::route('Religion.index')
            ->with('success', 'تم الاضافه بنجاح ');
        }

        return redirect()->route('Religion.index')->with(['error' => 'البيانات موجوده مسبقا']);


        
    }



    public function destroy($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Religion(), array("*"), array("id" => $id, 'com_code' => $com_code));
        if (!empty($data)) {
            $data->delete();
            return redirect()->route('Religion.index')->with(['success' => 'تم حذف البيانات ']);
        } else {
            return redirect()->route('Religion.index')->with(['error' => 'sorry cant deleted']);
        }
    }
}
