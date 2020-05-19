@extends('layouts.admin')
@section('content')
<section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Payments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('doctor.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Payments</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

@can('withdraw')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("withdraw") }}">
            Withdraw Money
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.payment.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Payment">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Session
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.doctor') }}
                        </th>
                        <th>
                            {{ trans('cruds.doctor.fields.username') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.patient') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.payment.fields.payment_amount') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $key => $payment)
                        <tr data-entry-id="{{ $payment->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $payment->session_id ?? '' }}
                            </td>
                            <td>
                                {{ $payment->doctor->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $payment->doctor->username ?? '' }}
                            </td>
                            <td>
                                {{ $payment->patient->name ?? '' }}
                            </td>
                            <td>
                                {{ $payment->type ?? '' }}
                            </td>
                            <td>
                                {{ $payment->payment_amount ?? '' }}
                            </td>
                            <td>
                                @can('payment_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('doctor.payments.show', $payment->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('payment_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('doctor.payments.edit', $payment->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('payment_delete')
                                    <form action="{{ route('doctor.payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    pageLength: 10,
  });
  $('.datatable-Payment:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
