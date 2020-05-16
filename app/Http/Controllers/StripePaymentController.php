<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;

use Stripe;
use Auth;
use Gate;
use App\Appointment;
use App\Payment;
use Stripe\Customer;
use Stripe\Charge;
use Symfony\Component\HttpFoundation\Response;

   
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Appointment $appointment)

    {
        abort_if(Gate::denies('patient_appointments'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('patient.stripe',compact('appointment'));

    }
    public function stripe2(Session $session)

    {
        abort_if(Gate::denies('patient_appointments'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('patient.stripe',compact('session'));

    }
    public function stripe1()
    {
        return view('stripe1');
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request, Session $session)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Customer::create(array(
            'email' => Auth::user()->email,
            'name' => $request->name,
            'source'  => $request->stripeToken
        ));

        $charge = Charge::create(array(
            'customer' => $customer->id,
            'amount'   => 1333,
            'currency' => 'usd',
            "description" => "Test payment from speechassistant.com." 
        ));

        if($charge['status'] == 'succeeded') {


        $payment = new Payment();
        $payment->appointment_id = $session->appointment->id;
        $payment->patient_id = $session->patient_id;
        $payment->doctor_id = $session->doctor_id;
        $payment->type = $session->type;
        $payment->payment_amount = 13;
        $payment->save();
        $session->status=3;
        $session->save();
        return redirect()->route('patient.dashboard')->with('message', 'Payment Successfull!');
        }
        else{
            return redirect()->route('patient.dashboard')->with('message', 'Payment not Successfull!');

        }
    }
}
