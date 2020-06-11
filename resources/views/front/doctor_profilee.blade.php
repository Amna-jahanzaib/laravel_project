@extends('layouts.header-front')
@section('main-content')

<div class="wrapper">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1  style="color:black;">Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-3">

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
                    <b>Age</b> <a class="float-right">{{\Carbon\Carbon::parse($doctor->date_of_birth)->age}} </a>
                  </li>
                  <li class="list-group-item">
                    <b>City</b> <a class="float-right">{{ $doctor->city }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Fee</b> <a class="float-right">Rs. 2000</a>
                  </li>
                </ul>
    <div style="text-align: center">
                    <a href="{{ route('patient.book_appointment', $doctor->id) }}"  class="btn  btn-primary center">Book Appointment</a>
                    <!--<a href="" class="btn btn-sm btn-primary">online session</a>-->
                  </div>

    <div>
  </div>
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

            </div>
  <!-- /.card-body -->

<!-- /.card -->
</div>
<!-- /.col -->          <!-- /.col -->
          <div class="col-md-9" >
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">About Me</a></li>
                 <!-- <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Edit Profile</a></li>-->
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
                              <span class="info-box-number text-center text-muted mb-0">{{ $doctor->username }}</span>
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
            <!--   
           
        -->
          </div>
 
        </div>
 
      </div>
   
    </div>
  </section>

</div>

  @endsection