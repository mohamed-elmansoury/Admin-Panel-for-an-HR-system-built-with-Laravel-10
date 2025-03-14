@extends('layouts.admin')

@section('title')
    الضبط العام للنظام
@endsection

@section('contentheader')
    قائمة الضبط
@endsection

@section('contentheaderactivelink')
    <a href="{{ route('admin.panel.edit') }}">تعديل الضبط العام</a>
@endsection

@section('contentheaderactive')
    تعديل
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title card_title_center">تحديث بيانات الضبط العام للنظام</h3>
        </div>
        <div class="card-body">
            @if (@isset($data) and !@empty($data))
                <form action="{{ route('admin.panel.update') }}" method="POST">
                    <div class="row">
                        @csrf
                        <!-- Company Name -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>اسم الشركة</label>
                                <input type="text" name="company_name" class="form-control"
                                    value="{{ old('company_name', $data['company_name']) }}">
                                @error('company_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Phones -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>هاتف الشركة</label>
                                <input type="text" name="phones" class="form-control"
                                    value="{{ old('phones', $data['phones']) }}">
                                @error('phones')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>عنوان الشركة</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address', $data['address']) }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>بريد الشركة</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $data['email']) }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- After how many minutes calculate delay -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>بعد كم دقيقة نحسب تأخير الحضور</label>
                                <input type="number" name="after_minute_calculate_delay" class="form-control"
                                    value="{{ old('after_minute_calculate_delay', $data['after_minute_calculate_delay'] * 1) }}">
                                @error('after_minute_calculate_delay')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- After how many minutes calculate early departure -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>بعد كم دقيقة نحسب انصراف مبكر</label>
                                <input type="number" name="after_minute_calculate_early_departure" class="form-control"
                                    value="{{ old('after_minute_calculate_early_departure', $data['after_minute_calculate_early_departure']*1) }}">
                                @error('after_minute_calculate_early_departure')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Other Input Fields (Similar to the Above) -->
                        <!-- After how many minutes calculate quarter day deduction -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>بعد كم دقيقة نخصم ربع يوم</label>
                                <input type="number" name="after_minute_quarterday" class="form-control"
                                    value="{{ old('after_minute_quarterday', $data['after_minute_quarterday']*1) }}">
                                @error('after_minute_quarterday')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- After how many early or late minutes deduct half day -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>بعد كم مرة تأخير أو انصراف مبكر نخصم نصف يوم</label>
                                <input type="number" name="after_time_half_deduct" class="form-control"
                                    value="{{ old('after_time_half_deduct', $data['after_time_half_deduct']*1) }}">
                                @error('after_time_half_deduct')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- After how many occurrences deduct full day -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>نخصم بعد كم مرة يوم كامل</label>
                                <input type="number" name="after_time_allday_deduct" class="form-control"
                                    value="{{ old('after_time_allday_deduct', $data['after_time_allday_deduct']*1) }}">
                                @error('after_time_allday_deduct')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-success">تحديث</button>
                        </div>
                    </div>
                </form>
            @else
                <p class="bg-danger text-center">عفوا لا توجد بيانات لعرضها</p>
            @endif
        </div>
    </div>
@endsection
