<?php

namespace App\Http\Controllers\Doctor;

use App\Appointment;
use Auth;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySessionRequest;
use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Patient;
use App\Session;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('session_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessions = Session::where('doctor_id', Auth::User()->doctor->id)->get();

        return view('doctor.sessions.index', compact('sessions'));
    }
    public function session_requests()
    {
        abort_if(Gate::denies('session_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessions = Session::where('doctor_id', Auth::User()->doctor->id)
        ->where('status',0)
        ->get();

        return view('doctor.sessions.requests', compact('sessions'));
    }
    public function accept($id)
    {
        abort_if(Gate::denies('appointment_accept'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sessions = Session::findOrFail($id);

        $sessions->status = 1;

        $sessions->save();

        return back();
    }
    public function reject($id)
    {
        $sessions = Session::findOrFail($id);

        $sessions->status = 2;

        $sessions->save();

        return back();
    }


    public function create(Appointment $appointment)
    {
        abort_if(Gate::denies('session_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('doctor.sessions.create', compact( 'appointment'));
    }

    public function store(StoreSessionRequest $request)
    {
        $session = Session::create($request->all());

        return redirect()->route('doctor.sessions.index');
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
        abort_if(Gate::denies('session_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $session->load('patient', 'doctor', 'appointment');

        return view('doctor.sessions.show', compact('session'));
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
