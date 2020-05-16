@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Doctors</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('patient.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Doctors</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>


<div class="card">
    <div class="card-header">
        Doctor list
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Doctor">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        
                  <th>ID</th>
                  <th>Doctor Name</th>
                  <th>Email</th>
                  <th>Phone #</th>
                  <th>Qualifications</th>
                  <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                @foreach($appointments->unique('doctor_id') as $key => $appointment)
                        <tr data-entry-id="{{ $appointment->patient->id }}">
                            <td>

                            </td>
                            <td>
                            @if($appointment->doctor->user->photo)
                                <a  href="{{  $appointment->doctor->user->photo->getUrl() }}" target="_blank">
                                    <img src="{{  $appointment->doctor->user->photo->getUrl('thumb') }}" class="img-circle img-bordered-sm img-size-50" width="50px" height="50px">
                                </a>
                            @endif

                            </td>
                            <td>
                            <a class="users-list-name" href="{{ route('patient.doctors.show', $appointment->doctor->id) }}">{{ $appointment->doctor->first_name ?? '' }}</a>
                            <span class="users-list-date">{{ $appointment->doctor->qualification ?? ''  }}</span>                                

                                
                            </td>
                            <td>
                                {{ $appointment->doctor->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->doctor->phone ?? '' }}
                            </td>
                            <td>
                                {{ $appointment->doctor->department ?? '' }}
                            </td>
                            
                            
                            <td>
                                @can('patient_doctors')
                                    <a class="btn btn-xs btn-primary" href="{{ route('patient.doctors.show', $appointment->doctor->id) }}">
                                        {{ trans('global.view') }} Profile
                                    </a>
                                @endcan


                            </td>

                        </tr>
                    @endforeach                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                      Go Back
                    </a>

        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('doctor_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.doctors.massDestroy') }}",
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
  $('.datatable-Doctor:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
