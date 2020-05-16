@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Session Details
    </div>

    <div class="card-body">
        <div class="form-group">
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
                  @if(!empty($session->sessionTreatments))
                  <div class="table-responsive">
                    <table class="table">
                    <tr>
                        <th>
                            Appointment
                        </th>
                        <td>
                        <a href="{{ route('doctor.appointments.show', $session->appointment->id) }}">AP_{{ $session->appointment->id ?? '' }}</a>                  
                        </td>
                    </tr>
                    <tr>
                        <th style="width:50%">Session No:</th>
                        <td>
                        {{$session->id}}
                        </td>
                      </tr>
                      <tr>
                        <th style="width:50%">Session Status:</th>
                        <td>
                        <span class="badge badge-info">

                        {{ App\Session::STATUS_SELECT[$session->status] ?? '' }}
</span>
                        </td>
                      </tr>
                      <tr>
                        <th>
                            Patient
                        </th>
                        <td>
                            {{ $session->patient->name ?? '' }}
                        </td>
                    </tr>
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
                        <th>Session Date and Time:</th>
                        <td>
                        {{ \Carbon\Carbon::parse( $session->sessionTreatments->next_session_date.$session->sessionTreatments->next_session_time )->toDayDateTimeString()}}
                        </td>
                      </tr>
                      <tr>
                        <th>Next Session Date and Time:</th>
                        <td>
                        {{ \Carbon\Carbon::parse( $session->start_date.$session->start_time )->toDayDateTimeString()}}
                        </td>
                      </tr>
    </table>
                 </div>
                 @endif
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                @if(empty($session->sessionTreatments))

                <button type="button" onclick="location.reload();location.href=''" class="btn  btn-info">Create Record</button>
                  @endif<button type="button" class="btn btn-success float-right" onclick="location.reload();location.href='{{route('doctor.sessions.index')}}'">
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
    </div>
</div>



@endsection
