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
        $appointment = Appointment::create($request->all());

        return redirect()->back()->with('message', 'Your registered Information has been successfully submitted! Please Verify through email');   

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
