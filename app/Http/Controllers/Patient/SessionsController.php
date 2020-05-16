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

        $session->status = 4;

        $session->save();

        return back();
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
        $session = Session::create($request->all());

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
