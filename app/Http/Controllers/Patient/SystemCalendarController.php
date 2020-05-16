<?php

namespace App\Http\Controllers\Patient;

use App\Appointment;
use App\Session;
use App\User;
use App\Http\Controllers\Controller;
use \Crypt;
use Auth;

class SystemCalendarController extends Controller
{

    public function index()
    {
        $events = [];


        $appointments = Appointment::where('patient_id', Auth::User()->patient->id)
        ->where('status','<>',0)
        ->get();
        $sessions = Session::where('patient_id', Auth::User()->patient->id)->where('status','<>',0)->get();

        foreach ($appointments as $appointment) {
            if (!$appointment->start_time) {
                continue;
            }

            $events[] = [
                'title' => 'appointment with Dr. '.$appointment->doctor->first_name.'.',
                'start' => $appointment->start_date,
                'url'   => route('patient.appointments.show', $appointment->id),
            ];
        }

        foreach ($sessions as $session) {
            if (!$session->time) {
                continue;
            }

            $events[] = [
                'title' => 'session with Dr. '.$session->doctor->first_name.'.',
                'start' => $session->time,
                'url'   => route('patient.sessions.show', $session->id),
            ];
        }


        return view('patient.calendar.calendar', compact('events'));
    }
}
