@extends('layouts.admin')
@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Doctors</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Join Requests</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">


        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Join Requests</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <table class=" table table-bordered table-striped table-hover datatable datatable-JoinDoctor">
              <thead>
                <tr>
                  <th></th>
                  <th>ID</th>
                  <th>Doctor Name</th>
                  <th>Email</th>
                  <th>Phone #</th>
                  <th>Qualifications</th>
                  <th>Documents</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              @if($doctors->count() > 0)

            @foreach($doctors as $doctor)
                <tr>
                <td></td>
                <td>
                @if($doctor->user->photo)
                  <a href="{{ $doctor->user->photo->getUrl() }}" target="_blank">
                    <img src="{{ $doctor->user->photo->getUrl('thumb') }}" width="50px" height="50px">
                  </a>
                @endif
                </td>

                  <td>
                    <a class="users-list-name" href="{{ route('admin.doctors.show', $doctor->id) }}">{{$doctor->first_name}}</a>
                  </td>
                  <td>{{$doctor->user->email}}</td>
                  <td>{{$doctor->phone}}</td>
                  <td>{{$doctor->qualification}}</td>
                  <td>
                  @foreach($doctor->documents as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                        @endforeach
                  
                  </td>
                  <td>
                    <p class="users-list-date">

                    @can('doctor_delete')
                      <form action="{{ route('admin.doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <input type="submit" class="btn btn-sm btn-danger" value="Decline">
                        </form>
                    @endcan
                  <a href="{{ route('admin.approve_doctor', $doctor->id) }}" class="btn btn-sm btn-primary">
                     Approve
                  </a>
                    </p>
                  </td>
                </tr>
      @endforeach
                    @endif
              </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                      Go Back
                    </a>

          </div>

          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->

@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 5,
  });
  $('.datatable-JoinDoctor:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
