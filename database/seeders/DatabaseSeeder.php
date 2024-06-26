<?php

namespace Database\Seeders;

use App\Models\CnfFood;
use App\Models\CnfFoodGroup;
use App\Models\CnfFoodNutrient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      PermissionSeeder::class,
      UserSeeder::class,
      ExerciseSeeder::class,
      TrainingPlanSeeder::class,
      TemplateCategorySeeder::class,
      TrainingTemplateSeeder::class,
      WorkoutSeeder::class,
      ExerciseParameterSeeder::class,
      CnfFoodGroupSeeder::class,
      CnfFoodSeeder::class,
      CnfFoodMeasureSeeder::class,
      CnfConversionFactorSeeder::class,
      CnfFoodNutrientSeeder::class,
    ]);
    $this->setCuratedFoods();
    $this->call([
      NutritionTemplateSeeder::class,
      NutritionPlanDaySeeder::class,
      NutritionPlanMealSeeder::class,
      NutritionPlanFoodSeeder::class,
    ]);
  }

  public function setCuratedFoods()
  {
    $meatGroupIds = [5, 10, 13, 15, 17];
    $cnfFoodGroup = CnfFoodGroup::all();
    $cnfFoodGroup->each(function (CnfFoodGroup $group) use ($meatGroupIds) {
      $foods = CnfFood::where('cnf_food_group_id', $group->food_group_id)->get();
      $foods->each(function (CnfFood $food) use ($group, $meatGroupIds) {
        $fat = CnfFoodNutrient::where('cnf_food_id', $food->cnf_food_id)->where('nutrient_id', 204)->first();
        if ($group->food_group_id == 1 && $fat->value <= 5) {
          $food->curated = true;
          $food->save();
        }
        if ($group->food_group_id == 4 && str_contains($food->name, 'Vegetable oil')) {
          $food->curated = true;
          $food->save();
        }
        if ($group->food_group_id == 6 && str_contains($food->name, 'oats')) {
          $food->curated = true;
          $food->save();
        }
        if ($group->food_group_id == 7 && str_contains($food->name, 'Deli-meat')) {
          $food->curated = true;
          $food->save();
        }
        if ($group->food_group_id == 9 && str_contains($food->name, 'raw') && str_contains($food->name, 'frozen')) {
          $food->curated = true;
          $food->save();
        }
        if ($group->food_group_id == 11) {
          $food->curated = true;
          $food->save();
        }
        if ($group->food_group_id == 12 && str_contains($food->name, 'roasted')) {
          $food->curated = true;
          $food->save();
        }
        if ($group->food_group_id == 14 && str_contains($food->name, 'Plant-based beverage')) {
          $food->curated = true;
          $food->save();
        }
        if ($group->food_group_id == 16 && str_contains($food->name, 'canned')) {
          $food->curated = true;
          $food->save();
        }
        if ($group->food_group_id == 18 && str_contains($food->name, 'Bread') && !str_contains($food->name, 'toasted')) {
          $food->curated = true;
          $food->save();
        }
        if ($group->food_group_id == 20 && str_contains($food->name, 'cooked')) {
          $food->curated = true;
          $food->save();
        }
        //meats
        if (in_array($group->food_group_id, $meatGroupIds) && $fat->value <= 15) {
          $food->curated = true;
          $food->save();
        }
      });
    });
  }
}
