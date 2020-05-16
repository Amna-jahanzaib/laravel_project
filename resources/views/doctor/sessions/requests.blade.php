@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        All Sessions
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Session">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Appointment
                        </th>
                        <th>
                        Patient
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            Time
                        </th>
                        <th>
                            Status
                        </th>                        
                        
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sessions as $key => $session)
                        <tr data-entry-id="{{ $session->id }}">
                            <td>

                            </td>
                            <td>
                            <a href="{{ route('doctor.appointments.show', $session->appointment->id) }}">AP_{{ $session->appointment->id ?? '' }}</a>                  
                            </td>
                            <td>
                            <a class="users-list-name" href="{{ route('doctor.patients.show', $session->patient->id) }}">{{ $session->patient->name ?? '' }}</a>
                            <span class="users-list-date">{{ $session->patient->city ?? '' }}, {{ $session->patient->country ?? '' }}</span>                                
                            </td>
                            <td>
                                {{ App\Session::TYPE_SELECT[$session->type] ?? '' }}
                            </td>
                            <td>
                                {{ $session->time ?? '' }}
                            </td><td>
                            <span class=" btn-primary btn-xs" >
                            {{ App\Session::STATUS_SELECT[$session->status] ?? '' }}
                      </span>                            </td>
                            
                            <td>
                                @can('session_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('doctor.sessions.show', $session->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('session_accept')
                                   <a href="{{ route('doctor.session.accept', $session->id) }}" class="btn  btn-success btn-xs" >Accept</a>
                                @endcan
                                @can('session_reject')
                                <a href="{{ route('doctor.session.reject', $session->id) }}" class="btn btn-danger btn-xs" >Decline</a>
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
    pageLength: 100,
  });
  $('.datatable-Session:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
