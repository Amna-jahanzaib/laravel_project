@extends('layouts.admin')
@section('content')
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Sessions </h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('patient.dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Sessions</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<div class="card">
    <div class="card-header">
        Booked Sessions
    </div>
    @if (\Session::has('success'))
                    <div class="alert alert-success">
        
                      <li>{!! \Session::get('success') !!}</li>
        
                    </div>
                @endif
                
                @if (\Session::has('error'))
                    <div class="alert alert-danger">
        
                      <span>{!! \Session::get('error') !!}</span>
        
                    </div>
                @endif

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Session">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                        Session
                        </th>
                        <th>
                        Doctor
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
                    @if($session->status!=0)
                        <tr data-entry-id="{{ $session->id }}">
                            <td>

                            </td>
                            <td>
                            <a href="{{ route('patient.sessions.show', $session->id) }}">Session_{{ $session->id ?? '' }}</a>                  
                            </td>
                            <td>
                            <a class="users-list-name" href="{{ route('patient.doctors.show', $session->doctor->id) }}">{{ $session->doctor->first_name ?? '' }}</a>
                        <span class="users-list-date">{{ $session->doctor->qualification ?? '' }}</span>                      
                            </td>
                            <td>
                                {{ App\Session::TYPE_SELECT[$session->type] ?? '' }}
                            </td>
                            <td>
                            {{ \Carbon\Carbon::parse($session->time )->toDayDateTimeString()}}


                            </td><td>
                            <span class=" btn-primary btn-xs" >
                            {{ App\Session::STATUS_SELECT[$session->status] ?? '' }}
                            </span>
                            </td>
                            
                            <td>
                            @can('patient_sessions')
                                    <a class="btn btn-xs btn-primary" href="{{ route('patient.sessions.show', $session->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                            @can('start_call')
                                @if( $session->status==3 && $session->type==1)
                                <a href="{{ route('patient.sessions.startcall', $session->id) }}" class="btn btn-danger btn-xs" >Start Session</a>
                                @endif
                                @endcan
                                @if(  $session->type==1 && $session->status==1)
                                @can('patient_payment')
                                <a href="{{ route('payment', $session->id) }}" class="btn  btn-success btn-xs" >Pay</a>
                                @endcan                    
                                @endif
                                @if(  $session->type==1 && $session->status==5)
                                @can('patient_payment')
                                <a href="{{ route('patient.patients.show', $session->patient->id) }}" class="btn  btn-info btn-xs" >View Treatment Record</a>
                                @endcan                    
                                @endif
                                @if(  $session->type==1 && $session->status==4)
                                @can('patient_payment')
                                <a href="{{ route('patient.patients.show', $session->patient->id) }}" class="btn  btn-info btn-xs" >View Treatment Record</a>
                                @endcan                    
                                @endif
                                @if(  $session->type==1 && $session->status==6)
                                @can('patient_payment')
                                <a href="{{ route('refund', $session->id) }}" class="btn  btn-danger btn-xs" >Refund Money</a>
                                @endcan                    
                                @endif

                               
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
  $('.datatable-Session:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
