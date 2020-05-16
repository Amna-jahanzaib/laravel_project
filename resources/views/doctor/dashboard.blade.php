@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Doctor Dashboard </h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('doctor.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
        @can('my_patients')

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-wheelchair"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Patients</span>
                <span class="info-box-number">{{$appointments->unique('patient_id')->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          @endcan
          @can('session_access')

         <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-handshake"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sessions</span>
                <span class="info-box-number">
                  {{$sessions->count()}}
                  <small></small>
                </span>
              </div>
            
            </div>
          
          </div>
          <!-- /.col -->
          @endcan

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
          @can('my_balance')
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-calendar"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Appointments</span>
                <span class="info-box-number">{{$appointments->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-money" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Current Balance</span>
                <span class="info-box-number">${{Auth::User()->doctor->balance}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          @endcan
        </div>
        <!-- /.row -->


        <!-- Main row -->
        <div class="row">
        @can('my_appointments')

          <!-- Left col -->
          <div class="col-md-8">
                      <!-- TABLE: LATEST Appointments -->
                      <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">New Appointments</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Appointment">
                    <thead>
                    <tr>
                    <th></th>
                      <th>Patient Name</th>
                      <th>Timing</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($appointments->isEmpty())
                    @endif

                    @foreach($appointments as $key => $appointment)
                      @if($appointment->status==0)
 
                    <tr>
                    <td>
                    </td>

                      <td>
                      <a class="users-list-name" href="{{ route('doctor.patients.show', $appointment->patient->id) }}">{{ $appointment->patient->name ?? '' }} </a>
                      <span class="users-list-date">{{ $appointment->patient->city ?? '' }}, {{ $appointment->patient->country ?? '' }}</span>                      
                      </td>
                      <td>
                      {{ \Carbon\Carbon::parse( $appointment->start_date.$appointment->start_time )->toDayDateTimeString()}}
                        
                      </td>
                      <td>
                      <span class=" btn-primary btn-xs" >
                      {{ App\Appointment::STATUS_SELECT[$appointment->status] ?? '' }}
                      </span>
                      </td>
                      <td>
                      <p class="users-list-date">
                      @can('appointment_accept')
                        <a href="{{ route('doctor.appointment.accept', $appointment->id) }}" class="btn  btn-primary btn-xs" >Approve</a>
                      @endcan
                      @can('appointment_reject')
                        <a href="{{ route('doctor.appointment.reject', $appointment->id) }}" class="btn btn-danger btn-xs" >Decline</a>
                      @endcan
                    </p>
                      </td>
                    </tr>
                    @endif
                    @endforeach

                    </tbody>
                  </table>

                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{route('doctor.appointments.requests')}}" class="btn btn-sm btn-primary float-right">View All Appointments</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          @endcan
          @can('my_patients')

          <!-- Right col -->
          <div class="col-md-4">
                      <!-- Doctor LIST -->
                      <div class="card">
              <div class="card-header">
                <h3 class="card-title">Patients</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
              @foreach ($appointments->unique('patient_id')->slice(0, 5) as $appointment)
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li class="item">
                    <div class="product-img">
                    @if($appointment->patient->user->photo)
                    <a href="{{ $appointment->patient->user->photo->getUrl() }}" target="_blank">
                    <img src="{{ $appointment->patient->user->photo->getUrl('thumb') }}" alt="Product Image" class="img-circle img-bordered-sm img-size-50">      </a>
                  @endif

                    </div>
                    <div class="product-info">
                    <a class="users-list-name" href="{{ route('doctor.patients.show', $appointment->patient->id) }}">{{$appointment->patient->name}}</a>
                        <span class="users-list-date">{{$appointment->patient->city}}, {{$appointment->patient->country}}</span>                      
                                         </div>
                  </li>
                  <!-- /.item -->
                  @endforeach
                 </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="{{route('doctor.patients.index')}}" class="uppercase">View All Patients</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          @endcan
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
            <!-- TABLE: LATEST Appointments -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Session Requests </h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover datatable">
                  <thead>
                    <tr>
                    <th></th>
                    <th>Session Id</th>
                      <th>Patient Name</th>
                      <th>Timing</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($sessions as $key => $session)
                    @if($session->status==0)

                    <tr>
                    <td></td>

                     <td>
                     <a href="{{ route('doctor.appointments.show', $session->appointment->id) }}">AP_{{ $session->appointment->id ?? '' }}</a>                  
                     </td>
                      <td>
                      <div class="product-info">
                       <a class="users-list-name" href="{{ route('doctor.patients.show', $appointment->patient->id) }}">{{ $session->patient->name ?? '' }}</a>
                        <span class="users-list-date">{{ $session->patient->city ?? '' }}, {{ $session->patient->country ?? '' }}</span>                      
                      </div></td>
                      <td>
                      {{ \Carbon\Carbon::parse( $session->start_date.$session->start_time )->toDayDateTimeString()}}
                      </td>
                      <td>
                      <span class=" btn-primary btn-xs" >
                            {{ App\Session::STATUS_SELECT[$session->status] ?? '' }}
                      </span>                           
                      </td>

                  <td>
                    <p class="users-list-date">
                    @can('session_show')
                      <a class="btn btn-xs btn-primary" href="{{ route('doctor.sessions.show', $session->id) }}">
                                        {{ trans('global.view') }}
                      </a>
                    @endcan
                    @can('session_accept')
                        <a href="{{ route('doctor.session.accept', $session->id) }}" class="btn  btn-success btn-xs" >Accept</a>
                      @endcan
                      @can('session_reject')
                        <a href="{{ route('doctor.session.reject', $session->id) }}" class="btn btn-danger btn-xs" >Decline</a>
                      @endcan
                    

                    </p>
                  </td>
                </tr>
                @endif

              @endforeach

                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{route('doctor.sessions.requests')}}" class="btn btn-sm btn-primary float-right">View All Sessions</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
          <!-- right col -->
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Patients Feedback</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="https://placehold.it/900x500/39CCCC/ffffff&text=I+Love+System" alt="First slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="https://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+System" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="https://placehold.it/900x500/f39c12/ffffff&text=I+Love+System" alt="Third slide">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix" style="text-align: center">
                <a href="{{url('/appointments')}}" class="btn btn-sm btn-primary">View All Feedback</a>
              </div>

            </div>
            <!-- /.card -->
          </div>

        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
</section>
@section('scripts')
<script>
$(document).ready(function() {
    $('.datatable').DataTable( {
      "pageLength": 4,
      buttons: {
        buttons: [
            {  enabled: false }
        ]
    }

    } );
} );
</script>
@endsection
@endsection
