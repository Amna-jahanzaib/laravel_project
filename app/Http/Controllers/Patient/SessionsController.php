<?php

namespace App\Http\Controllers\Patient;

use App\Appointment;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySessionRequest;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Patient;
use App\User;
use App\Session;
use Gate;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('patient_sessions'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessions = Session::where('patient_id', Auth::User()->patient->id)->get();

        return view('patient.sessions.index', compact('sessions'));
    }
    public function session_requests()
    {
        abort_if(Gate::denies('patient_sessions'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessions = Session::where('patient_id', Auth::User()->patient->id)
        ->where('status',0)
        ->get();

        return view('patient.sessions.requests', compact('sessions'));
    }
    public function startcall(Session $session)
    {
        abort_if(Gate::denies('start_call'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $doctor = Doctor::findOrFail($session->doctor->id);


        if(Carbon::parse( $session->time )->isSameHour(Carbon::now('Asia/Karachi') ) )
        {
            $session->status = 4;
            $doctor->balance=$doctor->balance+13;
            $session->save();
            $doctor->save();
    
            return redirect()->back()->with('success', 'Your session completed  now');   

        }
        if(Carbon::now('Asia/Karachi')->isSameHour(Carbon::parse( $session->time )->addHours(1) )){
        $session->status = 4;

            $session->save();
            $doctor->balance=$doctor->balance+13;
            $session->save();
            $doctor->save();
            return redirect()->back()->with('success', 'Your session completed  now');   

        }
        if(Carbon::parse( $session->time )->subHours(5)->isPast()){
            $session->status = 6;
            $session->save();

            return redirect()->back()->with('error', 'Your session expired You can refund your money');   
        }
        


        return redirect()->back()->with('error', 'Your session is expired or not scheduled at current time');   
    }

    public function create(Appointment $appointment)
    {
        abort_if(Gate::denies('session_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $session = Session::where('patient_id', Auth::User()->patient->id)
        
        ->first();

        $patients = Patient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointments = Appointment::all()->pluck('start_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('patient.sessions.create', compact('patients','session', 'doctors', 'appointment'));
    }

    public function store(StoreSessionRequest $request)
    {        
        $now = Carbon::now('Asia/Karachi');

        if (Carbon::parse($request->input('time'))->addHours(5)->isPast()){
            return redirect()->back()->with('error', 'Your selected session time is invalid. Please select time in future');   

        }
        if(Carbon::parse($request->input('time'))->isSameAs('Y-m-d h',$now)){
            return redirect()->back()->with('error', 'Your selected session time is invalid. Please select time atleast 2-4 hours above the current time');   
        }
        $sessions=Session::where('patient_id',$request->input('patient_id'))->where('status','<>','2')->get();
        foreach($sessions as $session){   
            if (Carbon::parse($session->time)->isSameAs('Y-m-d h', Carbon::parse($request->input('start_date').' '.$request->input('start_time'))))
            {
                return redirect()->back()->with('error', 'Your have already booked session on this date time!');   
            }
         }

         $sessions=Session::where('patient_id',$request->input('patient_id'))->where('doctor_id',$request->input('doctor_id'))->where('status','<>','2')->where('status','<>','7')->where('status','<>','6')->get();
         foreach($sessions as $session){   
             if ($session->status==1  && $session->status==0 && $session->status==3 && $session->status==4)
             {
                 return redirect()->back()->with('error', 'Your have already booked session with requested doctor which is not completed.Please respond to session request or wait for the doctor reply!');   
             }
             if ($session->status!=5)
             {
                 return redirect()->back()->with('error', 'Your have already booked session with requested doctor which is not completed.Please respond to session request or wait for the doctor reply!');   
             }
            }
                          
 
         $sessions=Session::where('doctor_id',$request->input('doctor_id'))->where('status','<>','2')->get();
         foreach($sessions as $session){   
             if (Carbon::parse($session->time)->isSameAs('Y-m-d h', Carbon::parse($request->input('start_date').' '.$request->input('start_time'))))
             {
                 return redirect()->back()->with('error', 'Doctor has already booked session on this date time!');   
             }
          }          
 
        $appointment = Appointment::find($request->input('appointment_id'));
        $appointment->status=4;
        $appointment->save();

        $session = Session::create($request->all());
        Mail::to($session->patient->user->email)->send(new SessionNotification($session));

        return redirect()->route('patient.sessions.requests');
    }

    public function edit(Session $session)
    {
        abort_if(Gate::denies('session_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointments = Appointment::all()->pluck('start_date', 'id')->prepend(trans('global.pleaseSelect'), '');

        $session->load('patient', 'doctor', 'appointment');

        return view('admin.sessions.edit', compact('patients', 'doctors', 'appointments', 'session'));
    }

    public function update(UpdateSessionRequest $request, Session $session)
    {
        $session->update($request->all());

        return redirect()->route('doctor.sessions.index');
    }

    public function show(Session $session)
    {
        abort_if(Gate::denies('patient_sessions'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $session->load('patient', 'doctor', 'appointment');

        return view('patient.sessions.show', compact('session'));
    }

    public function destroy(Session $session)
    {
        abort_if(Gate::denies('session_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $session->delete();

        return back();
    }

    public function massDestroy(MassDestroySessionRequest $request)
    {
        Session::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
