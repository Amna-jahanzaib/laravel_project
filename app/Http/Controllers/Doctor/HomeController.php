<?php

namespace App\Http\Controllers\Doctor;
use Auth;
use Gate;
use App\Doctor;
use App\User;
use App\Patient;
use App\Session;
use App\Appointment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class HomeController
{
    public function index()
    {
        
        abort_if(Gate::denies('request_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');



        foreach(Auth::User()->roles as $key => $roles){
            if($roles->id==2){
                $sessions = Session::where('doctor_id', Auth::User()->doctor->id)->get();
                $appointments = Appointment::where('doctor_id', Auth::user()->doctor->id)->get();
                return view('doctor.dashboard',compact('doctors'))
                ->with('appointments',$appointments)
                ->with('sessions',$sessions);

            }
        }
    } 
    public function profile()
    {

        abort_if(Gate::denies('request_management'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor = Doctor::where('user_id',Auth::User()->id)->first();
        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctor->load('user');

        return view('doctor.profile', compact('users', 'doctor'));



    }

}
