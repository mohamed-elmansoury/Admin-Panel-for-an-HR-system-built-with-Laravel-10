@extends('layouts.admin')
@section('title')
    المناسبات
@endsection
@section('contentheader')
    قائمة الضبط
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('Occasions.index') }}"> المناسبات الرسميه </a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center"> تكويد مناسبه جديدة

                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('Occasions.store') }}" method="POST">
                    @csrf

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> اسم المناسه</label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> عدد الايام </label>
                            <input type="text" name="days_counter" id="days_counter" class="form-control"
                                value="{{ old('days_counter') }}">
                            @error('days_counter')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> تاريخ بداية </label>
                            <input type="date" name="from_date" id="from_date" class="form-control"
                                value="{{ old('from_date') }}">
                            @error('from_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> تاريخ نهاية السنة المالية</label>
                            <input type="date" name="to_date" id="to_date" class="form-control"
                                value="{{ old('to_date') }}">
                            @error('to_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button class="btn btn-sm btn-success" type="submit" >اضف المناسبه </button>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
   
@endsection
