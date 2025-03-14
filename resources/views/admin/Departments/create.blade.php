@extends('layouts.admin')
@section('title')
    الاداره
@endsection
@section('contentheader')
    قائمة الضبط
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('Departments.index') }}"> الاداره</a>
@endsection
@section('contentheaderactive')
    اضافة
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center"> اضافة اداره جديد
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('Departments.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> اسم الاداره</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> ملاحظات </label>
                            <input type="text" name="notes" id="notes" class="form-control"
                                value="{{ old('notes') }}">
                            @error('notes')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label> هاتف الفرع</label>
                            <input type="text" name="phone" id="phone" class="form-control"
                                value="{{ old('phone') }}">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label> حالة التفعيل</label>
                            <select name="active" id="active" class="form-control">
                                <option selected value="1">مفعل</option>
                                <option value="0">معطل</option>
                            </select>
                            @error('active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button class="btn btn-sm btn-success" type="submit" name="submit">اضف الفرع </button>
                            <a href="{{ route('Departments.index') }}" class="btn btn-danger btn-sm">الغاء</a>
                        </div>
                    </div>

                </form>
            </div>


        </div>
    </div>
@endsection
