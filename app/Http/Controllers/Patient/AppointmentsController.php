<?php

namespace App\Http\Controllers\Patient;

use Auth;
use App\Appointment;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAppointmentRequest;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Patient;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class AppointmentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('patient_appointments'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::where('patient_id', Auth::User()->patient->id)->get();
        return view('patient.appointments.index', compact('appointments'));
    }
    public function appointment_requests()
    {
        abort_if(Gate::denies('patient_appointments_pending'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::where('patient_id', Auth::User()->patient->id)
        ->where('status',0)
        ->get();

        return view('patient.appointments.requests', compact('appointments'));
    }
    public function create()
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.appointments.create', compact('patients', 'doctors'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        $now = Carbon::now('Asia/Karachi');

        $curentTime = Carbon::now()->addHours(5);

        if (Carbon::parse($request->input('start_date').$request->input('start_time'))->addHours(5)->isPast()){
            return redirect()->back()->with('error', 'Your selected appointment time is invalid. Please select time in future');   

        }
        if(Carbon::parse($request->input('start_date').$request->input('start_time'))->isSameAs('Y-m-d h',$now)){
            return redirect()->back()->with('error', 'Your selected appointment time is invalid. Please select time atleast 2-4 hours above the current time');   
        }


        $appointments=Appointment::where('patient_id',$request->input('patient_id'))->where('doctor_id',$request->input('doctor_id'))->where('status','<>','2')->get();
        foreach($appointments as $appointment){   
            if ($appointment->status==1  && $appointment->status==0 && $appointment->status==3 && $appointment->status==4)
            {
                return redirect()->back()->with('error', 'Your have already booked appointment with requested doctor which is not completed.Please respond to session request or wait for the doctor reply!');   
            }
            if (!$appointment->status==5)
            {
                return redirect()->back()->with('error', 'Your have already booked appointment with requested doctor which is not completed.Please respond to session request or wait for the doctor reply!');   
            }

            if (Carbon::parse($appointment->start_date.$appointment->start_time)->isSameAs('Y-m-d h', Carbon::parse($request->input('start_date').' '.$request->input('start_time'))))
          //  Carbon::createFromFormat('Y-m-d',$appointment->start_date)==Carbon::createFromFormat('Y-m-d',))
            {
                return redirect()->back()->with('error', 'Your have already booked appointment on this date time!');   
            }           
    
       }
       $myappointments=Appointment::where('patient_id',$request->input('patient_id'))->where('status','<>','2')->get();
       foreach($myappointments as $appointment){   
           if (Carbon::parse($appointment->start_date.$appointment->start_time)->isSameAs('Y-m-d h', Carbon::parse($request->input('start_date').' '.$request->input('start_time'))))
           {
               return redirect()->back()->with('error', 'Your have already booked appointment on this date time!');   
           } }          
           $myappointments=Appointment::where('doctor_id',$request->input('doctor_id'))->where('status','<>','2')->get();
           foreach($myappointments as $appointment){   
               if (Carbon::parse($appointment->start_date.$appointment->start_time)->isSameAs('Y-m-d h', Carbon::parse($request->input('start_date').' '.$request->input('start_time'))))
               {
                   return redirect()->back()->with('error', 'Doctor has already booked appointment on this date time!');   
               } }  

        

   $appointment = Appointment::create($request->all());



    return redirect()->back()->with('message', 'Your appointment is booked sucessfully');   



    }

    public function edit(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctors = Doctor::all()->pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $appointment->load('patient', 'doctor');

        return view('admin.appointments.edit', compact('patients', 'doctors', 'appointment'));
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->all());

        return redirect()->route('admin.appointments.index');

    }

    public function show(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->load('patient', 'doctor');

        return view('patient.appointments.show', compact('appointment'));
    }



    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointment->delete();

        return back();

    }

    public function massDestroy(MassDestroyAppointmentRequest $request)
    {
        Appointment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
