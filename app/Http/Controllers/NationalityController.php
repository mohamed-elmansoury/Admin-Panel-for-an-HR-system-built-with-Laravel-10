<?php

namespace App\Http\Controllers;

use App\Http\Requests\NationnaltyRequest;
use App\Models\Nationality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class NationalityController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Nationality(), array('*'), array('com_code' => $com_code), 'id', "DESC", 2 );
        return view('admin.Nationality.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Nationality.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NationnaltyRequest $request)
    {
        $com_code = auth()->user()->com_code;
        $date = get_cols_where_row(
            new Nationality(),
            array("id"),
            array("com_code" => $com_code, 'name' => $request->name)
        );

        if (empty($date)) {
            $data = $request->all();
        $data['added_by'] = auth()->user()->id;
        $data['com_code'] = auth()->user()->com_code;
        $department = Nationality::create($data);
        return Redirect::route('Nationality.index')
            ->with('success', 'تم الاضافه بنجاح ');
        }

        return redirect()->route('Nationality.index')->with(['error' => 'البيانات موجوده مسبقا']);


        
    }



    public function destroy($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Nationality(), array("*"), array("id" => $id, 'com_code' => $com_code));
        if (!empty($data)) {
            $data->delete();
            return redirect()->route('Nationality.index')->with(['success' => 'تم حذف البيانات ']);
        } else {
            return redirect()->route('Nationality.index')->with(['error' => 'sorry cant deleted']);
        }
    }
}
