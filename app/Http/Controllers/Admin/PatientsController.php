<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPatientRequest;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Patient;
use App\Appointment;
use App\User;
use App\Role;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Input;

class PatientsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('patient_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patients = Patient::all();

        return view('admin.patients.index', compact('patients'));
    }
    public function my_patients()
    {
        abort_if(Gate::denies('my_patients'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $appointments = Appointment::where('doctor_id', Auth::User()->doctor->id)->get();

        return view('doctor.patients.index', compact('appointments'));
    }
    public function show(Patient $patient)
    {
        abort_if(Gate::denies('patient_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $patient->load('user', 'patientAppointments');

        return view('admin.patients.show', compact('patient'));
    }

    public function store(StorePatientRequest $request)
    {
        $this->validate($request, [
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required',
        ]);
    

        $user = new User();
        $user->name = $request->input('name');
        $user->password = $request->input('password');
        $user->email = $request->input('email');
        $user->save();

        $user->roles()->sync(3);
        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        $patient = new Patient();
        $patient->name = $request->input('name');
        $patient->father_name = $request->input('father_name');
        $patient->age = $request->input('age');
        $patient->gender = $request->input('gender');
        $patient->disease = $request->input('disease');
        $patient->address = $request->input('address');
        $patient->country = $request->input('country');
        $patient->city = $request->input('city');
        $patient->phone = $request->input('phone');
        $user->patient()->save($patient);


        return redirect()->back()->with('message', 'Your registered Information has been successfully submitted! Please Login');   

    }
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $this->validate($request, [
            'password' => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required',
        ]);
        $request->offsetSet('email', Auth::User()->email);

        $user=User::where('id',Auth::User()->id)->first();
        $user->password = $request->input('password');

        $user->update();

        $patient->update($request->all());

        if ($request->input('photo', false)) {
            if (!$user->photo || $request->input('photo') !== $user->photo->file_name) {
                $user->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }

        } elseif ($user->photo) {
            $user->photo->delete();
        }

        return redirect()->route('patient.profile');

    }


    public function destroy(Patient $patient)
    {
        abort_if(Gate::denies('patient_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id=$patient->user->id;
        $patient->delete();
        $data = User::findOrFail($id);
        $data->delete();


        return back();
    }

}
