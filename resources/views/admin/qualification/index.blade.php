@extends('layouts.admin')
@section('title')
    المؤهلات
@endsection
@section('contentheader')
    قائمة الضبط
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('Qualification.index') }}">
        المؤهلات </a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center"> بيانات المؤهلات
                    <a href="{{ route('Qualification.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a>
                </h3>
            </div>
            <div class="card-body">

                @if (@isset($data) and !@empty($data))
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">

                            <th> اسم المؤهل</th>
                            <th> حالة التفعيل</th>
                            <th> الاضافة بواسطة</th>
                            <th> التحديث بواسطة</th>

                        </thead>
                        <tbody>
                            @foreach ($data as $info)
                                <tr>

                                    <td> {{ $info->name }} </td>


                                    <td @if ($info->active == 1) class="bg-success" @else class="bg-danger" @endif>
                                        @if ($info->active == 1)
                                            مفعل
                                        @else
                                            معطل
                                        @endif
                                    </td>

                                    <td>{{ $info->added->name }} <br> {{ \Carbon\Carbon::parse($info->created_at)->toDateString() }}</td>

                                    <td>
                                        @if ($info->updated_by > 0)
                                            {{ $info->updatedby->name }} <br> {{ \Carbon\Carbon::parse($info->updated_at)->toDateString() }}
                                        @else
                                            لايوجد
                                        @endif
                                    </td>

                                    <td>

                                        <form action="{{ route('Qualification.edit', $info->id) }}" method="GET"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">تعديل</button>
                                        </form>

                                        <!-- Delete Form -->
                                        <form action="{{ route('Qualification.destroy', $info->id) }}" method="POST"
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
