<?php

namespace App\Http\Controllers\Patient;

use App\Doctor;
use App\Appointment;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDoctorRequest;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Mail\AcceptDoctorNotification;
use App\Mail\RejectDoctorNotification;


class DoctorController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('patient_doctors'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::where('patient_id', Auth::User()->patient->id)->get();
      
        return view('patient.doctors.index', compact('appointments'));
    }
    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('patient_doctors'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->load('doctorAppointments');

        return view('patient.doctors.show', compact('doctor'));
    }


}
