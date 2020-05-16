@extends('layouts.admin')
@section('content')
  <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Doctor Record</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item "><a href="{{route('admin.doctors.join_requests')}}">Join Requests</a></li>
              <li class="breadcrumb-item active">Join Request</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content ">
      <div class="container-fluid ">
        <div class="row">
          <div class="col-12 card">
            <div class="card-body ">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Please note that the Doctor's request once Declined will not be rollback and you will not able to retrieve later.
            </div>
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-stethoscope"></i> Doctor Details
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
                        <th style="width:50%">First Name:</th>
                        <td>
                      {{$doctor->first_name}}
                     </td>
                      </tr>
                      <tr>
                        <th>Last Name:</th>
                        <td> {{$doctor->last_name}}</td>
                      </tr>
                      <tr>
                        <th>Username:</th>
                        <td> {{$doctor->username}}</td>
                      </tr>
                      <tr>
                        <th>Email:</th>
                        <td> {{ $doctor->user->email}}</td>
                      </tr>
                      <tr>
                        <th>Phone no:</th>
                        <td> {{$doctor->phone}}</td>
                      </tr>
                      <tr>
                        <th>Gender:</th>
                        <td>{{ App\Doctor::GENDER_RADIO[$doctor->gender] ?? '' }}</td>
                      </tr>
                      <tr>
                        <th>Date of Birth:</th>
                        <td> {{$doctor->date_of_birth->format('M d Y')}}</td>
                      </tr>
                      <tr>
                        <th>Address:</th>
                        <td> {{$doctor->address}}</td>
                      </tr>
                      <tr>
                        <th>City:</th>
                        <td> {{$doctor->city}}</td>
                      </tr>
                      <tr>
                        <th>Counrty:</th>
                        <td> {{$doctor->country}}</td>
                      </tr>
                      <tr>
                        <th>Qualifications:</th>
                        <td>{{$doctor->qualification}}</td>
                      </tr>
                      <tr>
                        <th>Department:</th>
                        <td>{{$doctor->department}}</td>
                      </tr>
                      <tr>
                        <th>Doctor Availability Days:</th>
                        <td>
                        @foreach($doctor->days as $key => $day)
                        {{ App\Doctor::DAYS_SELECT[$day]}},
                        @endforeach
                        </td>
                      </tr>
                      <tr>
                        <th>Doctor Availability Timing:</th>
                        <td>
                        {{\Carbon\Carbon::parse($doctor->start_timing)->format('H:i A')}}-
                        {{\Carbon\Carbon::parse($doctor->finish_timing)->format('H:i A.')}}
                        </td>
                      </tr>
                      <tr>
                        <th>Hospital Name:</th>
                        <td>{{$doctor->hospital_name}}</td>
                      </tr>
                      <tr>
                        <th>Hospital days:</th>
                        <td>
                        @foreach($doctor->hospital_days as $key => $day)
                        {{ App\Doctor::DAYS_SELECT[$day]}},
                        @endforeach
                        </td>
                      </tr>
                      <tr>
                        <th>Hospital Timing:</th>
                        <td>
                        {{\Carbon\Carbon::parse($doctor->hospital_start_timing)->format('H:i A')}}-
                        {{\Carbon\Carbon::parse($doctor->hospital_finish_timing)->format('H:i A.')}}
                        </td>
                      </tr>
                      <tr>
                        <th>Short Biography:</th>
                        <td>{{$doctor->short_biography}}</td>
                      </tr>
                      <tr>
                        <th>Education:</th>
                        <td>{{$doctor->education}}</td>
                      </tr>
                      <tr>
                        <th>Experience:</th>
                        <td>{{$doctor->experience}}</td>
                      </tr>
                      <tr>
                        <th>Skills:</th>
                        <td>{{$doctor->skills}}</td>
                      </tr>
                      <tr>
                        <th>Notes:</th>
                        <td>{{$doctor->notes}}</td>
                      </tr>
                      <tr>
                        <th>Profile Photo:</th>
                        <td>
                        @if($doctor->user->photo)
                                <a href="{{ $doctor->user->photo->getUrl() }}" target="_blank">
                                    <img src="{{ $doctor->user->photo->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                          </td>
                      </tr>
                      <tr>
                        <th>Documents:</th>
                        <td>
                        @foreach($doctor->documents as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                        @endforeach
                        </td>
                      </tr>
                     <!-- <tr>
                        <th>Avatar:</th>
                        <td>
                        <div class="product-img" >
                      <img src="{{asset('dist/img/user8-128x128.jpg')}}" alt="Product Image" class=" " >
                      </div>

                        </td>
                      </tr>-->

                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="{{ route('admin.doctors.join_requests') }}"  class="btn btn-default"> cancel</a>
                  <a href="{{route('admin.accept_doctor',['id'=>$doctor->id])}}" class="btn btn-success float-right" > Accept
                  </a>
                  <a href="{{route('admin.reject_doctor',['id'=>$doctor->id])}}" class="btn btn-danger float-right" style="margin-right: 5px;">
                     Reject
                  </a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
   @endsection

