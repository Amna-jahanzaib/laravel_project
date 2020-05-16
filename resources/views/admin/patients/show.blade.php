@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Patient Profile</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.patients.index')}}">Patients</a></li>
              <li class="breadcrumb-item active">Patient Profile</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


        <div class="row">
          <div class="col-sm-12">



          <div class="card card-primary card-outline">
              <div class="card-body box-profile">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-wheelchair"></i> Patient Details
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
                        <td>{{$patient->age}} Years</td>
                      </tr>
                      <tr>
                        <th>Email:</th>
                        <td>{{$patient->user->email}}</td>
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
                        <th>Avatar:</th>
                        <td>
                        @if($patient->user->photo)
                                <a href="{{  $patient->user->photo->getUrl() }}" target="_blank">
                                    <img src="{{  $patient->user->photo->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                        @endif

                        </td>
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
                    <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                      Back to list
                    </a>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
@endsection