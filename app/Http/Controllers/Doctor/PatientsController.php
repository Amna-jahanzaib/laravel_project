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
        $treatment_record = Treatment_Record::create($request->all());
        $session = Session::find($request->input('session_id'))->first();

        $session->status=5;
        $session->save();

        return redirect()->route('doctor.patients.index');
    }



}
