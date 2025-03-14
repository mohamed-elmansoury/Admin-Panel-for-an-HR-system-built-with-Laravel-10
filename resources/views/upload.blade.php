@extends('layouts.admin')
@section('title')
    المناسبات الرسميه
@endsection
@section('contentheader')
    قائمة الضبط
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('Occasions.index') }}"> المناسبات الرسميه</a>
@endsection
@section('contentheaderlink')
    عرض
@endsection
@section('content')
<form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="photo">
    <button type="submit">Upload</button>
</form>





@endsection
