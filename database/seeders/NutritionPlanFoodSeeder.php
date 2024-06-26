<?php

namespace Database\Seeders;

use App\Models\CnfFood;
use App\Models\CnfFoodGroup;
use App\Models\CnfFoodMeasure;
use App\Models\CnfFoodNutrient;
use Illuminate\Database\Seeder;
use App\Models\NutritionPlanFood;
use App\Models\CnfConversionFactor;
use Illuminate\Support\Facades\Log;

class NutritionPlanFoodSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //Day 1 Meal 1
    $group = CnfFoodGroup::getCuratedFoodGroup()->random(1)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_group_id' => $group->food_group_id,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'nutrition_plan_meal_id' => 1,
    ]);
    $group = CnfFoodGroup::getCuratedFoodGroup()->random(1)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_group_id' => $group->food_group_id,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'nutrition_plan_meal_id' => 1,
    ]);
    $group = CnfFoodGroup::getCuratedFoodGroup()->random(1)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_group_id' => $group->food_group_id,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'nutrition_plan_meal_id' => 1,
    ]);
    //Day 1 Meal 2
    $group = CnfFoodGroup::getCuratedFoodGroup()->random(1)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_group_id' => $group->food_group_id,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'nutrition_plan_meal_id' => 2,
    ]);
    $group = CnfFoodGroup::getCuratedFoodGroup()->random(1)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_group_id' => $group->food_group_id,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'nutrition_plan_meal_id' => 2,
    ]);
    $group = CnfFoodGroup::getCuratedFoodGroup()->random(1)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_group_id' => $group->food_group_id,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'nutrition_plan_meal_id' => 2,
    ]);
    //Day 1 Meal 3
    $group = CnfFoodGroup::getCuratedFoodGroup()->random(1)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_group_id' => $group->food_group_id,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'nutrition_plan_meal_id' => 3,
    ]);
    $group = CnfFoodGroup::getCuratedFoodGroup()->random(1)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_group_id' => $group->food_group_id,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'nutrition_plan_meal_id' => 3,
    ]);
    $group = CnfFoodGroup::getCuratedFoodGroup()->random(1)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_group_id' => $group->food_group_id,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'nutrition_plan_meal_id' => 3,
    ]);
    //Day 2 Meal 1
    $food = CnfFood::all()->where('curated', 1)->random(1)->first();
    $factor = CnfConversionFactor::where('cnf_food_id', $food->cnf_food_id)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_measure_id' => $factor->cnf_food_measure_id,
      'cnf_food_id' => $food->cnf_food_id,
      'cnf_food_group_id' => null,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'factor' => $factor->factor,
      'nutrition_plan_meal_id' => 4,
    ]);
    $food = CnfFood::all()->where('curated', 1)->random(1)->first();
    $factor = CnfConversionFactor::where('cnf_food_id', $food->cnf_food_id)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_measure_id' => $factor->cnf_food_measure_id,
      'cnf_food_id' => $food->cnf_food_id,
      'cnf_food_group_id' => null,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'factor' => $factor->factor,
      'nutrition_plan_meal_id' => 4,
    ]);
    $food = CnfFood::all()->where('curated', 1)->random(1)->first();
    $factor = CnfConversionFactor::where('cnf_food_id', $food->cnf_food_id)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_measure_id' => $factor->cnf_food_measure_id,
      'cnf_food_id' => $food->cnf_food_id,
      'cnf_food_group_id' => null,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'factor' => $factor->factor,
      'nutrition_plan_meal_id' => 4,
    ]);
    //Day 2 Meal 2
    $food = CnfFood::all()->where('curated', 1)->random(1)->first();
    $factor = CnfConversionFactor::where('cnf_food_id', $food->cnf_food_id)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_measure_id' => $factor->cnf_food_measure_id,
      'cnf_food_id' => $food->cnf_food_id,
      'cnf_food_group_id' => null,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'factor' => $factor->factor,
      'nutrition_plan_meal_id' => 5,
    ]);
    $food = CnfFood::all()->where('curated', 1)->random(1)->first();
    $factor = CnfConversionFactor::where('cnf_food_id', $food->cnf_food_id)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_measure_id' => $factor->cnf_food_measure_id,
      'cnf_food_id' => $food->cnf_food_id,
      'cnf_food_group_id' => null,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'factor' => $factor->factor,
      'nutrition_plan_meal_id' => 5,
    ]);
    $food = CnfFood::all()->where('curated', 1)->random(1)->first();
    $factor = CnfConversionFactor::where('cnf_food_id', $food->cnf_food_id)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_measure_id' => $factor->cnf_food_measure_id,
      'cnf_food_id' => $food->cnf_food_id,
      'cnf_food_group_id' => null,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'factor' => $factor->factor,
      'nutrition_plan_meal_id' => 5,
    ]);
    //Day 2 Meal 3
    $food = CnfFood::all()->where('curated', 1)->random(1)->first();
    $factor = CnfConversionFactor::where('cnf_food_id', $food->cnf_food_id)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_measure_id' => $factor->cnf_food_measure_id,
      'cnf_food_id' => $food->cnf_food_id,
      'cnf_food_group_id' => null,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'factor' => $factor->factor,
      'nutrition_plan_meal_id' => 6,
    ]);
    $food = CnfFood::all()->where('curated', 1)->random(1)->first();
    $factor = CnfConversionFactor::where('cnf_food_id', $food->cnf_food_id)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_measure_id' => $factor->cnf_food_measure_id,
      'cnf_food_id' => $food->cnf_food_id,
      'cnf_food_group_id' => null,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'factor' => $factor->factor,
      'nutrition_plan_meal_id' => 6,
    ]);
    $food = CnfFood::all()->where('curated', 1)->random(1)->first();
    $factor = CnfConversionFactor::where('cnf_food_id', $food->cnf_food_id)->first();
    $quantity = 1;
    NutritionPlanFood::create([
      'quantity' => $quantity,
      'cnf_food_measure_id' => $factor->cnf_food_measure_id,
      'cnf_food_id' => $food->cnf_food_id,
      'cnf_food_group_id' => null,
      'custom_food_portion_id' => null,
      'custom_food_id' => null,
      'factor' => $factor->factor,
      'nutrition_plan_meal_id' => 6,
    ]);
  }
}
