@extends('layouts.admin')
@section('content')



  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Treatment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('doctor.index')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('doctor.patients')}}">Patients</a></li>
              <li class="breadcrumb-item active">Treatment Record </li>
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
                @if($session->patient->user->photo)
                    <a  href="{{  $session->patient->user->photo->getUrl() }}" target="_blank">
                    <img class="profile-user-img img-fluid img-circle" width="100px" height="100px" src="{{  $session->patient->user->photo->getUrl() }}" alt="User profile picture">
                    </a>
              `@endif


                
                </div>

                <h3 class="profile-username text-center">{{$session->patient->name}}</h3>

                <p class="text-muted text-center">Patient</p>



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
              
                @if (\Session::has('error'))
                    <div class="alert alert-danger">
        
                      <span>{!! \Session::get('error') !!}</span>
        
                    </div>
                @endif

                <div class="tab-content">

                  <!-- /.tab-pane -->
            <div class="active tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="post">
                      <div class="user-block">

                        <h3>Treatment Details</h3>
                        </span>
                      </div>
                      <div class="row">
                        <!-- accepted payments column -->

                        <!-- /.col -->
                        <div class="col-12">
                        <div class="card-body">
           <form method="POST" action="{{ route("doctor.treatment_record.store") }}" enctype="multipart/form-data">
           @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Session No <span class="text-danger">*</span></label>
                      <select class="form-control  {{ $errors->has('session') ? 'is-invalid' : '' }}" name="session_id" id="session_id" required>
                        <option value="{{ $session->id }}" }}>{{ $session->id }}</option>
                </select>
                @if($errors->has('session'))
                    <div class="invalid-feedback">
                        {{ $errors->first('session') }}
                    </div>
                @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->

                    <div class="form-group">
                      <label>Recommend Exercise: <span class="text-danger">*</span></label>
                      <select class="form-control select2 {{ $errors->has('exercise') ? 'is-invalid' : '' }}" name="exercise_id" id="exercise_id" required>
                    @foreach($exercises as $id => $exercise)
                        <option value="{{ $id }}" {{ old('exercise_id') == $id ? 'selected' : '' }}>{{ $exercise }}</option>
                    @endforeach
                </select>
                @if($errors->has('exercise'))
                    <div class="invalid-feedback">
                        {{ $errors->first('exercise') }}
                    </div>
                @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Problem Diagnosed:</label>
                      <textarea  rows="3" cols="30" class="form-control  {{ $errors->has('problem_diagnosed') ? 'is-invalid' : '' }}" name="problem_diagnosed" required></textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Recommend Medicine:</label>
                      <textarea class="form-control" rows="3" cols="30" class="form-control  {{ $errors->has('recommended_medicine') ? 'is-invalid' : '' }}" name="recommended_medicine" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->

                    <div class="form-group">
                      <label>Improvements: <span class="text-danger">*</span></label>
                      <textarea class="form-control" rows="3" cols="30" class="form-control  {{ $errors->has('improvements') ? 'is-invalid' : '' }}" name="improvements" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                <p>Please leave blank next session info if no further sessions required</p>

                  <div class="col-sm-6">

                    <!-- textarea -->
                    <div class="form-group">
                      <label>Next Session Date:</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                        </div>
                        <input class="form-control date {{ $errors->has('next_session_date') ? 'is-invalid' : '' }}" type="text" name="next_session_date" id="start_date" value="{{ old('next_session_date') }}" >
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Next Session Time:</label>
                      <div class="input-group date" id="timepicker" data-target-input="nearest">
                      <input class="form-control timepicker {{ $errors->has('next_session_time') ? 'is-invalid' : '' }}" type="text" name="next_session_time" id="start_time" value="{{ old('next_session_time') }}" >
                      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
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