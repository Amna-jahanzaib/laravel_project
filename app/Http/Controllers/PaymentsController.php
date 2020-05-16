<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Appointment;


class PaymentsController extends Controller
{
    public function pay(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $token = request('stripeToken');

        $charge = Charge::create([
            'amount' => 1000,
            'currency' => 'usd',
            'description' => 'Test Book',
            'source' => $token,
        ]);
        $appointment = Appointemnt::find($request->input('appointment_id'))->first();
        $payment = new Payment();
        $payment->appointment_id = $appointment->id;
        $payment->patient_id = $appointment->patient_id;
        $payment->doctor_id = $appointment->doctor_id;
        $payment->type = $appointment->type;
        $payment->payment_amount = $appointment->payment_amount;
        $payment->save();

        return 'Payment Success!';
    }
}