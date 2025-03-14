@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">إدارة أنواع الشفتات</h2>

    <!-- فورم الفلترة -->
    <form action="{{ URL::current() }}" method="get" class="row g-3 mb-4">
        <!-- نوع الشفت -->
        <div class="col-md-3">
            <label for="type_search" class="fw-bold">نوع الشفت</label>
            <select name="type_search" id="type_search" class="form-control">
                <option value="all" @selected(request('type_search') == 'all')>بحث بالكل</option>
                <option value="1" @selected(request('type_search') == '1')>صباحي</option>
                <option value="2" @selected(request('type_search') == '2')>مسائي</option>
            </select>
        </div>

        <!-- عدد الساعات من -->
        <div class="col-md-3">
            <label for="hour_from_range" class="fw-bold">من عدد ساعات</label>
            <input type="text" name="hour_from_range" id="hour_from_range" class="form-control"
                value="{{ request('hour_from_range') }}"
                oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
        </div>

        <!-- عدد الساعات إلى -->
        <div class="col-md-3">
            <label for="hour_to_range" class="fw-bold">إلى عدد ساعات</label>
            <input type="text" name="hour_to_range" id="hour_to_range" class="form-control"
                value="{{ request('hour_to_range') }}"
                oninput="this.value=this.value.replace(/[^0-9.]/g,'');">
        </div>

        <!-- زر البحث -->
        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-dark w-100">فلترة</button>
        </div>
    </form>

    <!-- جدول عرض البيانات -->
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>نوع الشفت</th>
                <th>يبداء من</th>
                <th>ينتهى فى</th>

                <th>عدد الساعات</th>
                <th>تاريخ الإنشاء</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $shift)
            <tr>
                <td>{{ $shift->id }}</td>
                <td>{{ $shift->type == 1 ? 'صباحي' : 'مسائي' }}</td>
                
                <td>{{ explode(':', $shift->from_time)[0] }}</td>
                <td>{{ explode(':', $shift->to_time)[0] }}</td>
                
                <td>{{ explode(':', $shift->total_hour)[2] }} ساعه</td>
                <td>{{ $shift->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('Shifts.edit', $shift->id) }}" class="btn btn-sm btn-outline-success">تعديل</a>
                    <form action="{{ route('Shifts.destroy', $shift->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">لا توجد بيانات متاحة.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- روابط التصفح بين الصفحات -->
    <div class="d-flex justify-content-center">
        {{ $data->links() }}
    </div>
</div>
@endsection
