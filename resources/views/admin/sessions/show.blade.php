@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.session.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('doctor.sessions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.session.fields.id') }}
                        </th>
                        <td>
                            {{ $session->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.session.fields.type') }}
                        </th>
                        <td>
                            {{ App\Session::TYPE_SELECT[$session->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.session.fields.time') }}
                        </th>
                        <td>
                            {{ $session->time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.session.fields.patient') }}
                        </th>
                        <td>
                            {{ $session->patient->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.session.fields.doctor') }}
                        </th>
                        <td>
                            {{ $session->doctor->first_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.session.fields.appointment') }}
                        </th>
                        <td>
                            {{ $session->appointment->start_date ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('doctor.sessions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
