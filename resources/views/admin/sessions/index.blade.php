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
                            ID
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            Time
                        </th>
                        <th>
                            Patient
                        </th>
                        <th>
                            Doctor
                        </th>
                        <th>
                            Appointment
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
                                {{ $session->id ?? '' }}
                            </td>
                            <td>
                                {{ App\Session::TYPE_SELECT[$session->type] ?? '' }}
                            </td>
                            <td>
                                {{ $session->time ?? '' }}
                            </td>
                            <td>
                                {{ $session->patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $session->doctor->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $session->appointment->start_date ?? '' }}
                            </td>
                            <td>
                                @can('session_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('doctor.sessions.show', $session->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('session_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('doctor.sessions.edit', $session->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('session_delete')
                                    <form action="{{ route('doctor.sessions.destroy', $session->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
