<?php

namespace Database\Seeders;

use App\Models\Workout;
use Illuminate\Database\Seeder;

class WorkoutSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //Template 1
    Workout::create([
      'title' => 'Day 1',
      'training_template_id' => '1'
    ]);
    Workout::create([
      'title' => 'Day 2',
      'training_template_id' => '1'
    ]);

    Workout::create([
      'title' => 'Day 3',
      'training_template_id' => '1'
    ]);
    //Template 2
    Workout::create([
      'title' => 'Day 1',
      'training_template_id' => '2'
    ]);
    Workout::create([
      'title' => 'Day 2',
      'training_template_id' => '2'
    ]);
    Workout::create([
      'title' => 'Day 3',
      'training_template_id' => '2'
    ]);
    Workout::create([
      'title' => 'Day 4',
      'training_template_id' => '2'
    ]);
    //Template 3
    Workout::create([
      'title' => 'Day 1',
      'training_template_id' => '3'
    ]);
    Workout::create([
      'title' => 'Day 2',
      'training_template_id' => '3'
    ]);
    Workout::create([
      'title' => 'Day 3',
      'training_template_id' => '3'
    ]);
    Workout::create([
      'title' => 'Day 4',
      'training_template_id' => '3'
    ]);
    Workout::create([
      'title' => 'Day 5',
      'training_template_id' => '3'
    ]);
    Workout::create([
      'title' => 'Day 6',
      'training_template_id' => '3'
    ]);
  }
}
