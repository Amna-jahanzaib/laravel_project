<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\Http\Requests\StoreDoctorRequest;

class DoctorController extends Controller
{
    //
    //index or home page for admin
    public function index()
    {
        return view('doctor.dashboard');
    }
    public function appointment()
    {
        return view('doctor.appointment');
    }
    public function appointments()
    {
        return view('doctor.appointments');
    }
    public function treated_patients()
    {
        return view('doctor.patients');
    }
    public function unregistered_patient()
    {
        return view('doctor.patient_profile');
    }
    public function register_patient()
    {
        return view('doctor.profile_patient');
    }
    public function appointment_requests()
    {
        return view('doctor.appointment_requests');
    }
    public function register_doctor()
    {
        return view('front.register');
    }
    public function profile()
    {
        return view('doctor.profile');
    }
    public function add_treatment()
    {
        return view('doctor.add_treatment');
    }
    public function treatment()
    {
        return view('doctor.profile_patient');
    }
    public function schedule()
    {
        return view('doctor.schedule');
    }
    public function video_call()
    {
        return view('doctor.profile_patient');
    }
    public function payment()
    {
        return view('doctor.payment');
    }


    public function create()
    {
        return view('doctor.register');
    }

    public function store1(Request $request)
    {

    //   $request->validate([
    //         'first_name' => 'required',
    //         'last_name'=> 'required',
    //         'username'=> 'required',
    //         'email'=> 'required',
    //         'password'=> 'required',
    //         'confirm_password'=> 'required',
    //         'date_of_birth'=> 'required',
    //         'gender'=> 'required',
    //         'address'=> 'required',
    //         'country'=> 'required',
    //         'city'=> 'required',
    //         'state'=> 'required',
    //         'phone'=> 'required',
    //         //'avater'=> 'rquired',
    //         'qualification'=> 'required',
    //         'department'=> 'required',
   //           'experiance'=> 'required',
    //         'short_biography'=> 'required',
    //         'days'=> 'required',
    //         'time'=> 'required',
    //         'hospital_name'=> 'required',
    //         'hospital_timing'=> 'required',
    //         'hospital_address'=> 'required',
    //     ]);
            $doctor_details = new Doctor();
            $doctor_details->first_name = $request->input('first_name');
            //dd($doctor_details->first_name);
            $doctor_details->last_name = $request->input('last_name');
            $doctor_details->username = $request->input('username');
            $doctor_details->email = $request->input('email');

            //dd($request->input('password'));
            $doctor_details->date_of_birth = $request->input('date_of_birth');
            $doctor_details->gender = $request->input('gender');

            $doctor_details->address = $request->input('address');
            $doctor_details->country = $request->input('country');

            $doctor_details->city = $request->input('city');
            //dd($doctor_details->city);
            $doctor_details->state = $request->input('state');
            $doctor_details->phone = $request->input('phone');
            //dd($request->input('phone'));
            $doctor_details->avater = $request->input('avater');
            $doctor_details->qualification = $request->input('qualification');
            $doctor_details->department = $request->input('department');
            $doctor_details->experience = $request->input('experience');
            $doctor_details->short_biography = $request->input('short_biography');
            $doctor_details->days = $request->input('days');
            $doctor_details->time = $request->input('time');
            $doctor_details->hospital_name = $request->input('hospital_name');
            $doctor_details->hospital_timing = $request->input('hospital_timing');
            $doctor_details->hospital_address = $request->input('hospital_address');

            $doctor_details->save();
            return redirect()->back()->with('message', 'Your registered Information has been successfully submitted! Please Verify through email');   
        }
    public function store(StoreDoctorRequest $request)
    {
        $doctor = Doctor::create($request->all());

        if ($request->input('photo', false)) {
            $doctor->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $doctor->id]);
        }

        return redirect()->route('admin.doctors.index');

    }


}
