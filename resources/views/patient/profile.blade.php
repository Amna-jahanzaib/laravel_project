@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('patient.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                @if($patient->user->photo)
                    <a  href="{{  $patient->user->photo->getUrl() }}" target="_blank">
                    <img class="profile-user-img img-fluid img-circle" width="100px" height="100px" src="{{  $patient->user->photo->getUrl() }}" alt="User profile picture">
                    </a>
              `@endif


                
                </div>

                <h3 class="profile-username text-center">{{$patient->name}}</h3>

                <p class="text-muted text-center">Patient</p>



              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

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
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">About Me</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                  <!-- /.tab-pane -->
                  <div class="active tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="post">
                      <div class="user-block">

                        </span>
                      </div>
                      <div class="row">
                        <!-- accepted payments column -->

                        <!-- /.col -->
                        <div class="col-12">

                        <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-wheelchair"></i> Patient Details
                    <small class="float-right">Date: {{$patient->created_at->format('d/M/Y')}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>


              <div class="row">
                <!-- accepted payments column -->

                <!-- /.col -->
                <div class="col-12">

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Patient Name:</th>
                        <td>
                        {{$patient->name}}
                        </td>
                      </tr>
                      <tr>
                        <th>Father Name:</th>
                        <td>{{$patient->father_name}}</td>
                      </tr>
                      <tr>
                        <th>Age:</th>
                        <td>{{$patient->age}} years</td>
                      </tr>
                      <tr>
                        <th>Email:</th>
                        <td>{{$patient->user->name}}</td>
                      </tr>
                      <tr>
                        <th>Phone no:</th>
                        <td>{{$patient->phone}}</td>
                      </tr>
                      <tr>
                        <th>Gender:</th>
                        <td>{{ App\Patient::GENDER_RADIO[$patient->gender] ?? '' }}</td>
                      </tr>

                      <tr>
                        <th>Address:</th>
                        <td>{{$patient->address}}</td>
                      </tr>
                      <tr>
                        <th>City:</th>
                        <td>{{$patient->city}}</td>
                      </tr>
                      <tr>
                        <th>Counrty:</th>
                        <td>{{$patient->country}}</td>
                      </tr>
                      <tr>
                        <th>Disease:</th>
                        <td>{{$patient->disease}}</td>
                      </tr>

                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button type="button" class="btn btn-success float-right" onclick="location.reload();location.href='{{route('doctor.patients.index')}}'">
                    Back

                  </button>

                </div>
              </div>
            </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                  <div class="col-12">
                  <div class="post">
                      <div class="user-block">

                        </span>
                      </div>
                      <div class="row">
                        <!-- accepted payments column -->

                        <!-- /.col -->
                        <div class="col-12">

                        <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-wheelchair"></i> Edit Profile
                    <small class="float-right">Date: 2/10/2014</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>


              <div class="row">
                <!-- accepted payments column -->

                <!-- /.col -->
                <div class="col-12">
                <form method="POST" action="{{ route("admin.patients.update", [$patient->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

										<div class="row">
											<div class="col-sm-6">
												<div class="form-group has-placeholder">
													<label for="name">Your Name</label>
													<i class="grey fa fa-user"></i>
                          <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name',$patient->name ) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                                                </div>
											</div>

                                            <div class="col-sm-6">
												<div class="form-group has-placeholder">
													<label for="father_name">Father Name</label>
													<i class="grey fa fa-user"></i>
                          <input class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}" type="text" name="father_name" id="father_name" value="{{ old('father_name', $patient->father_name) }}" required>
                @if($errors->has('father_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('father_name') }}
                    </div>
                @endif
                                                </div>
											</div>
										</div>
										<div class="row">
                                        <div class="col-sm-6">
												<div class="form-group has-placeholder">
													<label for="age">Age</label>
                          <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="number" name="age" id="age" value="{{ old('age', $patient->age) }}" step="1" required>
                @if($errors->has('age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </div>
                @endif
                                                </div>
                      </div>
                      <div class="col-sm-6">
                                            <label for="phone_number">Gender</label>

                      @foreach(App\Doctor::GENDER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <input class="form-check-input icheck-primary d-inline " type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', $patient->gender) === (string) $key ? 'checked' : '' }} required>
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
                                            <div class="col-sm-12">
												<div class="form-group has-placeholder">
													<label for="disease">Disease</label>
                          <input class="form-control {{ $errors->has('disease') ? 'is-invalid' : '' }}" type="text" name="disease" id="disease" value="{{ old('disease', $patient->disease) }}" required>
                @if($errors->has('disease'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disease') }}
                    </div>
                @endif
                                                </div>
										    </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
												<div class="form-group has-placeholder">
													<label for="city">City</label>
                          <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $patient->city) }}" required>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                                                </div>
										    </div>

                                            <div class="col-sm-6">
												<div class="form-group has-placeholder">
													<label for="country">Country</label>
                          <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', $patient->country) }}" required>
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                                                </div>
										    </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
												<div class="form-group has-placeholder">
													<label for="address">Address</label>
                          <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" required>{{ old('address',$patient->address) }}</textarea>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-6">
                    <div class="form-group">
                      <label>Avatar</label>
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

                                        </div>

										<button type="submit" class="theme_button block_button  btn btn-primary">Update</button>
									</form>

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              </div>
            </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div></div><!-- /.col -->
                  </div>
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
@if(isset($patient) && $patient->user->photo)
      var file = {!! json_encode($patient->user->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $patient->user->photo->getUrl('thumb') }}')
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
