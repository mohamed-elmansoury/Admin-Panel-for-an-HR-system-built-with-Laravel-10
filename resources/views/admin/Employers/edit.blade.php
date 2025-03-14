@extends('layouts.admin')
@section('title')
    تعديل موظف
@endsection
@section('contentheader')
    قائمة الضبط
@endsection
@section('contentheaderactivelink')
    <a href="{{ route('Employers.index') }}">
        الموظفين
    </a>
@endsection
@section('contentheaderactive')
    تعديل
@endsection
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title card_title_center"> تعديل بيانات موظف
                </h3>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('Employers.update', $employer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $employer->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $employer->email) }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                            name="phone" value="{{ old('phone', $employer->phone) }}" required>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Photo -->
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" class="form-control-file @error('photo') is-invalid @enderror" id="photo"
                            name="photo">
                        @if ($employer->photo)
                            <p>Current Photo: <a href="{{ Storage::url($employer->photo) }}" target="_blank">View Photo</a></p>
                        @endif
                        @error('photo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Resume -->
                    <div class="form-group">
                        <label for="resume">Resume (PDF)</label>
                        <input type="file" class="form-control-file @error('resume') is-invalid @enderror" id="resume"
                            name="resume">
                        @if ($employer->resume)
                            <p>Current Resume: <a href="{{ Storage::url($employer->resume) }}" target="_blank">View Resume</a></p>
                        @endif
                        @error('resume')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
            
            

                    <!-- Resignation -->
                    <div class="form-group">
                        <label for="resignation_id">Resignation</label>
                        <select class="form-control @error('resignation_id') is-invalid @enderror" id="resignation_id"
                            name="resignation_id">
                            <option value="">Select Resignation</option>
                            @foreach ($resignations as $resignation)
                                <option value="{{ $resignation->id }}"
                                    {{ old('resignation_id', $employer->resignation_id) == $resignation->id ? 'selected' : '' }}>
                                    {{ $resignation->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('resignation_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                      <!-- occasions -->
                    <div class="form-group">
                        <label for="occasion_id">Resignation</label>
                        <select class="form-control @error('occasion_id') is-invalid @enderror" id="occasion_id"
                            name="occasion_id">
                            <option value="">Select occasion</option>
                            @foreach ($occasions as $occasion)
                                <option value="{{ $occasion->id }}"
                                    {{ old('occasion_id', $employer->occasion_id) == $occasion->id ? 'selected' : '' }}>
                                    {{ $occasion->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('resignation_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Religion -->
                    <div class="form-group">
                        <label for="religion_id">Religion</label>
                        <select class="form-control @error('religion_id') is-invalid @enderror" id="religion_id"
                            name="religion_id" required>
                            <option value="">Select Religion</option>
                            @foreach ($religions as $religion)
                                <option value="{{ $religion->id }}"
                                    {{ old('religion_id', $employer->religion_id) == $religion->id ? 'selected' : '' }}>
                                    {{ $religion->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('religion_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Qualification -->
                    <div class="form-group">
                        <label for="qualification_id">Qualification</label>
                        <select class="form-control @error('qualification_id') is-invalid @enderror" id="qualification_id"
                            name="qualification_id" required>
                            <option value="">Select Qualification</option>
                            @foreach ($qualifications as $qualification)
                                <option value="{{ $qualification->id }}"
                                    {{ old('qualification_id', $employer->qualification_id) == $qualification->id ? 'selected' : '' }}>
                                    {{ $qualification->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('qualification_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Nationality -->
                    
           
                    <div class="form-group">
                        <label for="nationality_id">Nationality</label>
                        <select class="form-control @error('nationality_id') is-invalid @enderror" id="nationality_id"
                            name="nationality_id" required>
                            <option value="">Select Nationality</option>
                            @foreach ($nationalities as $nationality)
                                <option value="{{ $nationality->id }}"
                                    {{ old('nationality_id', $employer->nationality_id) == $nationality->id ? 'selected' : '' }}>
                                    {{ $nationality->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('nationality_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Branch -->
                    <div class="form-group">
                        <label for="branch_id">Branch</label>
                        <select class="form-control @error('branch_id') is-invalid @enderror" id="branch_id"
                            name="branch_id" required>
                            <option value="">Select Branch</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}"
                                    {{ old('branch_id', $employer->branch_id) == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('branch_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Admin -->
                    <div class="form-group">
                        <label for="admin_id">Admin</label>
                        <select class="form-control @error('admin_id') is-invalid @enderror" id="admin_id"
                            name="admin_id" required>
                            <option value="">Select Admin</option>
                            @foreach ($admins as $admin)
                                <option value="{{ $admin->id }}"
                                    {{ old('admin_id', $employer->admin_id) == $admin->id ? 'selected' : '' }}>
                                    {{ $admin->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('admin_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Update Employer</button>
                </form>
            </div>
        </div>
    </div>
@endsection
