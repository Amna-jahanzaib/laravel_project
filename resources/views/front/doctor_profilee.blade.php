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
    <strong><i class="fas fa-book mr-1"></i> Education</strong>

    <p class="text-muted">
    {{$doctor->short_biography}}
    </p>

    <hr>

    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

    <p class="text-muted">{{$doctor->adress}}, {{$doctor->city}}, {{$doctor->country}}</p>

    <hr>

    <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

    <p class="text-muted">
      <span class="tag tag-danger">OPD</span>
      <span class="tag tag-success">IPD</span>
      <span class="tag tag-info">Therapy</span>
      <span class="tag tag-warning">Education</span>
    </p>

    <hr>

    <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

    <p class="text-muted">SPINAL FELLOWSHIP Dr. John Adam, Allegimeines Krakenhaus, Schwerin, Germany.
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
    {{$doctor->days}}
    </p>

    <hr>

    <strong><i class="fas fa-map-marker-alt mr-1"></i> Timing</strong>

    <p class="text-muted">{{$doctor->hospital_timing}}</p>

  </div>
  <!-- /.card-body -->
</div>
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
                              <span class="info-box-number text-center text-muted mb-0">Ahsan Ahmed</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-4">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Mobile</span>
                              <span class="info-box-number text-center text-muted mb-0">03454377564</span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-sm-4">
                          <div class="info-box bg-light">
                            <div class="info-box-content">
                              <span class="info-box-text text-center text-muted">Email<span>

                                  <span class="info-box-number text-center text-muted mb-0">ahsanahmed28@gmail.com</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                          <div class="post">
                            <!-- /.user-block -->
                            <p>
                              Completed my graduation in Gynaecologist Medicine from the well known and renowned
                              institution of <br />
                              India – SARDAR PATEL MEDICAL COLLEGE, BARODA in 2000-01, which was affiliated to M.S.
                              University.</p>
                            <p>I ranker in University exams from the same university from 1996-01.<br />Worked as
                              Professor and Head of the department ;
                              Community medicine Department at Sterline Hospital, Rajkot, Gujarat from 2003-2015

                              And I was lucky to train in a collegial environment where we called most of our
                              attendings by their first names.</p>
                            <p> If only doctors did it that way outside the Midwest. One of my attendings even made the
                              argument that it is safer for patient care because it’s easier for subordinates to raise
                              concerns when they’re not verbally kowtowing to their superior. I never respected a
                              white-haired surgeon any less when I addressed him by his first name. In fact, I saw that
                              in non-clinical science, it is commonplace for the most junior researchers to call the
                              most celebrated senior scientists by their first names. </p>

                          </div>

                          <div class="post clearfix">
                            <!-- /.user-block -->
                            <h5>Education</h5>

                            <p>
                              M.B.B.S.,Gujarat University, Ahmedabad,India.<br />
                              M.S.,Gujarat University, Ahmedabad, India.<br />
                              SPINAL FELLOWSHIP Dr. John Adam, Allegimeines Krakenhaus, Schwerin, Germany.<br />
                              Fellowship in Endoscopic Spine Surgery Phoenix, USA.<br />
                            </p>
                          </div>

                          <div class="post">
                          </div>
                        </div>
                      </div>
                      <h5>Experience
                      </h5>
                      <!-- /.user-block -->
                      <p>
                        One year rotatory internship from April-2009 to march-2010 at B. J. Medical College, Ahmedabad.
                      </p>
                      <p>
                        Three year residency at V.S. General Hospital as a resident in orthopedics from April - 2008 to
                        April - 2011.
                      </p>
                      <p>
                        I have worked as a part time physiotherapist in Apang manav mandal from 1st june 2004 to 31st
                        jan 2005.
                      </p>
                      <p>
                        Clinical and Research fellowship in Scoliosis at Shaurashtra University and Medical Centre
                        (KUMC) , Krishna Hospital , Rajkot from April 2013 to June 2013.
                      </p>
                      <p>
                        2.5 Years Worked at Mahatma Gandhi General Hospital, Surendranagar.
                      </p>
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