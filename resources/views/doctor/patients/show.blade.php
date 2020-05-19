@extends('layouts.admin')
@section('content')
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('doctor.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('doctor.patients.index')}}">Patients</a></li>
              <li class="breadcrumb-item active">Patient Profile</li>
            </ol>
          </div>
        </div>


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
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Sessions</a></li>
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
                    <i class="fas fa-wheelchair"></i> Session Details
                    <small class="float-right">Date: 2/10/2014</small>
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
                    @foreach($sessions as $key => $session)
                       <tr>
                        <th style="width:50%">Session No:</th>
                        <td>
                        {{$session->id}}
                        </td>
                      </tr>
                      <tr>
                        <th>Session Date and Time:</th>
                        <td>
                        {{ \Carbon\Carbon::parse($session->time )->toDayDateTimeString()}}
                        </td>
                      </tr>
                      @if(!empty($session->sessionTreatments))

                      <tr>
                        <th>Problem Diagnosed:</th>
                        <td>{{$session->sessionTreatments->problem_diagnosed}}</td>
                      </tr>
                      <tr>
                        <th>Recommend Exercise:</th>
                        <td>{{$session->sessionTreatments->exercise->name ?? ''}}: {{$session->sessionTreatments->exercise->description}}</td>
                      </tr>
                      <tr>
                        <th>Recommend Medicine:</th>
                        <td>{{$session->sessionTreatments->recommended_medicine}}</td>
                      </tr>
                      <tr>
                        <th>Improvements:</th>
                        <td>{{$session->sessionTreatments->improvements}}</td>
                      </tr>
                      
                      <tr>
                        <th>Next Session Date and Time:</th>
                        <td>
                        @if(!empty($session->next_session_date))
                          {{ \Carbon\Carbon::parse( $session->next_session_date.$session->next_session_time )->toDayDateTimeString() }}
                        @else
                        Appointment Completed
                        @endif
                        </td>
                      </tr>
                      @endif
                      @endforeach

    </table>
                 </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <button type="button" class="btn btn-success float-right" onclick="location.reload();location.href='{{route('doctor.sessions.index')}}'">
                    Back

                  </button>

                </div>
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