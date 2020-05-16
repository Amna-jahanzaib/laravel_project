@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Exercise Details
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('doctor.exercises.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Excercise ID
                        </th>
                        <td>
                            {{ $exercise->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        Excercise Name
                        </th>
                        <td>
                            {{ $exercise->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        Excercise Type
                        </th>
                        <td>
                            {{ $exercise->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                        Excercise Description
                        </th>
                        <td>
                            {{ $exercise->description }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('doctor.exercises.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
