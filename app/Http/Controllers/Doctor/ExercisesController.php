<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Exercise;

class ExercisesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('exercise_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $excercises = Exercise::all();

        return view('doctor.exercises.index', compact('excercises'));
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

        return view('doctor.exercises.show', compact('exercise'));
    }


}
