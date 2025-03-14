@extends('layouts.admin')
@section('title')
الفروع
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('branches.index') }}">   الفروع</a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات  الفروع 
            <a href="{{ route('branches.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a>
         </h3>
      </div>
      <div class="card-body">

         @if(@isset($data) and !@empty($data) )
         <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
               <th>  كود الفرع</th>
               <th>  الاسم</th>
               <th>   العنوان</th>
               <th>   الهاتف</th>
               <th>   الايميل</th>
               <th>   حالة التفعيل</th>
               <th>  الاضافة بواسطة</th>
               <th>  التحديث بواسطة</th>
               <th></th>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td> {{ $info->id }} </td>
                  <td> {{ $info->name }} </td>
                  <td> {{ $info->address }} </td>
                  <td> {{ $info->phones }} </td>
                  <td> {{ $info->email }} </td>
                  <td @if ($info->active==1) class="bg-success" @else class="bg-danger"  @endif      > @if ($info->active==1) مفعل @else معطل @endif</td>

                  <td>{{ $info->added->name }} </td>
                  <td>
                     @if($info->updatedBy>0)
                  {{ $info->updated_by->name }} 
                  @else
                  لايوجد
                  @endif
                  </td>
                  <td>
                
                     <form action="{{ route('branches.edit', $info->id) }}" method="GET" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">تعديل</button>
                    </form>
                    
                    <!-- Delete Form -->
                    <form action="{{ route('branches.destroy', $info->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا العنصر؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                    </form>
                  
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <br>
                    <div class="clo-12 md">
                     <div>
                     {{ $data->links('pagination::bootstrap-5') }}
                  </div></div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif

      </div>
   </div>
</div>



@endsection
