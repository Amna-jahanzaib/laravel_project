@extends('layouts.doctor')
@extends('layouts.header-front')
@section('main-content')
<div class="content-header">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-sm-12">
            <div class="card">
                <div class="card-header">Book Appointment</div>

                <div class="card-body">

                @if (\Session::has('error'))
                    <div class="alert alert-danger">
        
                      <span>{!! \Session::get('error') !!}</span>
        
                    </div>
                @endif
<!-- Form  -->
                <form method="POST" action="{{ route("patient.appointments.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                              <!-- text input -->
                              <div class="form-group">
                              <label>Doctor Name <span class="text-danger">*</span></label>
                              <input class="form-control " type="text" name="doctor_name" id="doctor_name" value="{{ $doctor->first_name }}"  disabled>
                              <input class="form-control " type="hidden" name="doctor_id" id="doctor_id" value="{{ $doctor->id }}"  >
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                                      <!-- text input -->
                          <div class="form-group">
                          <label>Doctor Fee <span class="text-danger">*</span></label>
                          <input class="form-control" type="text" name="fee" id="fee" value=RS/-2000 disabled>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                                      <!-- text input -->
                          <div class="form-group">
                            <label>Patient Name: <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="patient_name" id="patient_name"  value="{{$patient->name ?? ''}}" disabled>
                            <input class="form-control " type="hidden" name="patient_id" id="patient_id"  value="{{$patient->id ?? ''}}" >
                            <input class="form-control " type="hidden" name="status" id="status"  value="0" >
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                                      <!-- text input -->
                          <div class="form-group">
                            <label>Appointment Mode: <span class="text-danger">*</span></label>
                            @foreach(App\Appointment::TYPE_RADIO as $key => $label)
                              <div class="form-check {{ $errors->has('type') ? 'is-invalid' : '' }}">
                                <input class="form-check-input" type="radio" id="type_{{ $key }}" name="type" value="{{ $key }}" {{ old('type', '') === (string) $key ? 'checked' : '' }} required>
                                <label class="form-check-label" for="type_{{ $key }}">{{ $label }}</label>
                              </div>
                            @endforeach
                            @if($errors->has('type'))
                            <div class="invalid-feedback">
                              {{ $errors->first('type') }}
                            </div>
                            @endif
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Problem Diagnosed:</label>
                            <textarea class="form-control {{ $errors->has('appointment_desc') ? 'is-invalid' : '' }}" name="appointment_desc" id="appointment_desc" required>{{ old('appointment_desc') }}</textarea>
                            @if($errors->has('appointment_desc'))
                            <div class="invalid-feedback">
                            {{ $errors->first('appointment_desc') }}
                            </div>
                            @endif
                          </div>
                        </div>
                      </div>
                                  
                                
            <div class="row">
              <div class="col-sm-6">
                                      <!-- textarea -->
                                      <div class="form-group">
                                        <label>Appointment Start Date:</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="far fa-calendar-alt"></i>
                                            </span>
                                          </div>
                                          <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <!-- textarea -->
                                      <div class="form-group">
                                        <label>Appointment Start Time:</label>
                                        <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                @endif

                                    </div>
                                    </div>
                                    </div>

                          <!-- /.card-body -->
                          <div class="justify-content-center" style="margin-top:20px;">
                          <button type="submit" class="btn btn-primary">Book Now</button>
                          <button type="cancel" class="btn btn-danger float-right">Cancel</button>
                        </div>
                          <!-- /.card-footer -->
                        </form>

                    
<!-- Form  -->

                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-12">
<!-- Profile Image -->
<div class="card card-primary card-outline">
              <div class="card-body box-profile">

                <div class="text-center">
                @if($doctor->user->photo)
                    <a href="{{ $doctor->user->photo->getUrl() }}" target="_blank">
                    <img class="profile-user-img img-fluid img-circle" width=100 height=100 src="{{ $doctor->user->photo->getUrl() }}" alt="User profile picture">
                  @endif
                </div>

                <h3 class="profile-username text-center"><a class="users-list-name" href="{{ route('patient.view_doctor_profile', $doctor->id) }}">{{ $doctor->first_name ?? '' }} {{ $doctor->last_name ?? '' }} </a>
</h3>

                <p class="text-muted text-center">{{ $doctor->qualification ?? '' }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Experience</b> <a class="float-right">{{ $doctor->experience ?? '' }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>City</b> <a class="float-right">{{ $doctor->city ?? '' }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Fee</b> <a class="float-right">Rs. 200</a>
                  </li>
                </ul>
                <div style="text-align: center">
                    <a href="{{ route('patient.view_doctor_profile', $doctor->id) }}"  class="btn  btn-primary center">View Profile</a>
                    <!--<a href="" class="btn btn-sm btn-primary">online session</a>-->
                  </div>

                <div>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    </div>
    </div>


  @endsection
