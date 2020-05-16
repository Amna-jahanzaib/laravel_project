<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Exercise;
use App\Session;

class ExercisesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('patient_sessions'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sessions = Session::where('patient_id', Auth::User()->patient->id)->get();

        return view('patient.exercises.index', compact('sessions'));
    }

    public function create()
    {
        abort_if(Gate::denies('exercise_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('doctor.exercises.create');
    }

    public function store(StoreExerciseRequest $request)
    {
        $excercise = Exercise::create($request->all());

        return redirect()->route('doctor.exercises.index');
    }

    public function edit(Exercise $exercise)
    {
        abort_if(Gate::denies('exercise_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('doctor.exercises.edit', compact('exercise'));
    }

    public function update(UpdateExerciseRequest $request, Exercise $exercise)
    {
        $exercise->update($request->all());

        return redirect()->route('doctor.exercises.index');
    }

    public function show(Exercise $exercise)
    {
        abort_if(Gate::denies('excercise_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('patient.exercises.show', compact('exercise'));
    }


}
