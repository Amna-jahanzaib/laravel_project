@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
Patients List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Patient">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>ID</th>
                  <th>Patient Name</th>
                  <th>Email</th>
                  <th>Phone #</th>
                  <th>Disease</th>

                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments->unique('patient_id') as $key => $appointment)
                        <tr data-entry-id="{{ $appointment->patient->id }}">
                            <td>

                            </td>
                            <td>
                            @if($appointment->patient->user->photo)
                                <a  href="{{  $appointment->patient->user->photo->getUrl() }}" target="_blank">
                                    <img src="{{  $appointment->patient->user->photo->getUrl('thumb') }}" class="img-circle img-bordered-sm img-size-50" width="50px" height="50px">
                                </a>
                            @endif

                            </td>
                            <td>
                            <a class="users-list-name" href="{{ route('doctor.patients.show', $appointment->patient->id) }}">{{ $appointment->patient->name ?? '' }}</a>
                            <span class="users-list-date">{{ $appointment->patient->city ?? '' }}, {{ $appointment->patient->country ?? '' }}</span>                                

                                
                            </td>
                            <td>
                                {{ $appointment->patient->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->patient->phone ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->patient->disease ?? '' }}
                            </td>
                            
                            
                            <td>
                                @can('patient_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('doctor.patients.show', $appointment->patient->id) }}">
                                        {{ trans('global.view') }} treatment record
                                    </a>
                                @endcan


                            </td>

                        </tr>
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
    pageLength: 10,
  });
  $('.datatable-Patient:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
