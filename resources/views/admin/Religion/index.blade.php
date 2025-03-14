@extends('layouts.admin')
@section('title')
   الدين
@endsection
@section('contentheader')
    قائمة الضبط
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('Religion.index') }}">
        الديانه  </a>
@endsection
@section('contentheaderactive')
    عرض
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center"> نوع الديانه 
                    <a href="{{ route('Religion.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a>
                </h3>
            </div>
            <div class="card-body">

                @if (@isset($data) and !@empty($data))
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">

                            <th>  اسم الديانه   </th>
                            <th> حالة التفعيل</th>
                            <th> الاضافة بواسطة</th>
                            <th>  </th>
                           
                            

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

                                    <td>{{ $info->added->name }} <br>
                                        {{ \Carbon\Carbon::parse($info->created_at)->toDateString() }}</td>


                                    <td>



                                        <!-- Delete Form -->
                                        <form action="{{ route('Religion.destroy', $info->id) }}" method="POST"
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
