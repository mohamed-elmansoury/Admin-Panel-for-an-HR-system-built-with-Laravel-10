@extends('layouts.admin')
@section('title')
    الادرات
@endsection
@section('contentheader')
    قائمة الضبط
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('Departments.index') }}">
        ادرات الموظفين</a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center"> بيانات الاداره
                    <a href="{{ route('Departments.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a>
                </h3>
            </div>
            <div class="card-body">

                @if (@isset($data) and !@empty($data))
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">

                            <th> الاسم</th>

                            <th> الهاتف</th>

                            <th> حالة التفعيل</th>
                            <th> الاضافة بواسطة</th>
                            <th> التحديث بواسطة</th>
                            <th>ملاحظات</th>
                        </thead>
                        <tbody>
                            @foreach ($data as $info)
                                <tr>

                                    <td> {{ $info->name }} </td>

                                    <td> {{ $info->phone }} </td>

                                    <td @if ($info->active == 1) class="bg-success" @else class="bg-danger" @endif>
                                        @if ($info->active == 1)
                                            مفعل
                                        @else
                                            معطل
                                        @endif
                                    </td>

                                    <td>{{ $info->added_by }} </td>
                                    
                                    <td>
                                        @if ($info->updated_by > 0)
                                            {{ $info->updated_by }}
                                        @else
                                            لايوجد
                                        @endif
                                    </td>
                                    <td>{{ $info->notes }} </td>
                                    <td>

                                        <form action="{{ route('Departments.edit', $info->id) }}" method="GET"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">تعديل</button>
                                        </form>

                                        <!-- Delete Form -->
                                        <form action="{{ route('Departments.destroy', $info->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا العنصر؟');">
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
                        </div>
                    </div>
                @else
                    <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
                @endif

            </div>
        </div>
    </div>



@endsection
