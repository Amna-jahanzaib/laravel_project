@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('patient.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
        @can('patient_appointments')

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-phone"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending Appointments</span>
                <span class="info-box-number">{{$appointments->unique('patient_id')->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          @endcan
          @can('patient_sessions')

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
          @can('patient_appointments_pending')
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
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-bell" style="color:white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending Sessions</span>
                <span class="info-box-number">0</span>
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

        @can('patient_appointments')

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
                      <th>Doctor Name</th>
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
                      <a class="users-list-name" href="{{ route('patient.doctors.show', $appointment->doctor->id) }}">{{ $appointment->doctor->first_name ?? '' }} </a>
                      <span class="users-list-date">{{ $appointment->doctor->city ?? '' }}, {{ $appointment->doctor->country ?? '' }}</span>                      
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
                      @can('appointment_show')
                        <a href="{{ route('patient.appointments.show', $appointment->id) }}" class="btn  btn-primary btn-xs" >View</a>
                      @endcan
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
                <a href="{{route('patient.appointments.requests')}}" class="btn btn-sm btn-primary float-right">View All Appointments</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
          @endcan
          @can('patient_doctors')

          <!-- Right col -->
          <div class="col-md-4">
                      <!-- Doctor LIST -->
                      <div class="card">
              <div class="card-header">
                <h3 class="card-title">Doctors</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
              @foreach ($appointments->unique('doctor_id')->slice(0, 5) as $appointment)
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li class="item">
                    <div class="product-img">
                    @if($appointment->doctor->user->photo)
                    <a href="{{ $appointment->doctor->user->photo->getUrl() }}" target="_blank">
                    <img src="{{ $appointment->doctor->user->photo->getUrl('thumb') }}" alt="Product Image" class="img-circle img-bordered-sm img-size-50">      </a>
                  @endif

                    </div>
                    <div class="product-info">
                    <a class="users-list-name" href="{{ route('patient.doctors.show', $appointment->doctor->id) }}">{{$appointment->doctor->first_name}}</a>
                        <span class="users-list-date">{{$appointment->doctor->qualification}}</span>                      
                                         </div>
                  </li>
                  <!-- /.item -->
                  @endforeach
                 </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="{{route('patient.doctors.index')}}" class="uppercase">View All Patients</a>
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
          <div class="col-md-12">
            <!-- TABLE: LATEST Appointments -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Payment Requests </h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover datatable">
                  <thead>
                    <tr>
                    <th></th>
                    <th>Appointment/Session</th>
                    <th>Doctor</th>
                    <th>Type</th>
                      <th>Timing</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($sessions as $key => $session)
                    @if($session->status==1)

                    <tr>
                    <td></td>

                     <td>
                     <a href="{{ route('patient.sessions.show', $session->id) }}">Session_{{ $session->id ?? '' }}</a>                  
                     </td>
                      <td>
                      <div class="product-info">
                       <a class="users-list-name" href="{{ route('patient.doctors.show', $session->doctor->id) }}">{{ $session->doctor->first_name ?? '' }}</a>
                        <span class="users-list-date">{{ $session->doctor->qualification ?? '' }}</span>                      
                      </div></td>
                      <td>
                      {{ App\Session::TYPE_SELECT[$session->type] ?? '' }}
                      </td>
                      <td>
                      {{ \Carbon\Carbon::parse( $session->time )->toDayDateTimeString()}}
                      </td>
                      <td>
                      <span class=" btn-primary btn-xs" >
                            {{ App\Session::STATUS_SELECT[$session->status] ?? '' }}
                      </span>                           
                      </td>

                  <td>
                    <p class="users-list-date">
                    @can('patient_sessions')
                      <a class="btn btn-xs btn-primary" href="{{ route('patient.sessions.show', $session->id) }}">
                        {{ trans('global.view') }}
                      </a>
                    @endcan
                    <br/>
                    @can('patient_payment')
                        <a href="{{ route('payment', $session->id) }}" class="btn  btn-success btn-xs" >Pay</a>
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
                <a href="{{route('patient.sessions.index')}}" class="btn btn-sm btn-primary float-right">View All Sessions</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
          <!-- right col -->


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
