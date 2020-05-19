
@extends('layouts.header-front')
@section('main-content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Join as a  <small>Doctor</small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Register Doctor</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
      <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements disabled -->
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Doctor Details</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            @if (\Session::has('message'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('message') !!}</li>
        </ul>
    </div>
@endif
            <form method="POST" action="{{ route("admin.doctors.store") }}" enctype="multipart/form-data">
            @csrf
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>First Name <span class="text-danger">*</span></label>
                      <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Last Name</label>
                      <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->

                    <div class="form-group">
                      <label>Username <span class="text-danger">*</span></label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">@</span>
                        </div>
                        <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', '') }}" required>
                @if($errors->has('username'))
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Email <span class="text-danger">*</span></label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
			<div class="col-sm-6">
				<div class="form-group has-placeholder">
					<label for="password">Password</label>
						<i class="grey fa fa-pencil-square-o"></i>
                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
				</div>
                <div class="col-sm-6">
					<div class="form-group has-placeholder">
						<label for="password-confirm">Retype Password</label>
							<i class="grey fa fa-pencil-square-o"></i>
                    <input id="password-confirm" type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
				</div>
				</div>
			</div>


                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->

                    <div class="form-group">
                      <label>Date of Birth <span class="text-danger">*</span></label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                        </div>
                        <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required>
                @if($errors->has('date_of_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_birth') }}
                    </div>
                @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                    <label>Gender <span class="text-danger">*</span></label>
                      <div class="form-group clearfix">
                      @foreach(App\Doctor::GENDER_RADIO as $key => $label)
                    <div class="form-check icheck-primary d-inline {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="gender_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                      </div>

                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Address</label>
                      <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" row=3 value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="row">
                      <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                          <label>Country</label>
                          <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', '') }}">
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                          <label>City</label>
                          <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="form-group">
                          <label>State/Province</label>
                          <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', '') }}" required>
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                        </div>
                      </div>
                      <div class="col-sm-3">
                    <!-- select -->
                    <div class="form-group">
                      <label>Phone</label>
                      <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                    </div>
                  </div>

                    </div>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Education</label>
                      <textarea class="form-control {{ $errors->has('education') ? 'is-invalid' : '' }}"  name="education" id="education" value="{{ old('education', '') }}" required></textarea>
                @if($errors->has('education'))
                    <div class="invalid-feedback">
                        {{ $errors->first('education') }}
                    </div>
                @endif
                    </div>
                  </div>
                  <div class="col-sm-6">
                     <!-- Select multiple-->
                        <div class="form-group">
                            <label>Experience</label>
                            <textarea class="form-control {{ $errors->has('experience') ? 'is-invalid' : '' }}" type="text" name="experience" id="experience" value="{{ old('experience', '') }}" required></textarea>
                @if($errors->has('experience'))
                    <div class="invalid-feedback">
                        {{ $errors->first('experience') }}
                    </div>
                @endif
                        </div>
                    </div>

                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Qualification <span class="text-danger">*</span></label>
                      <input class="form-control {{ $errors->has('qualification') ? 'is-invalid' : '' }}" type="text" name="qualification" id="qualification" value="{{ old('qualification', '') }}" required>
                @if($errors->has('qualification'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qualification') }}
                    </div>
                @endif
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Department</label>
                      <input class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}" type="text" name="department" id="department" value="{{ old('department', '') }}" required>
                @if($errors->has('department'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department') }}
                    </div>
                @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Skills</label>
                      <textarea class="form-control {{ $errors->has('skills') ? 'is-invalid' : '' }}"  name="skills" id="skills" value="{{ old('skills', '') }}" required></textarea>
                @if($errors->has('skills'))
                    <div class="invalid-feedback">
                        {{ $errors->first('skills') }}
                    </div>
                @endif
                    </div>
                  </div>
                  <div class="col-sm-6">
                     <!-- Select multiple-->
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="{{ old('notes', '') }}" required></textarea>
                @if($errors->has('notes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notes') }}
                    </div>
                @endif
                        </div>
                    </div>

                </div>
                <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                      <label>Profile Photo</label>
                      <div class="custom-file">
                      <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone" required>
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <!-- Select multiple-->
                    <div class="form-group">
                      <label>Short Biography</label>
                      <textarea class="form-control {{ $errors->has('short_biography') ? 'is-invalid' : '' }}" name="short_biography" id="short_biography" required>{{ old('short_biography') }}</textarea>
                @if($errors->has('short_biography'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_biography') }}
                    </div>
                @endif
                    </div>
                  </div>
                </div>
               <hr/>
               <label><strong>Availability</strong></label>
               <div class="row">
                  <div class="col-sm-6">
                    <!-- Select multiple-->
                    <div class="form-group">
                  <label>Days</label>
                  <select class="select2 form-control {{ $errors->has('days') ? 'is-invalid' : '' }}"  name="days[]" multiple="multiple" id="days" required data-placeholder="Please Select"
                          style="width: 100%;">

                    @foreach(App\Doctor::DAYS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('days', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('days') }}
                    </div>
                @endif
                </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                     <!-- Select multiple-->
                     <div class="form-group">
                  <label>Start Time</label>
                  <input class="form-control timepicker {{ $errors->has('start_timing') ? 'is-invalid' : '' }}" type="text" name="start_timing" id="start_timing" value="{{ old('start_timing') }}" required>
                @if($errors->has('start_timing'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_timing') }}
                    </div>
                @endif
                </div>
                    </div>

                  <div class="col-sm-6">
                    <!-- Select multiple-->
                    <div class="form-group">
                  <label>FinishTime</label>
                  <input class="form-control timepicker {{ $errors->has('finish_timing') ? 'is-invalid' : '' }}" type="text" name="finish_timing" id="finish_timing" value="{{ old('finish_timing') }}" required>
                @if($errors->has('finish_timing'))
                    <div class="invalid-feedback">
                        {{ $errors->first('finish_timing') }}
                    </div>
                @endif
                </div>

                  </div>
</div>

                <hr/>
               <label><strong>Hospital Details</strong></label>
               <div class="row">
                  <div class="col-sm-6">
                     <!-- Select multiple-->
                        <div class="form-group">
                            <label>Hospital Name</label>
                            <input class="form-control {{ $errors->has('hospital_name') ? 'is-invalid' : '' }}" type="text" name="hospital_name" id="hospital_name" value="{{ old('hospital_name', '') }}" required>
                    @if($errors->has('hospital_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospital_name') }}
                    </div>
                       @endif
                        </div>
                    </div>

                  <div class="col-sm-6">
                    <!-- Select multiple-->
                    <div class="form-group">
                  <label>Days</label>
                  <select class="select2 form-control {{ $errors->has('hospital_days') ? 'is-invalid' : '' }}"  name="hospital_days[]"  id="hospital_days" required multiple="multiple" id="days"  data-placeholder="Please Select" required
                          style="width: 100%;">
                    @foreach(App\Doctor::DAYS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('hospital_days', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>

                </div>

                  </div>
</div>
<div class="row">
                  <div class="col-sm-6">
                     <!-- Select multiple-->
                     <div class="form-group">
                  <label>Start Time</label>
                  <input class="form-control timepicker {{ $errors->has('hospital_start_timing') ? 'is-invalid' : '' }}" type="text" name="hospital_start_timing" id="hospital_start_timing" value="{{ old('hospital_start_timing') }}" required>
                @if($errors->has('hospital_start_timing'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospital_start_timing') }}
                    </div>
                @endif
                </div>
                    </div>

                  <div class="col-sm-6">
                    <!-- Select multiple-->
                    <div class="form-group">
                  <label>Finish Time</label>
                  <input class="form-control timepicker {{ $errors->has('hospital_finish_timing') ? 'is-invalid' : '' }}" type="text" name="hospital_finish_timing" id="hospital_finish_timing" value="{{ old('hospital_finish_timing') }}" required>
                @if($errors->has('hospital_finish_timing'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospital_finish_timing') }}
                    </div>
                @endif
                </div>

                  </div>
</div>
                              
<div class="row">

<div class="col-sm-12">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Hospital Address</label>
                      <input class="form-control {{ $errors->has('hospital_address') ? 'is-invalid' : '' }}" name="hospital_address" rows="3" placeholder="Address" required>
                    </div>
                  </div>
                </div>
                <div class="row">

<div class="col-sm-12">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Upload Documents (Education and Experience Certificates)</label>
                      <div class="needsclick dropzone {{ $errors->has('documents') ? 'is-invalid' : '' }}" name="documents" id="documents-dropzone" required>
                </div>
                @if($errors->has('documents'))
                    <div class="invalid-feedback">
                        {{ $errors->first('documents') }}
                    </div>
                @endif
                    </div>
                  </div>
                </div>
                

                <input class="form-control" type="hidden" name="is_registered" id="is_registered" value="0">

                <!-- /.card-body -->
                <!-- /.card-footer -->

              <div class="justify-content-center">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="submit" class="btn btn-secondary float-right" onclick="location.reload();location.href='{{url('/')}}'">Cancel</button>
              </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection


