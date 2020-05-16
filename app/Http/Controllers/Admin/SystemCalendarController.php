<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
use App\Http\Controllers\Controller;
use \Crypt;

class SystemCalendarController extends Controller
{

    public function index()
    {
        $events = [];

        $appointments = Appointment::all();

        foreach ($appointments as $appointment) {
            if (!$appointment->start_time) {
                continue;
            }

            $events[] = [
                'title' => $appointment->patient->name . ' with Dr. '.$appointment->doctor->first_name.'.',
                'start' => $appointment->start_date,
                'url'   => route('calendar.appointments.show', Crypt::encrypt($appointment->id)),
            ];
        }

        return view('doctor.calendar.calendar', compact('events'));
    }
}
