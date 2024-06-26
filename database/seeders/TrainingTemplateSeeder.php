<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrainingTemplate;

class TrainingTemplateSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    TrainingTemplate::create([
      'title' => '3 Days',
      'template_category_id' => '2',
      'user_id' => '2',
      'notes' => null
    ]);

    TrainingTemplate::create([
      'title' => '4 Days',
      'template_category_id' => '3',
      'user_id' => '2',
      'notes' => null
    ]);

    TrainingTemplate::create([
      'title' => '6 Days',
      'template_category_id' => '2',
      'user_id' => '2',
      'notes' => null
    ]);
  }
}
