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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center"> بيانات المناسبات الرسميه
                    <a href="{{ route('Occasions.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a>
                </h3>
            </div>
            <div class="card-body">

                @if (@isset($data) and !@empty($data))
                    <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                            <th>اسم المناسبه</th>

                            <th> تاريخ البداية</th>
                            <th> تاريخ النهاية</th>
                            <th> عدد الايام </th>
                            <th> الاضافة بواسطة</th>

                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($data as $info)
                                <tr>
                                    <td> {{ $info->name }} </td>
                                    <td> {{ $info->from_date }} </td>
                                    <td> {{ $info->to_date }} </td>
                                    <td> {{ $info->days_counter }} </td>

                                   

                                    <td>{{ $info->added->name }} <br> {{ \Carbon\Carbon::parse($info->created_at)->toDateString() }}</td>
                                    </td>
                                    <td>



                                        <!-- Delete Form -->
                                        <form action="{{ route('Occasions.destroy', $info->id) }}" method="POST"
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
                @else
                    <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
                @endif

            </div>
        </div>
    </div>





@endsection
