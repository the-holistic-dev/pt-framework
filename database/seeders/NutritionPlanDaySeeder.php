<?php

namespace Database\Seeders;

use App\Models\NutritionPlanDay;
use Illuminate\Database\Seeder;

class NutritionPlanDaySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    NutritionPlanDay::create([
      'title' => 'Day 1',
      'nutrition_template_id' => 1
    ]);
    NutritionPlanDay::create([
      'title' => 'Day 2',
      'nutrition_template_id' => 1
    ]);
  }
}
