<?php

namespace Database\Seeders;

use App\Models\NutritionPlanMeal;
use Illuminate\Database\Seeder;

class NutritionPlanMealSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //Day 1
    NutritionPlanMeal::create([
      'name' => 'Breakfast',
      'nutrition_plan_day_id' => 1
    ]);
    NutritionPlanMeal::create([
      'name' => 'Lunch',
      'nutrition_plan_day_id' => 1
    ]);
    NutritionPlanMeal::create([
      'name' => 'Dinner',
      'nutrition_plan_day_id' => 1
    ]);
    //Day 2
    NutritionPlanMeal::create([
      'name' => 'Breakfast',
      'nutrition_plan_day_id' => 2
    ]);
    NutritionPlanMeal::create([
      'name' => 'Lunch',
      'nutrition_plan_day_id' => 2
    ]);
    NutritionPlanMeal::create([
      'name' => 'Dinner',
      'nutrition_plan_day_id' => 2
    ]);
  }
}
