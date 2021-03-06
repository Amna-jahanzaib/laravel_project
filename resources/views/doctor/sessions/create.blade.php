@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Session
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("doctor.sessions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required">Session type</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Session::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="time">Session Time</label>
                <input class="form-control datetime {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time" value="{{ old('time') }}" required>
                @if($errors->has('time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="patient_id">Patient</label>
                <select class="form-control  {{ $errors->has('patient') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id" required>
                        <option value="{{ $appointment->patient->id }}" >{{ $appointment->patient->name }}</option>
                </select>
                @if($errors->has('patient'))
                    <div class="invalid-feedback">
                        {{ $errors->first('patient') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="doctor_id">Doctor</label>
                <select class="form-control  {{ $errors->has('doctor') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor_id" required>
                        <option value="{{ $appointment->doctor->id }}"}}>{{ $appointment->doctor->first_name }}</option>
                </select>
                @if($errors->has('doctor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('doctor') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="appointment_id">Session Appointment</label>
                <select class="form-control {{ $errors->has('appointment') ? 'is-invalid' : '' }}" name="appointment_id" id="appointment_id" required>
                        <option value="{{ $appointment->id }}">{{ $appointment->id }}</option>
                </select>
                @if($errors->has('appointment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appointment') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
