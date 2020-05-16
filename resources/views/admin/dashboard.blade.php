@extends('layouts.admin')
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Home</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
        <div class="row">
         <!-- /.col-->
         @can('doctor_access')

         <div class="col-12 col-sm-6 col-md-3">
                  <div class="card" style="border-radius: .25rem; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);">
                    <div class="card-body p-3 d-flex align-items-center">
                      <div class="bg-info p-3 " style="text-align:center; border-radius: .25rem; font-size: 1.5rem; width:30%">
                      <i class="fas fa-user-md" style="font-weight:900"></i>
                        
                      </div>
                      <div class="" style="padding: 5px 10px;">
                        <div class="text-value text-info">                {{$doctors->count()}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Doctors</div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.col-->
        @endcan
@can('patient_access')

         <!-- /.col-->
         <div class="col-12 col-sm-6 col-md-3">
                  <div class="card" style="border-radius: .25rem; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);">
                    <div class="card-body p-3 d-flex align-items-center">
                      <div class="bg-danger p-3 mfe-3" style="text-align:center; border-radius: .25rem; font-size: 1.5rem; width:30%">
                      <i class="fas fa-wheelchair"></i>
                        
                      </div>
                      <div class="" style="padding: 5px 10px;">
                        <div class="text-value text-danger">                {{$patients->count()}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Patients</div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.col-->
        @endcan
        @can('doctor_join_request')

         <!-- /.col-->
         <div class="col-12 col-sm-6 col-md-3">
                  <div class="card" style="border-radius: .25rem; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);">
                    <div class="card-body p-3 d-flex align-items-center">
                      <div class="bg-warning p-3 mfe-3" style="text-align:center; border-radius: .25rem; font-size: 1.5rem; width:30%">
                      <i class="fas fa-heartbeat"></i>
                        
                      </div>
                      <div class="" style="padding: 5px 10px;">
                        <div class="text-value text-warning">                {{$ndoctors->count()}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">UnApproved Doctors</div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.col-->
                @endcan

                @can('user_access')

         <!-- /.col-->
         <div class="col-12 col-sm-6 col-md-3">
                  <div class="card" style="border-radius: .25rem; box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);">
                    <div class="card-body p-3 d-flex align-items-center">
                      <div class="bg-primary p-3 mfe-3" style="text-align:center; border-radius: .25rem; font-size: 1.5rem; width:30%">
                      <i class="fas fa-user"></i>
                        
                      </div>
                      <div class="" style="padding: 5px 10px;">
                        <div class="text-value text-primary">                {{$users->count()}}</div>
                        <div class="text-muted text-uppercase font-weight-bold small">Users</div>
                      </div>
                    </div>
                  </div>
                </div>
                @endcan
                <!-- /.col-->


       <!-- /.row -->
       </div>

       @can('doctor_join_request')

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-8">
                      <!-- TABLE: LATEST Appointments -->
            <div class="card">
              <div class="card-header ">
                <h5 class="card-title">New Doctor Join Requests</h5>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class=" table table-bordered table-hover datatable">
                    <thead>
                    <tr>
                      <th>Doctor ID</th>
                      <th>Doctor's Name</th>
                      <th>Email</th>
                      <th>Documents</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($ndoctors->count() > 0)

                    @foreach($ndoctors as $doctor)

                    <tr>
                    <td></td>
                      <td>
                        <a class="users-list-name" href="{{route('admin.approve_doctor',['id'=>$doctor->id])}}">{{$doctor->first_name}}</a>
                      </td>
                      <td>{{$doctor->user->email}}</td>
                      <td>
                      @foreach($doctor->documents as $key => $media)
                        <a href="{{ $media->getUrl() }}" target="_blank">
                        <i class="far fa-file-pdf "></i> View file
                       </a>
                        @endforeach
                      </td>
                      <td>
                      <p class="users-list-date">

<a href="{{route('admin.approve_doctor',['id'=>$doctor->id])}}" class="btn  btn-outline-primary btn-xs" >View</a>
</p>

                      </td>
                    </tr>
                    @endforeach
                    @endif

                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{route('admin.doctors.join_requests')}}" class="btn btn-sm btn-primary float-right">View All Join Requests</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
@endcan

@can('doctor_access')

          <!-- Right col -->
          <div class="col-md-4">
                      <!-- Doctor LIST -->
                      <div class="card">
              <div class="card-header">
                <h5 class="card-title">Doctors</h5>

              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
@foreach ($doctors->slice(0, 5) as $doctor)

<ul class="products-list product-list-in-card list-group">

    <li class="list-group-item" style="">

      <div class="" style="display: inline-block; margin:0px; margin-right:5px; float:left;">
      @if($doctor->user->photo)
          <a href="{{ $doctor->user->photo->getUrl() }}" target="_blank">
          <img src="{{ $doctor->user->photo->getUrl('thumb') }}" width="50px" height="50px" alt="Doctor Image" class="img-circle " style="height: 50px;
    width: 50px;">
          </a>
      @endif
      </div>
      <div class="product-info">
                      <a href="{{route('admin.doctors.show', $doctor->id)}}" class="product-title">{{$doctor->first_name}}
                        </a>
                      <span class="product-description">
                      {{$doctor->qualification}}
                      </span>
                    </div>
    </li>
    </ul>
                @endforeach




              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="{{route('admin.doctors.index')}}" class="uppercase">View All Doctors</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

          </div>
          @endcan
          <!-- /.col -->
@can('my_patients')

<!-- Right col -->
<div class="col-md-4">
            <!-- Patients LIST -->
            <div class="card">
    <div class="card-header">
      <h5 class="card-title">My Patients</h5>

    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
@foreach ($appointments->unique('patient_id')->slice(0, 5) as $appointment)

<ul class="products-list product-list-in-card list-group">

<li class="list-group-item" style="">

<div class="" style="display: inline-block; margin:0px; margin-right:5px; float:left;">
@if($appointment->patient->user->photo)
<a href="{{ $appointment->patient->user->photo->getUrl() }}" target="_blank">
<img src="{{ $appointment->patient->user->photo->getUrl('thumb') }}" width="50px" height="50px" alt="Doctor Image" class="img-circle " style="height: 50px;
width: 50px;">
</a>
@endif
</div>
<div class="product-info">
            <a href="{{url('/')}}" class="product-title">{{$appointment->patient->name}}
              </a>
            <span class="product-description">
            {{$appointment->patient->city}}
            </span>
          </div>
</li>
</ul>
      @endforeach




    </div>
    <!-- /.card-body -->
    <div class="card-footer text-center">
      <a href="{{route('admin.doctors.index')}}" class="uppercase">View All Patients</a>
    </div>
    <!-- /.card-footer -->
  </div>
  <!-- /.card -->

</div>
@endcan

        </div>
        <!-- /.row -->

@can('patient_access')

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">
            <!-- TABLE: LATEST Appointments -->
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">New Patients</h5>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class=" table table-bordered table-hover datatable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Patient Name</th>
                      <th>Father Name</th>
                      <th>Email</th>
                      <th>Phone no</th>
                      <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if($patients->count() > 0)

                    @foreach($patients as $patient)

                    <tr>
                    <td> {{$patient->id}}</td>
                     
                     <td> {{$patient->name}}</td>
                     <td> {{$patient->father_name}}</td>
                      <td>{{$patient->user->email}}</td>
                      <td>{{$patient->phone}}</td>
                      <td>
                      <a href="{{ route('admin.patients.show', $patient->id) }}" class="btn btn-block btn-outline-primary btn-xs" >View</a>
                     </td>
                    </tr>


                    @endforeach
                    @endif

                    </tbody>
                 </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{url('/patients')}}" class="btn btn-sm btn-primary float-right">View All Patients</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->

            
          </div>
          <!-- /.col -->
          <!-- right col -->
@endcan
        <!-- /.row -->

    </section>
    <!-- /.content -->
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
