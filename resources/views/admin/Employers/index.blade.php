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
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center"> بيانات الموظفين
                    <a href="{{ route('Employers.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a>
                </h3>
            </div>
            <div class="card-body">

                @if ($employers->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>

                                <th>Branch</th>

                                <th>Nationality</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employers as $employer)
                                <tr>
                                    <td>{{ $employer->name }}</td>
                                    <td>{{ $employer->email }}</td>
                                    <td>{{ $employer->phone }}</td>

                                    <td>{{ $employer->branch->name ?? 'N/A' }}</td>
                                    
                                    <td>{{ $employer->nationality->name ?? 'N/A' }}</td>
                                    <td>
                                        {{-- Action buttons for view, edit, and delete --}}
                                        <a href="{{ route('Employers.show', $employer->id) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('Employers.edit', $employer->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('Employers.destroy', $employer->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this employer?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination links --}}
                    {{ $employers->links('pagination::bootstrap-5') }}
                @else
                    <p>لا وجد بيانات للموظفين</p>
                @endif

            </div>
        </div>
    </div>



@endsection
