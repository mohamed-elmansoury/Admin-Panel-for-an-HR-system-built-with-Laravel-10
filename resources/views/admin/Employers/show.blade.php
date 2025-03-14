@extends('layouts.admin')
@section('title')
    الموظفين
@endsection
@section('contentheader')
    قائمة الضبط
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('Employers.index') }}">
        الموظين </a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3>{{ $employer->name }}</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>حاله العمل:</strong>
                                {{ $employer->resignation->name ?? 'على قوه العمل' }}</li>
                            <li class="list-group-item"><strong>الديانه:</strong> {{ $employer->religion->name }}</li>
                            <li class="list-group-item"><strong>المؤهل:</strong> {{ $employer->qualification->name }}</li>

                            <li class="list-group-item"><strong>الجنسيه:</strong> {{ $employer->nationality->name }}</li>
                            <li class="list-group-item"><strong>الفرع:</strong> {{ $employer->branch->name }}</li>
                            <li class="list-group-item"><strong>المدير :</strong> {{ $employer->admin->name }}</li>
                            {{-- <img src="{{ Storage::url($employer->photo) }}" alt="Employee Photo">
                            <a href="{{ Storage::url($employer->remuse) }}" target="_blank">تحميل الملف</a> --}}
                            <img src="{{ asset('storage/' . $employer->photo) }}" alt="Employer Photo">

                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('Employers.index') }}" class="btn btn-secondary">Back to Employers</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
