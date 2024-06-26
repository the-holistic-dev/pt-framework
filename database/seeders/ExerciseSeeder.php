<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Exercise::create([
      'name' => 'Press - BB - Flat',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Press - DB - Flat',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Press - BB - Incline',
      'video' => ''
    ]);
    Exercise::create([
      'name' => 'Press - BB - Incline',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Press - Seated - DB',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Press - DB - Incline',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Chin up',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Lat pulldown - Neutral',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Lat pulldown - Chest Supported - Neutral',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Row - Seated - Neutral',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Pressdown - Standing - Neutral',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Curl - Seated - Supinated - DB',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Curl - Spider - Supinated - DB',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Curl - Neutral - DB',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Squat - BB',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Deadlift - BB',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Deadlift - Cage',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Romanian Deadlift - BB',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Romanian Deadlift - DB',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Split Squat',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Leg Curl - Lying',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Leg Curl - Seated',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Leg Curl - Standing',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Leg Extension',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Leg Press',
      'video' => ''
    ]);

    Exercise::create([
      'name' => 'Back Extension',
      'video' => ''
    ]);
  }
}
