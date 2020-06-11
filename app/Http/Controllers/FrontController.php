<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDoctorRequest;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use App\Patient;
use Auth;

class FrontController extends Controller
{
    public function contact()
    {
        return view('front.contactus');
    }
    public function home()
    {
        $user = User::find(Auth::User()->id)->first();
        $user->load('roles');

        foreach($user->roles as $key => $roles)
        {
            if($roles->id==1)
            {
                return redirect()->route('admin.dashboard');
    
            }
    
            if($roles->id==2)
            {
        
                if ($user->doctor->is_registered == 0) { // or whatever status column name and value indicates a blocked user
    
                    $message = 'Sorry, You are not verified by the admin. Please check your email for more information.';
            
                    // Log the user out.
                    $this->logout($request);
            
                    // Return them to the log in form.
                    return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors([
                            // This is where we are providing the error message.
                            'email' => $message,
                        ]);
                }
                else{
                    return redirect()->route('doctor.dashboard');
    
                }
            
    
            }
            if($roles->id==3)
            {
                return redirect()->route('patient.dashboard');
    
            }
    
        
        }
    
    }
    
    public function profile()
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user=Auth::user();

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function doctors_search()
    {
        $doctors=Doctor::where('is_registered','1')->get();
      
        return view('front.doctors', compact('doctors'));

    }
    public function search(Request $request)
    {
        $name=$request->input('first_name');
        $city=$request->input('city');
        

        $doctors=Doctor::
        where(function($query) use ($name,$city) {
            $query->where('first_name', 'LIKE', '%'.$name.'%')
            ->where('is_registered', '=', 1)
            ->where('city', 'like', '%' . $city . '%');
        })
        ->orWhere(function($query) use ($name,$city) {
            $query->where('last_name', 'LIKE', '%'.$name.'%')
                  ->where('is_registered', '=', 1)
                  ->where('city', 'like', '%' . $city . '%');
                })
        ->get();

       
        return view('front.doctors', compact('doctors'));

    }

    public function patient_login()
    {
        return view('front.login');
    }
    public function patient_register()
    {
        return view('front.register_patient');
    }
    public function view_doctor_profile(Doctor $doctor)
    {

        return view('front.doctor_profilee', compact('doctor'));

    }
    public function bookAppointment($id)
    {
        abort_if(Gate::denies('appointment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $doctor=Doctor::where('id',$id)->first();
        $patient = Patient::where ('user_id',Auth::user()->id)->first();

        return view('front.book_appointment', compact('doctor','patient'));
    }
    public function appointment_book()
    {
        return view('front.appointment_book');
    }
    public function patient_dashboardd()
    {
        return view('front.patient_dashboard');
    }
/*    public function store(StoreDoctorRequest $request)
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
*/
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('first_name');
        $user->password = $request->input('email');
        $user->email = $request->input('email');
        $user->save();
        $user->roles()->sync(2);

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
        $doctor_details->qualification = $request->input('qualification');
        $doctor_details->department = $request->input('department');
        $doctor_details->experience = $request->input('experience');
        $doctor_details->short_biography = $request->input('short_biography');
        $doctor_details->days = $request->input('days');
        $doctor_details->hospital_name = $request->input('hospital_name');
        $doctor_details->hospital_timing = $request->input('hospital_timing');
        $doctor_details->is_registered = 0;

        $user->doctor()->save($doctor_details);


        return redirect()->back()->with('message', 'Your registered Information has been successfully submitted! Please Login');   

    }

}
