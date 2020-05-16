@extends('layouts.header-front')



@section('main-content')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Sign Up as a  <small>Patient</small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Register Patient</li>
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
              <h3 class="card-title">Patient Details</h3>
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

            <form method="POST" action="{{ route("admin.patients.store") }}" enctype="multipart/form-data">
                                        @csrf
										<div class="row">
											<div class="col-sm-6">
												<div class="form-group has-placeholder">
													<label for="name">Your Name</label>
													<i class="grey fa fa-user"></i>
                          <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
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
                          <input class="form-control {{ $errors->has('father_name') ? 'is-invalid' : '' }}" type="text" name="father_name" id="father_name" value="{{ old('father_name', '') }}" required>
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
                          <input class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}" type="number" name="age" id="age" value="{{ old('age', '') }}" step="1" required>
                @if($errors->has('age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </div>
                @endif
                                                </div>
											</div>

											<div class="col-sm-6">
												<div class="form-group has-placeholder">
													<label for="email">Email address</label>
													<i class="grey fa fa-envelope-o"></i>
                          <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
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
												<div class="form-group has-placeholder">
													<label for="phone_number">Phone Number</label>
                          <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                                                </div>
										    </div>

                                            <div class="col-sm-6">
                                                <div class="form-group has-placeholder">
                                                        <label>Gender <span class="text-danger">*</span></label>
                                                        @foreach(App\Patient::GENDER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
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

                                        <div class="row">
                                            <div class="col-sm-12">
												<div class="form-group has-placeholder">
													<label for="disease">Disease</label>
                          <input class="form-control {{ $errors->has('disease') ? 'is-invalid' : '' }}" type="text" name="disease" id="disease" value="{{ old('disease', '') }}" required>
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
                          <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
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
                          <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', '') }}" required>
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
                          <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address" required>{{ old('address') }}</textarea>
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

										<button type="submit" class="theme_button block_button  btn btn-primary">Create an account</button>
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

