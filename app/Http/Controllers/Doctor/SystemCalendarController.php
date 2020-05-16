<?php

namespace App\Http\Controllers\Doctor;

use App\Appointment;
use App\Session;
use App\Http\Controllers\Controller;
use \Crypt;
use Auth;

class SystemCalendarController extends Controller
{

    public function index()
    {
        $events = [];

        $appointments = Appointment::where('doctor_id', Auth::User()->doctor->id)
        ->where('status','<>',0)
        ->get();
        $sessions = Session::where('doctor_id', Auth::User()->doctor->id)->where('status','<>',0)->get();

        foreach ($appointments as $appointment) {
            if (!$appointment->start_time) {
                continue;
            }

            $events[] = [
                'title' => 'appointment with '.$appointment->patient->name.'.',
                'start' => $appointment->start_date,
                'url'   => route('doctor.appointments.show', $appointment->id),
            ];
        }

        foreach ($sessions as $session) {
            if (!$session->time) {
                continue;
            }

            $events[] = [
                'title' => 'session with '.$session->patient->name.'.',
                'start' => $session->time,
                'url'   => route('doctor.sessions.show', $session->id),
            ];
        }

        return view('doctor.calendar.calendar', compact('events'));
    }
}
