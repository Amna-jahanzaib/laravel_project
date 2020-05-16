@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Edit Doctor
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.doctors.update", [$doctor->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="first_name">First Name</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $doctor->first_name) }}" required>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="last_name">Last Name</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $doctor->last_name) }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif

            </div>
            <div class="form-group">
                <label class="required" for="username">Username</label>
                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', $doctor->username) }}" required>
                @if($errors->has('username'))
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                
            </div>
            <div class="form-group">
                <label class="required" for="email">Email</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $doctor->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif

            </div>
            <div class="form-group">
                <label class="required" for="date_of_birth">Date of Birth</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $doctor->date_of_birth) }}" required>
                @if($errors->has('date_of_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_birth') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required">Gender</label>
                @foreach(App\Doctor::GENDER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', $doctor->gender) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="gender_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="address">Address</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $doctor->address) }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', $doctor->country) }}">
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="city">City</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $doctor->city) }}" required>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="state">State</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', $doctor->state) }}" required>
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="phone">Phone</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $doctor->phone) }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="photo">Photo</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="qualification">Qualification</label>
                <input class="form-control {{ $errors->has('qualification') ? 'is-invalid' : '' }}" type="text" name="qualification" id="qualification" value="{{ old('qualification', $doctor->qualification) }}" required>
                @if($errors->has('qualification'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qualification') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="department">Department</label>
                <input class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}" type="text" name="department" id="department" value="{{ old('department', $doctor->department) }}" required>
                @if($errors->has('department'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="experience">Experience</label>
                <input class="form-control {{ $errors->has('experience') ? 'is-invalid' : '' }}" type="text" name="experience" id="experience" value="{{ old('experience', $doctor->experience) }}" required>
                @if($errors->has('experience'))
                    <div class="invalid-feedback">
                        {{ $errors->first('experience') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="short_biography">Short biography</label>
                <textarea class="form-control {{ $errors->has('short_biography') ? 'is-invalid' : '' }}" name="short_biography" id="short_biography" required>{{ old('short_biography', $doctor->short_biography) }}</textarea>
                @if($errors->has('short_biography'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_biography') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required">Days</label>
                <select class="form-control {{ $errors->has('days') ? 'is-invalid' : '' }}" name="days" id="days" required>
                    <option value disabled {{ old('days', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Doctor::DAYS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('days', $doctor->days) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('days') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="hospital_name">Hospital Name</label>
                <input class="form-control {{ $errors->has('hospital_name') ? 'is-invalid' : '' }}" type="text" name="hospital_name" id="hospital_name" value="{{ old('hospital_name', $doctor->hospital_name) }}" required>
                @if($errors->has('hospital_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospital_name') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="hospital_timing">hospital Timing</label>
                <input class="form-control timepicker {{ $errors->has('hospital_timing') ? 'is-invalid' : '' }}" type="text" name="hospital_timing" id="hospital_timing" value="{{ old('hospital_timing', $doctor->hospital_timing) }}" required>
                @if($errors->has('hospital_timing'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospital_timing') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="is_registered">Registered</label>
                <input class="form-control {{ $errors->has('is_registered') ? 'is-invalid' : '' }}" type="number" name="is_registered" id="is_registered" value="{{ old('is_registered', $doctor->is_registered) }}" step="1" required>
                @if($errors->has('is_registered'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_registered') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="user_id">User Id</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ ($doctor->user ? $doctor->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                Save
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

