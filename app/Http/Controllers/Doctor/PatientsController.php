<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPatientRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\StoreTreatmentRecordRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Patient;
use App\Treatment_Record;
use App\Appointment;
use App\Exercise;
use App\Session;
use App\User;
use App\Role;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\SessionNotification;
use Carbon\Carbon;

class PatientsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('my_patients'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::where('doctor_id', Auth::User()->doctor->id)->get();

        return view('doctor.patients.index', compact('appointments'));
    }
    public function show(Patient $patient)
    {
        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessions = Session::where('doctor_id', Auth::User()->doctor->id)
        ->where('patient_id',$patient->id)
        ->get();
        $patient->load('user', 'patientAppointments','patientSessions');

        return view('doctor.patients.show', compact('patient','sessions'));
    }
    public function add_treatment(Session $session )
    {
        abort_if(Gate::denies('my_patients'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $exercises = Exercise::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('doctor.patients.add_treatment', compact('exercises'))       
        ->with('session',$session );
    }

    public function store(StoreTreatmentRecordRequest $request)
    {
        if(!empty($request->input('next_session_date'))){
            $now = Carbon::now('Asia/Karachi')->format('Y-m-d h');
            $session_time=Carbon::parse($request->input('next_session_date').$request->input('next_session_time'))->format('Y-m-d h');
            
            
            if($session_time==$now){
                return redirect()->back()->with('error', 'Current time cannot be booked as next session start time');   
            }
    
            if (Carbon::parse($request->input('next_session_date').$request->input('next_session_time'))->addHours(5)->isPast()){
                return redirect()->back()->with('error', 'Your selected session time is invalid. Please select time in future');   
    
            }
            if(Carbon::parse($request->input('next_session_date').$request->input('next_session_time'))->isSameAs('Y-m-d h',Carbon::now('Asia/Karachi'))){
                return redirect()->back()->with('error', 'Your selected session time is invalid. Please select time atleast 2-4 hours above the current time');   
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
   
    
    
            $sessions=Session::where('doctor_id',$request->input('doctor_id'))->where('status','<>','2')->where('status','<>','7')->where('status','<>','6')->get();
            foreach($sessions as $session){   
    
                if (Carbon::parse($session->start_date.$session->start_time)->isSameAs('Y-m-d h', Carbon::parse($request->input('next_session_date').$request->input('next_session_time'))))
                {
                    return redirect()->back()->with('error', 'Your have already booked sesson on this date time!');   
                }           
        
           }    
    
           $msessions=Session::where('patient_id',$request->input('patient_id'))->where('status','<>','2')->where('status','<>','7')->where('status','<>','6')->get();
           foreach($msessions as $session){   
               if (Carbon::parse($session->start_date.$session->start_time)->isSameAs('Y-m-d h', Carbon::parse($request->input('next_session_date').$request->input('next_session_time'))))
               {
                   return redirect()->back()->with('error', 'Patient has already booked appointment on this date time!');   
               } }  
               
               
               $session = Session::find($request->input('session_id'));
               $treatment_record = Treatment_Record::create($request->all());

               $session->status='5';
               $session->save();
               $session_new = new Session();
               $session_new->appointment_id=$session->appointment->id;
               $session_new->patient_id=$session->patient->id;
               $session_new->doctor_id=$session->doctor->id;
               $session_new->type=$session->type;
               $session_new->status=1;
               $session_new->time=$request->input('next_session_date').$request->input('next_session_time');
               $session_new->save();
               Mail::to($session->patient->user->email)->send(new SessionNotification($session_new));
   
       
        return redirect()->route('doctor.sessions.index')->with('message', 'Your treatment record is saved');   
       
        }
        $request->offsetSet('next_session_date', Null);
        $request->offsetSet('next_session_time', Null);

        $treatment_record = Treatment_Record::create($request->all());
        $session = Session::find($request->input('session_id'));

        $session->status='5';
        $session->save();
        $appointment = Appointment::find($session->appointment->id);
        $appointment->status=5;
        $appointment->save();
        return redirect()->route('doctor.sessions.index')->with('message', 'Your treatment record is saved');
    }



}
