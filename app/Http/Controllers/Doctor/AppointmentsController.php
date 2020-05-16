<?php

namespace App\Http\Controllers\Doctor;

use Auth;
use App\Appointment;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Patient;
use App\Session;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
class AppointmentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('my_appointments'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::where('doctor_id', Auth::User()->doctor->id)->get();

        return view('doctor.appointments.index', compact('appointments'));
    }
    public function appointment_requests()
    {
        abort_if(Gate::denies('my_appointments'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::where('doctor_id', Auth::User()->doctor->id)
        ->where('status',0)
        ->get();

        return view('doctor.appointments.requests', compact('appointments'));
    }


    public function accept($id)
    {
        abort_if(Gate::denies('appointment_accept'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $appointment = Appointment::findOrFail($id);

        $appointment->status = 1;

        if($appointment->type==1){
            $session = new Session();
            $session->appointment_id=$appointment->id;
            $session->patient_id=$appointment->patient->id;
            $session->doctor_id=$appointment->doctor->id;
            $session->type=$appointment->type;
            $session->status=1;
            $session->time=$appointment->date_time.' '.$appointment->start_time;
            $session->save();    
        }


        $appointment->save();

        return back();
    }
    public function reject($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->status = 2;

        $appointment->save();

        return back();
    }


    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('patient', 'doctor','sessions');

        return view('doctor.appointments.show', compact('appointment'));
    }


}
