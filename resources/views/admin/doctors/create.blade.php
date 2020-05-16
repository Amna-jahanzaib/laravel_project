@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.doctor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.doctors.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.doctor.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', '') }}" required>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.doctor.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="username">{{ trans('cruds.doctor.fields.username') }}</label>
                <input class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" type="text" name="username" id="username" value="{{ old('username', '') }}" required>
                @if($errors->has('username'))
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.username_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.doctor.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date_of_birth">{{ trans('cruds.doctor.fields.date_of_birth') }}</label>
                <input class="form-control date {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}" type="text" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required>
                @if($errors->has('date_of_birth'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_of_birth') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.date_of_birth_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.doctor.fields.gender') }}</label>
                @foreach(App\Doctor::GENDER_RADIO as $key => $label)
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
                <span class="help-block">{{ trans('cruds.doctor.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.doctor.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="country">{{ trans('cruds.doctor.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', '') }}">
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.doctor.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="state">{{ trans('cruds.doctor.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', '') }}" required>
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone">{{ trans('cruds.doctor.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="photo">{{ trans('cruds.doctor.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="qualification">{{ trans('cruds.doctor.fields.qualification') }}</label>
                <input class="form-control {{ $errors->has('qualification') ? 'is-invalid' : '' }}" type="text" name="qualification" id="qualification" value="{{ old('qualification', '') }}" required>
                @if($errors->has('qualification'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qualification') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.qualification_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="department">{{ trans('cruds.doctor.fields.department') }}</label>
                <input class="form-control {{ $errors->has('department') ? 'is-invalid' : '' }}" type="text" name="department" id="department" value="{{ old('department', '') }}" required>
                @if($errors->has('department'))
                    <div class="invalid-feedback">
                        {{ $errors->first('department') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.department_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="experience">{{ trans('cruds.doctor.fields.experience') }}</label>
                <input class="form-control {{ $errors->has('experience') ? 'is-invalid' : '' }}" type="text" name="experience" id="experience" value="{{ old('experience', '') }}" required>
                @if($errors->has('experience'))
                    <div class="invalid-feedback">
                        {{ $errors->first('experience') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.experience_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="short_biography">{{ trans('cruds.doctor.fields.short_biography') }}</label>
                <textarea class="form-control {{ $errors->has('short_biography') ? 'is-invalid' : '' }}" name="short_biography" id="short_biography" required>{{ old('short_biography') }}</textarea>
                @if($errors->has('short_biography'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_biography') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.short_biography_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.doctor.fields.days') }}</label>
                <select class="form-control {{ $errors->has('days') ? 'is-invalid' : '' }}" name="days" id="days" required>
                    <option value disabled {{ old('days', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Doctor::DAYS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('days', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('days'))
                    <div class="invalid-feedback">
                        {{ $errors->first('days') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.days_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hospital_name">{{ trans('cruds.doctor.fields.hospital_name') }}</label>
                <input class="form-control {{ $errors->has('hospital_name') ? 'is-invalid' : '' }}" type="text" name="hospital_name" id="hospital_name" value="{{ old('hospital_name', '') }}" required>
                @if($errors->has('hospital_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospital_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.hospital_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hospital_timing">{{ trans('cruds.doctor.fields.hospital_timing') }}</label>
                <input class="form-control timepicker {{ $errors->has('hospital_timing') ? 'is-invalid' : '' }}" type="text" name="hospital_timing" id="hospital_timing" value="{{ old('hospital_timing') }}" required>
                @if($errors->has('hospital_timing'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hospital_timing') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.hospital_timing_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="is_registered">{{ trans('cruds.doctor.fields.is_registered') }}</label>
                <input class="form-control {{ $errors->has('is_registered') ? 'is-invalid' : '' }}" type="number" name="is_registered" id="is_registered" value="{{ old('is_registered', '0') }}" step="1" required>
                @if($errors->has('is_registered'))
                    <div class="invalid-feedback">
                        {{ $errors->first('is_registered') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.is_registered_helper') }}</span>
            </div>
            <div class="form-group">
                      <label>Password</label>
                      <input class="form-control" type="password" name="password" placeholder="Password" required>
                      @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
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
                  <select class="form-control {{ $errors->has('hospital_days') ? 'is-invalid' : '' }}" name="hospital_days" id="hospital_days" required>
                    <option value disabled {{ old('days', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
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
                      <input class="form-control" name="hospital_address" rows="3" placeholder="Address">
                    </div>
                  </div>
                </div>
            <div class="form-group">
                <label class="required" for="documents">{{ trans('cruds.doctor.fields.documents') }}</label>
                <div class="needsclick dropzone {{ $errors->has('documents') ? 'is-invalid' : '' }}" id="documents-dropzone">
                </div>
                @if($errors->has('documents'))
                    <div class="invalid-feedback">
                        {{ $errors->first('documents') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.doctor.fields.documents_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.doctors.storeMedia') }}',
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
@if(isset($doctor) && $doctor->photo)
      var file = {!! json_encode($doctor->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, '{{ $doctor->photo->getUrl('thumb') }}')
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
<script>
    var uploadedDocumentsMap = {}
Dropzone.options.documentsDropzone = {
    url: '{{ route('admin.doctors.storeMedia') }}',
    maxFilesize: 4, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="documents[]" value="' + response.name + '">')
      uploadedDocumentsMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentsMap[file.name]
      }
      $('form').find('input[name="documents[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($doctor) && $doctor->documents)
          var files =
            {!! json_encode($doctor->documents) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="documents[]" value="' + file.file_name + '">')
            }
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
