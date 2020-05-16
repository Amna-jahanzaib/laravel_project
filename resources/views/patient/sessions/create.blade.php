@extends('layouts.admin')
@section('content')
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Session</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('patient.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('patient.sessions.index')}}">Sessions</a></li>
              <li class="breadcrumb-item active">Create Session Request </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                @if($appointment->doctor->user->photo)
                    <a  href="{{  $appointment->doctor->user->photo->getUrl() }}" target="_blank">
                    <img class="profile-user-img img-fluid img-circle" width="100px" height="100px" src="{{  $appointment->doctor->user->photo->getUrl() }}" alt="User profile picture">
                    </a>
              @endif


                
                </div>

                <h3 class="profile-username text-center">{{$appointment->doctor->first_name}}</h3>

                <p class="text-muted text-center">Doctor</p>



              </div>
              <!-- /.card-body -->
            </div>

            <!-- About Me Box -->
            <div class="card card-primary">

              <!-- /.card-header -->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-body">
                <div class="tab-content">

                  <!-- /.tab-pane -->
            <div class="active tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="post">
                      <div class="user-block">

                        <h3>Session Details</h3>
                        </span>
                      </div>
                      <div class="row">
                        <!-- accepted payments column -->

                        <!-- /.col -->
                        <div class="col-12">
                        <div class="card-body">
                        <form method="POST" action="{{ route("patient.sessions.store") }}" enctype="multipart/form-data">
           @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
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

                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->

                    <div class="form-group">
                <label class="required" for="time">Session Time</label>
                <input class="form-control datetime {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time" value="{{ old('time') }}" required>
                @if($errors->has('time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time') }}
                    </div>
                @endif
            </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
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

                  </div>
                  <div class="col-sm-6">
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
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->

                    <div class="form-group">
                <label class="required" for="appointment_id">Appointment Details</label>
                <select class="form-control {{ $errors->has('appointment') ? 'is-invalid' : '' }}" name="appointment_id" id="appointment_id" required>
                        <option value="{{ $appointment->id }}">{{ $appointment->start_date }} {{ $appointment->start_time }}</option>
                </select>
                @if($errors->has('appointment'))
                    <div class="invalid-feedback">
                        {{ $errors->first('appointment') }}
                    </div>
                @endif
            </div>
                  </div>
                </div>

                <!-- /.card-body -->
                <!-- /.card-footer -->
              <div class="justify-content-center">
                <button type="submit" class="btn btn-primary" >Submit</button>
                <button type="" class="btn btn-secondary float-right" onclick="location.reload();location.href='{{route('doctor.patient')}}'">Cancel</button>
              </div>
            </div>
            </div>
</form>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                  </div>
                  <!-- /.tab-pane -->


                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->




@endsection
