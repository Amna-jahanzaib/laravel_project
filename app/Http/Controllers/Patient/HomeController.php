<?php

namespace App\Http\Controllers\Patient;
use Auth;
use Gate;
use App\Doctor;
use App\User;
use App\Patient;
use App\Role;
use App\Session;
use App\Appointment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class HomeController
{
    public function index()
    {
        abort_if(Gate::denies('patient_profile'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $appointments =Appointment::where('patient_id', Auth::User()->patient->id)->get();
        $sessions = Session::where('patient_id', Auth::User()->patient->id)->get();



        return view('patient.dashboard',compact('appointments'))->with('sessions',$sessions);

    }
    public function profile()
    {
        abort_if(Gate::denies('patient_profile'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user=Auth::user();

        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');
        $patient=Patient::where('user_id',Auth::User()->id)->first();
        $sessions = Session::where('patient_id', $patient->id)
        ->where('status',4)
        ->get();
        $patient->load('user', 'patientAppointments','patientSessions');

        return view('patient.profile', compact('patient','sessions'));


    }


}
