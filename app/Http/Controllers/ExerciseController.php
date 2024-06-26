<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
  //Get all exercises
  public function index()
  {
    return view('exercise.index', ['heading' => 'Exercises', "exercises" => Exercise::all()]);
  }

  //Get single exercise
  public function show(Exercise $exercise)
  {
    return view('exercise.show', ['exercise' => $exercise]);
  }
}
