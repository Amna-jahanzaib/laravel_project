<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
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
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = Doctor::all();
        $doctors=Doctor::where('is_registered','1')->get();
      
        return view('admin.doctors.index', compact('doctors'));
    }
    public function join_request()
    {
        abort_if(Gate::denies('doctor_join_request'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctors = Doctor::all();
        $doctors=Doctor::where('is_registered','0')->get();
      
        return view('admin.doctors.join_requests', compact('doctors'));
    }
    public function approve_doctor($id)
    {
        // $doctor=Doctor_details::take($id)->get()->first();
        $doctor=Doctor::where('id',$id)->first();
        // dd($doctor);
        return view('admin.doctors.approve_doctor')->with('doctor',$doctor);
    }

    public function acceptDoctor($id)
    {
        $doctor=Doctor::where('id',$id)->first();
        $doctor->is_registered=1;
        $name = $doctor->first_name;
        Mail::to($doctor->user->email)->send(new AcceptDoctorNotification($name));
        $doctor->save();

        //Mail::to($doctor->user->email)->send(new AcceptDoctorNotification($doctor->first_name));

        return redirect()->route('admin.doctors.join_requests');
    }

    public function rejectDoctor($id)
    {
        $doctor=Doctor::where('id',$id)->first();
        $id=$doctor->user->id;
        Mail::to($doctor->user->email)->send(new RejectDoctorNotification($doctor->first_name));
        foreach($doctor->documents as $key => $media){
         $media->forceDelete();
    }

        $doctor->delete();
        $data = User::findOrFail($id);
        $data->photo->delete();
        $data->delete();


        return redirect()->route('admin.doctors.join_requests');
    }

    public function create()
    {
        abort_if(Gate::denies('doctor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.doctors.create');
    }

    public function store(StoreDoctorRequest $request)
    {
        $this->validate($request, [
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = new User();
        $user->name = $request->input('first_name');
        $user->password = $request->input('password');
        $user->email = $request->input('email');
        $user->save();
        $user->roles()->sync(2);
        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        $request->offsetSet('user_id', $user->id);
        $doctor = Doctor::create($request->all());
        foreach ($request->input('documents', []) as $file) {
            $doctor->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('documents');
        }




        return redirect()->back()->with('message', 'Your registered Information has been successfully submitted! We will get back you through email');   

    }

    public function edit(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $doctor->load('user');

        return view('admin.doctors.edit', compact('users', 'doctor'));


    }

    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $this->validate($request, [
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required',
        ]);
        $user=User::where('id',Auth::User()->id)->first();
        $user->update($request->all());
        $doctor->update($request->all());

        if ($request->input('photo', false)) {
            if (!$user->photo || $request->input('photo') !== $user->photo->file_name) {
                $user->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }

        } elseif ($user->photo) {
            $user->photo->delete();
        }

        return redirect()->route('doctor.profile');

    }

    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->load('doctorAppointments');

        return view('admin.doctors.show', compact('doctor'));
    }

    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id=$doctor->user->id;
        foreach($doctor->documents as $key => $media){
            $media->forceDelete();
       }
   
        $doctor->delete();
        $data = User::findOrFail($id);
        $data->photo->delete();
        $data->delete();
        return back();

    }

    public function massDestroy(MassDestroyDoctorRequest $request)
    {
        Doctor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }


}
