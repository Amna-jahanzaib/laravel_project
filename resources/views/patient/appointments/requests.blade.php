@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Pending Appointments</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('patient.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Pending Appointments</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="card">
    <div class="card-header">
        Appointment List
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Appointment">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Appointment ID
                        </th>
                        <th>
                            Doctor
                        </th>
                        <th>
                            Timing
                        </th>
                        
                        <th>
                            Status
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($appointments as $key => $appointment)

                        <tr data-entry-id="{{ $appointment->id }}">
                            <td>

                            </td>
                            <td>
                            <a href="{{ route('patient.appointments.show', $appointment->id) }}">AP_{{ $appointment->id ?? '' }}</a>                  
                            </td>
                            <td>
                            <a class="users-list-name" href="{{ route('patient.doctors.show', $appointment->doctor->id) }}">{{ $appointment->doctor->first_name ?? '' }}</a>
                            <span class="users-list-date">{{ $appointment->doctor->city ?? '' }}, {{ $appointment->doctor->country ?? '' }}</span>                                
                            </td>
                            
                            <td>
                            {{ \Carbon\Carbon::parse( $appointment->start_date.$appointment->start_time )->toDayDateTimeString()}}

                            </td>
                            <td>
                            
                            <span class="badge badge-info">
                            {{ App\Appointment::STATUS_SELECT[$appointment->status] ?? '' }}

                            </span>
                            </td>
                            <td>
                                {{ $appointment->appointment_desc ?? '' }}
                            </td>
                            <td>
                                {{ App\Appointment::TYPE_RADIO[$appointment->type] ?? '' }}
                            </td>
                            <td>
                                @can('appointment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('patient.appointments.show', $appointment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                               
                                @can('session_create')
                                @if( $appointment->status!=2 && $appointment->status!=0 && $appointment->type==1)
                                <a href="{{ route('doctor.sessions.create', $appointment->id) }}" class="btn btn-info btn-xs" >Create Session</a>
                                @endif
                                @endcan
                                @if($appointment->status==0)
                                @can('appointment_accept')
                        <a href="{{ route('doctor.appointment.accept', $appointment->id) }}" class="btn btn-success btn-xs" >Accept</a>

                                @endcan
                                @can('appointment_reject')
                        <a href="{{ route('doctor.appointment.reject', $appointment->id) }}" class="btn btn-danger btn-xs" >Reject</a>

                                @endcan

                                @endif


                                @can('appointment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.appointments.edit', $appointment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('appointment_delete')
                                    <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
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
@can('appointment_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.appointments.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Appointment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
