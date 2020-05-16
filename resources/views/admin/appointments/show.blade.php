@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Show Appointment Details</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.appointments.index')}}">Appointments</a></li>
                    <li class="breadcrumb-item active">Show Appointment Details</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.appointment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                      Go Back
                    </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $appointment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Patient
                        </th>
                        <td>
                            {{ $appointment->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Doctor
                        </th>
                        <td>
                            {{ $appointment->doctor->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Start Date
                        </th>
                        <td>
                            {{ $appointment->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        Start Time
                        </th>
                        <td>
                            {{ $appointment->start_time }}
                        </td>
                    </tr>
                    <tr>
                    <th>
                            Status
                        </th>
                        <td>
                        <span class="badge badge-info">
                        {{ App\Appointment::STATUS_SELECT[$appointment->status] ?? '' }}
</span>

                        </td>
                    </tr>
                    <tr>
                        <th>
                            
                    Appointment Description


                        </th>
                        <td>
                            {{ $appointment->appointment_desc }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Type
                            
                        </th>
                        <td>
                            {{ App\Appointment::TYPE_RADIO[$appointment->type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
            Go Back
                    </a>
            </div>
        </div>
    </div>
</div>



@endsection
