<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Crypt;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Appointment;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Mail\AcceptDoctorNotification;
use App\Mail\RejectDoctorNotification;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function show( $appointment_id)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $id=Crypt::decrypt($appointment_id); 
        $appointment=Appointment::find($id);

        return view('admin.appointments.show', compact('appointment'));
    }
    public function mail()
    {

        $name = 'Amna';
        Mail::to('amna_durrani22@yahoo.com')->send(new AcceptDoctorNotification($name));
     
    return 'Email was sent';
    }

}
