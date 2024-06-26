<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;
use App\Models\ExerciseParameters;

class ExerciseParameterSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //Workout 1
    ExerciseParameters::create([
      'order' => 'A1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '1',
    ]);

    ExerciseParameters::create([
      'order' => 'A2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '1',
    ]);

    ExerciseParameters::create([
      'order' => 'B1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '1',
    ]);

    ExerciseParameters::create([
      'order' => 'B2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '1',
    ]);

    ExerciseParameters::create([
      'order' => 'C1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '1',
    ]);

    ExerciseParameters::create([
      'order' => 'C2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '1',
    ]);
    //Workout 2
    ExerciseParameters::create([
      'order' => 'A1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '2',
    ]);

    ExerciseParameters::create([
      'order' => 'A2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '2',
    ]);

    ExerciseParameters::create([
      'order' => 'B1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '2',
    ]);

    ExerciseParameters::create([
      'order' => 'B2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '2',
    ]);

    ExerciseParameters::create([
      'order' => 'C1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '2',
    ]);

    ExerciseParameters::create([
      'order' => 'C2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '2',
    ]);
    //Workout 3
    ExerciseParameters::create([
      'order' => 'A1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '3',
    ]);

    ExerciseParameters::create([
      'order' => 'A2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '3',
    ]);

    ExerciseParameters::create([
      'order' => 'B1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '3',
    ]);

    ExerciseParameters::create([
      'order' => 'B2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '3',
    ]);

    ExerciseParameters::create([
      'order' => 'C1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '3',
    ]);

    ExerciseParameters::create([
      'order' => 'C2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '3',
    ]);
    //Workout 4
    ExerciseParameters::create([
      'order' => 'A1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '4',
    ]);

    ExerciseParameters::create([
      'order' => 'A2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '4',
    ]);

    ExerciseParameters::create([
      'order' => 'B1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '4',
    ]);

    ExerciseParameters::create([
      'order' => 'B2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '4',
    ]);
    //Workout 5
    ExerciseParameters::create([
      'order' => 'A1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '5',
    ]);

    ExerciseParameters::create([
      'order' => 'A2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '5',
    ]);

    ExerciseParameters::create([
      'order' => 'B1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '5',
    ]);

    ExerciseParameters::create([
      'order' => 'B2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '5',
    ]);

    ExerciseParameters::create([
      'order' => 'C1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '5',
    ]);

    ExerciseParameters::create([
      'order' => 'C2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '5',
    ]);
    //Workout 7
    ExerciseParameters::create([
      'order' => 'A1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '6',
    ]);

    ExerciseParameters::create([
      'order' => 'A2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '6',
    ]);

    ExerciseParameters::create([
      'order' => 'B1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '6',
    ]);

    ExerciseParameters::create([
      'order' => 'B2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '6',
    ]);
    //Workout 7
    ExerciseParameters::create([
      'order' => 'A1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '7',
    ]);

    ExerciseParameters::create([
      'order' => 'A2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '7',
    ]);

    ExerciseParameters::create([
      'order' => 'B1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '7',
    ]);

    ExerciseParameters::create([
      'order' => 'B2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '7',
    ]);

    ExerciseParameters::create([
      'order' => 'C1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '7',
    ]);

    ExerciseParameters::create([
      'order' => 'C2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '7',
    ]);
    //Workout 8
    ExerciseParameters::create([
      'order' => 'A1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '8',
    ]);

    ExerciseParameters::create([
      'order' => 'A2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '8',
    ]);

    ExerciseParameters::create([
      'order' => 'B1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '8',
    ]);

    ExerciseParameters::create([
      'order' => 'B2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '8',
    ]);

    ExerciseParameters::create([
      'order' => 'C1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '8',
    ]);

    ExerciseParameters::create([
      'order' => 'C2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '8',
    ]);
    //Workout 9
    ExerciseParameters::create([
      'order' => 'A1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '10',
    ]);

    ExerciseParameters::create([
      'order' => 'A2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '9',
    ]);

    ExerciseParameters::create([
      'order' => 'B1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '9',
    ]);

    ExerciseParameters::create([
      'order' => 'B2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '9',
    ]);

    ExerciseParameters::create([
      'order' => 'C1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '9',
    ]);

    ExerciseParameters::create([
      'order' => 'C2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '9',
    ]);
    //Workout 10
    ExerciseParameters::create([
      'order' => 'A1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '10',
    ]);

    ExerciseParameters::create([
      'order' => 'A2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '10',
    ]);

    ExerciseParameters::create([
      'order' => 'B1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '10',
    ]);

    ExerciseParameters::create([
      'order' => 'B2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '10',
    ]);

    ExerciseParameters::create([
      'order' => 'C1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '10',
    ]);

    ExerciseParameters::create([
      'order' => 'C2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '10',
    ]);
    //Workout 11
    ExerciseParameters::create([
      'order' => 'A1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '11',
    ]);

    ExerciseParameters::create([
      'order' => 'A2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '11',
    ]);

    ExerciseParameters::create([
      'order' => 'B1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '11',
    ]);

    ExerciseParameters::create([
      'order' => 'B2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '11',
    ]);

    ExerciseParameters::create([
      'order' => 'C1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '11',
    ]);

    ExerciseParameters::create([
      'order' => 'C2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '11',
    ]);
    //Workout 12
    ExerciseParameters::create([
      'order' => 'A1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '12',
    ]);

    ExerciseParameters::create([
      'order' => 'A2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '12',
    ]);

    ExerciseParameters::create([
      'order' => 'B1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '12',
    ]);

    ExerciseParameters::create([
      'order' => 'B2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '12',
    ]);

    ExerciseParameters::create([
      'order' => 'C1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '12',
    ]);

    ExerciseParameters::create([
      'order' => 'C2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '12',
    ]);
    //Workout 12
    ExerciseParameters::create([
      'order' => 'A1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '13',
    ]);

    ExerciseParameters::create([
      'order' => 'A2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '120',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '13',
    ]);

    ExerciseParameters::create([
      'order' => 'B1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '13',
    ]);

    ExerciseParameters::create([
      'order' => 'B2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '90',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '13',
    ]);

    ExerciseParameters::create([
      'order' => 'C1',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '13',
    ]);

    ExerciseParameters::create([
      'order' => 'C2',
      'set' => '3',
      'rep' => '12',
      'tempo' => '3010',
      'rest' => '60',
      'technique' => null,
      'note' => null,
      'exercise_id' => Exercise::all()->random(1)->first()->id,
      'workout_id' => '13',
    ]);
  }
}
