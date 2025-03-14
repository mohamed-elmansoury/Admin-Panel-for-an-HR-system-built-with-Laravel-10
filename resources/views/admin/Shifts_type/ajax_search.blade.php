@if(isset($data) && !empty($data) && count($data) > 0)
    <table id="example2" class="table table-bordered table-hover">
        <thead class="custom_thead">
            <th>نوع الشفت</th>
            <th>يبدأ من الساعة</th>
            <th>ينتهي الساعة</th>
            <th>عدد الساعات</th>
            <th>حالة التفعيل</th>
            <th>الاضافة بواسطة</th>
            <th>التحديث بواسطة</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($data as $info)
                <tr>
                    <td>{{ $info->type == 1 ? 'صباحي' : 'مسائي' }}</td>
                    <td>
                        @php
                            $fromTime = date("h:i", strtotime($info->from_time));
                            $fromTimePeriod = date("A", strtotime($info->from_time)) == 'AM' ? 'صباحا' : 'مساء';
                        @endphp
                        {{ $fromTime }} {{ $fromTimePeriod }}
                    </td>
                    <td>
                        @php
                            $toTime = date("h:i", strtotime($info->to_time));
                            $toTimePeriod = date("A", strtotime($info->to_time)) == 'AM' ? 'صباحا' : 'مساء';
                        @endphp
                        {{ $toTime }} {{ $toTimePeriod }}
                    </td>
                    <td>
                        @php
                            $totalHour = explode(':', $info->total_hour ?? '00:00:00')[2];
                        @endphp
                        {{ $totalHour }}
                    </td>
                    <td class="{{ $info->active == 1 ? 'bg-success' : 'bg-danger' }}">
                        {{ $info->active == 1 ? 'مفعل' : 'معطل' }}
                    </td>
                    <td>
                        @php
                            $createdDate = (new DateTime($info->created_at))->format("Y-m-d h:i A");
                            $createdPeriod = date("A", strtotime($createdDate)) == 'AM' ? 'صباحا' : 'مساء';
                        @endphp
                        {{ $createdDate }} {{ $createdPeriod }}<br>{{ Auth::user()->name }}
                    </td>
                    <td>
                        @if($info->updated_by > 0)
                            @php
                                $updatedDate = (new DateTime($info->updated_at))->format("Y-m-d h:i A");
                                $updatedPeriod = date("A", strtotime($updatedDate)) == 'AM' ? 'صباحا' : 'مساء';
                            @endphp
                            {{ $updatedDate }} {{ $updatedPeriod }}<br>{{ $info->updatedby->name ?? 'غير موجود' }}
                        @else
                            لايوجد
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('ShiftsTypes.edit', $info->id) }}" class="btn btn-success btn-sm">تعديل</a>
                        <form action="{{ route('ShiftsTypes.destroy', $info->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn are_you_shur btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <div class="col-md-12 text-center" id="ajax_pagination_in_search">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
@else
    <p class="bg-danger text-center">عفوا لاتوجد بيانات لعرضها</p>
@endif