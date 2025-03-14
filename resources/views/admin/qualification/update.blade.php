@extends('layouts.admin')
@section('title')
المؤهلات
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Qualification.index') }}">    المؤهلات</a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  تعديل بيانات المؤهل
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('Qualification.update',$data['id']) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
               <div class="col-md-12">
                  <div class="form-group">
                     <label>   اسم الوظيفه</label>
                     <input type="text" name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}" >
                     @error('name')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
            </div>
            
            
            
            <div class="col-md-12">
               <div class="form-group">
                  <label> حالة التفعيل</label>
                  <select name="active" id="active" class="form-control">
                  <option {{ old('active',$data['active'])==1 ? 'selected':''  }}  value="1">مفعل</option>
                  <option {{ old('active',$data['active'])==0 ? 'selected':''  }}   value="0">معطل</option>
                  </select>
                  @error('active')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" >تعديل المؤهل </button>
                  <a href="{{ route('Qualification.index') }}" class="btn btn-danger btn-sm">الغاء</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
