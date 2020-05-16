<?php

namespace App\Http\Controllers\Admin;
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
        
        $ndoctors=Doctor::where('is_registered','0')->get();
        $doctors=Doctor::where('is_registered','1')->get();
        $patients=Patient::all();
        $admin=User::all();
        $appointments =Appointment::all();
        $sessions = Session::all();



        foreach(Auth::User()->roles as $key => $roles){
            if($roles->id==2){
                $sessions = Session::where('doctor_id', Auth::User()->doctor->id)->get();
                $appointments = Appointment::where('doctor_id', Auth::user()->doctor->id)->get();
                return view('doctor.dashboard',compact('doctors'))->with('patients',$patients)
                ->with('appointments',$appointments)
                ->with('sessions',$sessions);

            }

        }
        return view('admin.dashboard',compact('doctors'))->with('patients',$patients)
                                                         ->with('doctors',$doctors)
                                                         ->with('ndoctors',$ndoctors)
                                                         ->with('appointments',$appointments)
                                                         ->with('sessions',$sessions)
                                                         ->with('users',$admin);

    }
    public function profile()
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user=Auth::user();

        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('admin.profile', compact('roles', 'user'));

    }


}
