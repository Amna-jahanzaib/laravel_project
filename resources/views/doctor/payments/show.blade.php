@extends('layouts.admin')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-5">
      
              <div class="col-md-6">
                            <img src="{{asset('img/AdminLTELogo.png')}}">
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">Invoice #{{$payment->id}}</p>
                            <p class="text-muted">Due to: {{$payment->created_at->format('d/M/Y')}}</p>
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="font-weight-bold mb-4">Client Information</p>
                            <p class="mb-1">{{ $payment->patient->name ?? '' }} {{ $payment->patient->father_name ?? '' }}, {{ $payment->patient->phone ?? '' }}</p>
                            <p>Address:{{ $payment->patient->address ?? '' }}</p>
                            <p class="mb-1">{{ $payment->patient->city ?? '' }}, {{ $payment->patient->country ?? '' }}</p>
                            <p class="mb-1">Email:{{ $payment->patient->user->emai ?? '' }}</p>
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4">Payment Details</p>
                            <p class="mb-1"><span class="text-muted">VAT: </span> 1425782</p>
                            <p class="mb-1"><span class="text-muted">VAT ID: </span> 10253642</p>
                            <p class="mb-1"><span class="text-muted">Payment Type: </span> {{ $payment->type ?? '' }}</p>
                            <p class="mb-1"><span class="text-muted">Name: </span> {{ $payment->patient->name ?? '' }}</p>
                        </div>
                    </div>

                    <div class="row p-5">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th class="border-0 text-uppercase small font-weight-bold">#
                        </th>
                        <th class="border-0 text-uppercase small font-weight-bold">
                            {{ trans('cruds.payment.fields.patient') }}
                        </th>
                        <th class="border-0 text-uppercase small font-weight-bold">
                            {{ trans('cruds.payment.fields.doctor') }}
                        </th>
                        <th class="border-0 text-uppercase small font-weight-bold">
                            {{ trans('cruds.payment.fields.appointment') }}
                        </th>
                        <th class="border-0 text-uppercase small font-weight-bold">
                            Session
                        </th>
                        <th class="border-0 text-uppercase small font-weight-bold">
                            {{ trans('cruds.payment.fields.type') }}
                        </th>
                        <th class="border-0 text-uppercase small font-weight-bold">
                            {{ trans('cruds.payment.fields.payment_amount') }}
                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                        {{ $payment->patient->name ?? '' }}
                                        </td>
                                        <td>
                                         {{ $payment->doctor->first_name ?? '' }}
                                        </td>
                                        <td>
                                        {{ $payment->appointment->id ?? '' }}
                                        </td>
                                        <td>21</td>
                                        <td>
                                        {{ $payment->type ?? '' }}
                                        </td>
                                        <td>
                                        {{ $payment->payment_amount ?? '' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h2 font-weight-light">${{ $payment->payment_amount ?? '' }}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Discount</div>
                            <div class="h2 font-weight-light">0%</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Sub - Total amount</div>
                            <div class="h2 font-weight-light">${{ $payment->payment_amount ?? '' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</div>


  @endsection
