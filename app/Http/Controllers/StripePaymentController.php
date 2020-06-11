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
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentNotification;

   
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
    public function index()
    {
        return view('doctor.stripe');
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
    public function refund(Session $session)
    {
        abort_if(Gate::denies('refund'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if($session->status!=6){
            return redirect()->route('patient.sessions.index')->with('error', 'Refund not Successfull!');

        }

        $payment=Payment::where('session_id',$session->id)->first();
        $charge_id =  $payment->charge_id;
        $amount = 1333;       
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $re = \Stripe\Refund::create(array(
        "charge" =>$charge_id
        ));
        if($re['status'] == 'succeeded') {
            $session->status=7;
            $session->appointment->status=6;
            $session->appointment->save();
            $session->save();
            
            return redirect()->route('patient.dashboard')->with('message', 'Refund Successfull! Refunds take 5-10 days to appear on a customer statement.');

        }

        return redirect()->route('patient.dashboard')->with('error', 'Refund not Successfull!');
    }
    public function transfer(Request $request)
    {
        abort_if(Gate::denies('withdraw'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create a Transfer to a connected account (later):
            \Stripe\Transfer::create([
                'amount' => Auth::User()->doctor->balance,
                'currency' => 'usd',
                'destination' => 'acct_1GeQuGCqRoHPIY3z',
                'transfer_group' => 'ORDER_95',
              ]);
        
        if($transfer['status'] == 'succeeded') {
            $doctor->balance=0;
            $doctor->save(); 
            
            return redirect()->route('patient.dashboard')->with('message', 'Transfer Successfull! Transfer take 5-10 days to appear on a customer statement.');

        }

        return redirect()->route('patient.dashboard')->with('error', 'Transfer not Successfull!');
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
            "description" => "Test payment from speechassistant.com.", 
            "receipt_email"=>"amma_durrani22@yahoo.com"
        ));

        if($charge['status'] == 'succeeded') {


        $payment = new Payment();
        $payment->session_id = $session->id;
        $payment->patient_id = $session->patient_id;
        $payment->doctor_id = $session->doctor_id;
        $payment->type = "card";
        $payment->payment_amount = 13;
        $payment->charge_id = $charge['id'];
        $payment->save();
        $session->status=3;
        $session->save();
        Mail::to($session->patient->user->email)->send(new PaymentNotification($payment));

        return redirect()->route('patient.dashboard')->with('message', 'Payment Successfull!');
        }
        else{
            return redirect()->route('patient.dashboard')->with('message', 'Payment not Successfull!');

        }
    }
}
