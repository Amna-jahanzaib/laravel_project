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
            <h1 style="margin-left:20%; color:black">Book Appointment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('doctor.index')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('view_doctor_profile')}}">Doctors</a></li>
              <li class="breadcrumb-item active">Book Appointment </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

   <section class="content">
      <div class="container-fluid">
                <div class="row">
                  <div class="col-md-9">
                    <div class="card">
                      <div class="card-header p-2">
                        <ul class="nav nav-pills">
                          <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">For Physical Session</a></li>
                          <li class="nav-item"><a class="nav-link" href="#online" data-toggle="tab">For Online Session</a></li>
                        </ul>
                      </div>
                      <div class="card-body">
                        <div class="tab-content">

                          <!-- /.tab-pane -->
                          <div class="active tab-pane" id="timeline">
                            <!-- The timeline -->
                            <div class="post">
                                <div class="user-block">

                                    <h3>Appointment Details</h3>
                                    </span>
                                </div>
                              <div class="row">
                                <!-- accepted payments column -->

                                <!-- /.col -->
                            <div class="col-12">
                              <div class="card-body">
                                <form role="form">
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" placeholder="Session No">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <!-- text input -->

                                      <div class="form-group">
                                        <label>Enter Your Phone # <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" placeholder="">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <!-- text input -->
                                      <div class="form-group">
                                        <label>Enter Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" placeholder="">
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                        <label>Problem Diagnosed:</label>
                                        <textarea class="form-control" rows="3" cols="30"></textarea>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <!-- text input -->

                                      
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-sm-6">
                                      <!-- textarea -->
                                      <div class="form-group">
                                        <label>Appointment Date:</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              <i class="far fa-calendar-alt"></i>
                                            </span>
                                          </div>
                                          <input type="text" class="form-control float-right" id="reservation" placeholder="1991-07-22">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <!-- textarea -->
                                      <div class="form-group">
                                        <label>Appointment Time:</label>
                                        <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#timepicker"/>
                                        <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                                        </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <!-- /.card-body -->
                                  <!-- /.card-footer -->
                                </form>
                                <div class="justify-content-center">
                                  <button type="" class="btn btn-primary" onclick="location.reload();location.href='{{route('doctor.patient')}}'">Book Now</button>
                                  <button type="submit" class="btn btn-secondary float-right" onclick="location.reload();location.href='{{route('doctor.patient')}}'">Cancel</button>
                                </div>
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
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection