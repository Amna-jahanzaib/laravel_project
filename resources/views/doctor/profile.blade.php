@extends('layouts.admin')
@section('content')



  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('doctor.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                @if(Auth::User()->photo)
              <img class="profile-user-img img-fluid img-circle" src="{{Auth::User()->photo->getUrl() }}" alt="User profile picture" style=" width:250px; height:200px;">
                @endif
                </div>

                <h3 class="profile-username text-center">{{ $doctor->first_name }}</h3>

                <p class="text-muted text-center">{{ $doctor->department }}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Balance</b> <a class="float-right">${{ $doctor->balance}} </a>
                  </li>
                  <li class="list-group-item">
                    <b>City</b> <a class="float-right">{{ $doctor->city }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Fee</b> <a class="float-right">Rs. 2000</a>
                  </li>
                </ul>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Qualification</strong>

                <p class="text-muted">
                {{ $doctor->qualification }}
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">{{ $doctor->address }}</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                {{ $doctor->skills }}
                </p>
                <hr>

<strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

<p class="text-muted">{{ $doctor->notes }}
  .</p>


              </div>
              <!-- /.card-body -->
            </div>
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Availabilty</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Week Days</strong>

                <p class="text-muted">
                @foreach($doctor->days as $key => $day)
                  {{ App\Doctor::DAYS_SELECT[$day]}},
                @endforeach
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Timing</strong>

                <p class="text-muted">{{\Carbon\Carbon::parse($doctor->start_timing)->format('H:i a')}} to {{\Carbon\Carbon::parse($doctor->finish_timing)->format('H:i a.')}}</p>
                </div>
<!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">About Me</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit Profile</a></li>
                </ul>
              </div><!-- /.card-header -->
        <div class="card-body">
           <div class="tab-content">

                  <!-- /.tab-pane -->
                  <div class="active tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="post">
                      <div class="user-block">

                        <h3>About</h3>
                        </span>
                      </div>
                      <div class="row">
                        <div class="col-12 col-sm-4">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Full Name</span>
                              <span class="info-box-number text-center text-muted mb-0">{{ $doctor->first_name }} {{ $doctor->last_name }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-4">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Mobile</span>
                              <span class="info-box-number text-center text-muted mb-0">{{ $doctor->phone }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-4">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Email<span>

                                  <span class="info-box-number text-center text-muted mb-0">{{ $doctor->user->email }}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                        <div class="post">
                            <!-- /.user-block -->
                            <h5>Biography</h5>
                            <p>
                            {{ $doctor->short_biography }}</p>
                          </div>

                          <div class="post clearfix">
                            <!-- /.user-block -->
                            <h5>Education</h5>

                            <p>
                            {{ $doctor->education }}
                            </p>
                          </div>

                          <div class="post">
                          <h5>Experience</h5>
                      <!-- /.user-block -->
                      <p>
                      {{ $doctor->experience }} </p>
                          </div>
                          <div class="post">
                          <h5 >Hospital Availabilty</h5>
                      <!-- /.user-block -->
                      
                          </div>

                <strong><i class="fas fa-book mr-1"></i>Hospital Days</strong>

                <p class="text-muted">
                @foreach($doctor->hospital_days as $key => $day)
                  {{ App\Doctor::DAYS_SELECT[$day]}},
                @endforeach
                </p>


                <strong><i class="fas fa-map-marker-alt mr-1"></i>Hospital Timing</strong>

                <p class="text-muted">{{\Carbon\Carbon::parse($doctor->hospital_start_timing)->format('H:i a')}} to {{\Carbon\Carbon::parse($doctor->hospital_finish_timing)->format('H:i a.')}}</p>


                </div>
                  </div>
                  </div>
                  </div>
           <div class="tab-pane" id="settings">
            <div class="card-body">
        <form method="POST" action="{{ route("admin.doctors.update", [$doctor->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>First Name <span class="text-danger">*</span></label>
                      <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $doctor->first_name) }}" required>
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
                      <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $doctor->last_name) }}" required>
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
                        <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', $doctor->username) }}" required>
                @if($errors->has('username'))
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
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
                        <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('username', $doctor->date_of_birth) }}" required>
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
                    <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <input class="form-check-input icheck-primary d-inline " type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', $doctor->gender) === (string) $key ? 'checked' : '' }} required>
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
                      <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" row=3 value="{{ old('address',  $doctor->address) }}" required>
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
                          <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country',  $doctor->country) }}">
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
                          <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city',  $doctor->city) }}" required>
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
                          <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', $doctor->state) }}" required>
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                        </div>
                      </div>

                    </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Department</label>
                      <input class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}" type="text" name="department" id="department" value="{{ old('department', $doctor->department) }}" required>
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
                      <textarea class="form-control {{ $errors->has('skills') ? 'is-invalid' : '' }}"  name="skills" id="skills" value="" required>{{ old('skills', $doctor->skills) }}</textarea>
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
                            <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" type="text" name="notes" id="notes" value="" required>{{ old('notes', $doctor->notes) }}</textarea>
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
                      <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
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
                      <textarea class="form-control {{ $errors->has('short_biography') ? 'is-invalid' : '' }}" name="short_biography" value="{{ old('qualification', $doctor->short_biography) }}" id="short_biography" required>{{ old('short_biography',$doctor->short_biography) }}</textarea>
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
                  <select class="select2 form-control {{ $errors->has('days') ? 'is-invalid' : '' }}"  name="days[]" multiple="multiple" id="days" required >

                    @foreach(App\Doctor::DAYS_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ (in_array($key,$doctor->days)) ? 'selected' : '' }}>{{ $label }}</option>

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
                  <input class="form-control timepicker {{ $errors->has('start_timing') ? 'is-invalid' : '' }}" type="text" name="start_timing" id="start_timing" value="{{ old('start_timing',$doctor->start_timing) }}" required>
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
                  <input class="form-control timepicker {{ $errors->has('finish_timing') ? 'is-invalid' : '' }}" type="text" name="finish_timing" id="finish_timing" value="{{ old('finish_timing',$doctor->finish_timing) }}" required>
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
                            <input class="form-control {{ $errors->has('hospital_name') ? 'is-invalid' : '' }}" type="text" name="hospital_name" id="hospital_name" value="{{ old('hospital_name', $doctor->hospital_name) }}" required>
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
                  <select class="select2 form-control {{ $errors->has('hospital_days') ? 'is-invalid' : '' }}"  name="hospital_days[]"  id="hospital_days" required multiple="multiple" id="days"  data-placeholder="" required
                          style="width: 100%;">

                    @foreach(App\Doctor::DAYS_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ (in_array($key,$doctor->hospital_days)) ? 'selected' : '' }}>{{ $label }}</option>
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
                  <input class="form-control timepicker {{ $errors->has('hospital_start_timing') ? 'is-invalid' : '' }}" type="text" name="hospital_start_timing" id="hospital_start_timing" value="{{ old('hospital_start_timing',$doctor->hospital_start_timing) }}" required>
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
                  <input class="form-control timepicker {{ $errors->has('hospital_finish_timing') ? 'is-invalid' : '' }}" type="text" name="hospital_finish_timing" id="hospital_finish_timing" value="{{ old('hospital_finish_timing',$doctor->hospital_finish_timing) }}" required>
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
                      <input class="form-control" name="hospital_address" rows="3" placeholder="Address" value="{{ old('hospital_address',$doctor->hospital_address) }}">
                    </div>
                  </div>
                </div>
                


                <input class="form-control" type="hidden" name="is_registered" id="is_registered" value="{{$doctor->is_registered}}">
                <input class="form-control" type="hidden" name="balance" id="balance" value="{{$doctor->balance}}">

                <!-- /.card-body -->
                <!-- /.card-footer -->

              <div class="justify-content-center">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                <button type="submit" class="btn btn-secondary float-right" onclick="location.reload();location.href='{{url('/')}}'">Cancel</button>
              </div>
              </form>
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
      </div><!-- /.container-fluid -->
    </section>
  @endsection
  @section('scripts')
  <script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($doctor) && $doctor->user->photo)
      var file = {!! json_encode($doctor->user->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $doctor->user->photo->getUrl('thumb') }}')
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>

@endsection
