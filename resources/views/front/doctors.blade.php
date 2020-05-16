@extends('layouts.header-front')
@section('main-content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">
      
          <!-- Main content -->
          <div class="row mb-2">
          <div class="col-sm-12">
          <div class="card">
              <div class="card-body">
              <div class="row">
                  <div class="col-lg-4">
                  <form method="POST" action="{{ route('search') }}">
                        @csrf

                  <div class="form-group">
                        <select class="form-control" name="city">
                          <option value="lahore">Lahore</option>
                          <option value="islamabad">Islamabad</option>
                          <option value="rawalpindi">Rawalpindi</option>
                          <option value="karachi">Karachi</option>
                          <option value="jehlum">Jehlum</option>
                        </select>
                      </div>
                    <!-- /input-group -->
                  </div>
                  <!-- /.col-lg-6 -->
                  <div class="col-lg-8">
                  <div class="input-group mb-3">
                  <input type="text" class="form-control" name="first_name" placeholder="Search any Speech Therapist Here...." quid>
                  <div class="input-group-append">
                    <span class="input-group-text">
                    <button type="submit" >
                    <i class="fas fa-search"></i>
                                </button></span>
                  </div>
                </div>

                    <!-- /input-group -->
                  </div>
</form>
                  <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->

              </div>
            </div>
          </div>
          <!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2">
          <div class="col-sm-12">
          <div class="card">
                  <div class="card-header">
                    <h5 style="margin-bottom:0px"><strong>Find Doctors & Book Appointments</strong></h5>
                    <h6 class=""><small>50,000+ people book appointments via Speech-Assistant every month.</small></h6>

                  </div>

                  <!-- /.card-header -->
                  <div class="card-body p-0">

                <ul class="users-list clearfix">
                  @foreach($doctors as $key => $doctor)
                  <li>
                  @if( $doctor->user->photo)
                    <img src="{{ $doctor->user->photo->getUrl() }}" alt="User Image" style=" width:128px; height:128px;">

                   @endif

                    <a class="users-list-name" href="{{ route('patient.view_doctor_profile', $doctor->id) }}">{{ $doctor->first_name ?? '' }} {{ $doctor->last_name ?? '' }} </a>
                    <span class="users-list-date">{{ $doctor->qualification ?? '' }}</span>
                    <span class="users-list-date">{{$doctor->experiance}}</span>
                    <span class="users-list-date"><strong>Fee 2000</strong></span>
                    <a href="{{ route('patient.book_appointment', $doctor->id) }}"  class="btn  btn-warning">Book Appointment</a>
</li>
                    @endforeach

                </ul>
                <!-- /.users-list -->
                </div>   

                  <!-- /.card-body -->
                  <div class="card-footer text-center">
                    <a href="javascript::">View All Doctors</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
          </div>
         <!-- /.col-md-6 -->

        </div><!-- /.row -->


    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-header -->
</div>



@endsection
