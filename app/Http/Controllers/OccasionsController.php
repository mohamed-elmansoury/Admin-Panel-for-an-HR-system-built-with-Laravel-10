<?php

namespace App\Http\Controllers;

use App\Http\Requests\OccasionRequest;
use App\Models\Occasions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OccasionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Occasions(), array('*'), array('com_code' => $com_code), 'id', "DESC", PC);
        return view('admin.Occasion.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Occasion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OccasionRequest $request)
    {
        $com_code = auth()->user()->com_code;
        $date = get_cols_where_row(
            new Occasions(),
            array("id"),
            array("com_code" => $com_code, 'name' => $request->name)
        );

        if (empty($date)) {
            $data = $request->all();
        $data['added_by'] = auth()->user()->id;
        $data['com_code'] = auth()->user()->com_code;
        $department = Occasions::create($data);
        return Redirect::route('Occasions.index')
            ->with('success', 'تم الاضافه بنجاح ');
        }

        return redirect()->route('Occasions.index')->with(['error' => 'البيانات موجوده مسبقا']);


        
    }



    public function destroy($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Occasions(), array("*"), array("id" => $id, 'com_code' => $com_code));
        if (!empty($data)) {
            $data->delete();
            return redirect()->route('Occasions.index')->with(['success' => 'تم حذف البيانات ']);
        } else {
            return redirect()->route('Occasions.index')->with(['error' => 'sorry cant deleted']);
        }
    }
}
