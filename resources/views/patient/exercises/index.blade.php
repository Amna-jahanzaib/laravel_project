@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Recommended Exercises</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('patient.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Exercises</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<div class="card">
    <div class="card-header">
        Exercises
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Excercise">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            Exercise Name
                        </th>
                        <th>
                            Exercisen Type
                        </th>
                        <th>
                            Exercise Description
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessions->unique('sessionTreatments->exercise_id') as $key => $session)
                    @if(!empty($session->sessionTreatments))
                        <tr >
                            <td>

                            </td>
                            <td>
                            {{$session->sessionTreatments->exercise->id ?? ''}}                            </td>
                            <td>
                            {{$session->sessionTreatments->exercise->name ?? ''}}
                            </td>
                            <td>
                            {{$session->sessionTreatments->exercise->type ?? ''}}                            </td>
                            <td>
                            {{$session->sessionTreatments->exercise->description ?? ''}}
                            </td>
                            <td>
                                    <a class="btn btn-xs btn-primary" href="{{ route('patient.exercises.show', $session->sessionTreatments->exercise->id ) }}">
                                        {{ trans('global.view') }}
                                    </a>


                            </td>

                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Excercise:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
