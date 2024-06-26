<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NutritionPlanFood extends Model
{
  use HasFactory;
  protected $table = 'nutrition_plan_foods';
  protected $fillable = [
    'quantity',
    'factor',
    'cnf_food_measure_id',
    'cnf_food_id',
    'cnf_food_group_id',
    'nutrition_plan_meal_id',
  ];
  protected $appends = ['protein', 'fat', 'carbohydrate', 'calorie', 'fiber', 'factors'];

  public function cnfFoodMeasure(): BelongsTo
  {
    return $this->BelongsTo(CnfFoodMeasure::class);
  }

  public function cnfFoodGroup(): BelongsTo
  {
    return $this->BelongsTo(CnfFoodGroup::class);
  }

  public function cnfFood(): BelongsTo
  {
    return $this->BelongsTo(CnfFood::class);
  }

  public function meal(): BelongsTo
  {
    return $this->BelongsTo(NutritionPlanMeal::class);
  }

  protected function protein(): Attribute
  {
    return Attribute::make(get: function () {
      if (!is_null($this->cnf_food_id)) {
        $protein = DB::table('cnf_food_nutrients')
          ->join('cnf_foods', 'cnf_food_nutrients.cnf_food_id', '=', 'cnf_foods.cnf_food_id')
          ->join('cnf_conversion_factors', 'cnf_food_nutrients.cnf_food_id', '=', 'cnf_conversion_factors.cnf_food_id')
          ->join('cnf_food_measures', 'cnf_conversion_factors.cnf_food_measure_id', '=', 'cnf_food_measures.cnf_measure_id')
          ->select('cnf_food_nutrients.value', 'cnf_conversion_factors.factor')
          ->where('cnf_foods.cnf_food_id', '=', $this->cnf_food_id)
          ->where('cnf_food_nutrients.nutrient_id', '=', 203)
          ->where('cnf_conversion_factors.cnf_food_measure_id', '=', $this->cnf_food_measure_id)
          ->first();
        return round($protein->value * $protein->factor * $this->quantity);
      } else {
        $protein = CnfFoodGroup::where('food_group_id', $this->cnf_food_group_id)->first()->nutrients->protein;
        return $protein * $this->quantity;
      }
    });
  }

  protected function fat(): Attribute
  {
    return Attribute::make(get: function () {
      if (!is_null($this->cnf_food_id)) {
        $fat = DB::table('cnf_food_nutrients')
          ->join('cnf_foods', 'cnf_food_nutrients.cnf_food_id', '=', 'cnf_foods.cnf_food_id')
          ->join('cnf_conversion_factors', 'cnf_food_nutrients.cnf_food_id', '=', 'cnf_conversion_factors.cnf_food_id')
          ->join('cnf_food_measures', 'cnf_conversion_factors.cnf_food_measure_id', '=', 'cnf_food_measures.cnf_measure_id')
          ->select('cnf_food_nutrients.value', 'cnf_conversion_factors.factor')
          ->where('cnf_foods.cnf_food_id', '=', $this->cnf_food_id)
          ->where('cnf_food_nutrients.nutrient_id', '=', 204)
          ->where('cnf_conversion_factors.cnf_food_measure_id', '=', $this->cnf_food_measure_id)
          ->first();
        return round($fat->value * $fat->factor * $this->quantity);
      } else {
        $fat = CnfFoodGroup::where('food_group_id', $this->cnf_food_group_id)->first()->nutrients->fat;
        return $fat * $this->quantity;
      }
    });
  }

  protected function carbohydrate(): Attribute
  {
    return Attribute::make(get: function () {
      if (!is_null($this->cnf_food_id)) {
        $carb = DB::table('cnf_food_nutrients')
          ->join('cnf_foods', 'cnf_food_nutrients.cnf_food_id', '=', 'cnf_foods.cnf_food_id')
          ->join('cnf_conversion_factors', 'cnf_food_nutrients.cnf_food_id', '=', 'cnf_conversion_factors.cnf_food_id')
          ->join('cnf_food_measures', 'cnf_conversion_factors.cnf_food_measure_id', '=', 'cnf_food_measures.cnf_measure_id')
          ->select('cnf_food_nutrients.value', 'cnf_conversion_factors.factor')
          ->where('cnf_foods.cnf_food_id', '=', $this->cnf_food_id)
          ->where('cnf_food_nutrients.nutrient_id', '=', 205)
          ->where('cnf_conversion_factors.cnf_food_measure_id', '=', $this->cnf_food_measure_id)
          ->first();
        return round($carb->value * $carb->factor * $this->quantity);
      } else {
        $carb = CnfFoodGroup::where('food_group_id', $this->cnf_food_group_id)->first()->nutrients->carbohydrate;
        return $carb * $this->quantity;
      }
    });
  }

  protected function fiber(): Attribute
  {
    return Attribute::make(get: function () {
      if (!is_null($this->cnf_food_id)) {
        $fiber = DB::table('cnf_food_nutrients')
          ->join('cnf_foods', 'cnf_food_nutrients.cnf_food_id', '=', 'cnf_foods.cnf_food_id')
          ->join('cnf_conversion_factors', 'cnf_food_nutrients.cnf_food_id', '=', 'cnf_conversion_factors.cnf_food_id')
          ->join('cnf_food_measures', 'cnf_conversion_factors.cnf_food_measure_id', '=', 'cnf_food_measures.cnf_measure_id')
          ->select('cnf_food_nutrients.value', 'cnf_conversion_factors.factor')
          ->where('cnf_foods.cnf_food_id', '=', $this->cnf_food_id)
          ->where('cnf_food_nutrients.nutrient_id', '=', 291)
          ->where('cnf_conversion_factors.cnf_food_measure_id', '=', $this->cnf_food_measure_id)
          ->first();
        if (!is_null($fiber)) {
          return round($fiber->value * $fiber->factor * $this->quantity);
        } else {
          return 0;
        }
      } else {
        $fiber = CnfFoodGroup::where('food_group_id', $this->cnf_food_group_id)->first()->nutrients->fiber;
        return $fiber * $this->quantity;
      }
    });
  }

  protected function calorie(): Attribute
  {
    return Attribute::make(get: function () {
      if (!is_null($this->cnf_food_id)) {
        $calorie = DB::table('cnf_food_nutrients')
          ->join('cnf_foods', 'cnf_food_nutrients.cnf_food_id', '=', 'cnf_foods.cnf_food_id')
          ->join('cnf_conversion_factors', 'cnf_food_nutrients.cnf_food_id', '=', 'cnf_conversion_factors.cnf_food_id')
          ->join('cnf_food_measures', 'cnf_conversion_factors.cnf_food_measure_id', '=', 'cnf_food_measures.cnf_measure_id')
          ->select('cnf_food_nutrients.value', 'cnf_conversion_factors.factor')
          ->where('cnf_foods.cnf_food_id', '=', $this->cnf_food_id)
          ->where('cnf_food_nutrients.nutrient_id', '=', 208)
          ->where('cnf_conversion_factors.cnf_food_measure_id', '=', $this->cnf_food_measure_id)
          ->first();
        return round($calorie->value * $calorie->factor * $this->quantity);
      } else {
        $calorie = CnfFoodGroup::where('food_group_id', $this->cnf_food_group_id)->first()->nutrients->calorie;
        return $calorie * $this->quantity;
      }
    });
  }

  protected function factors(): Attribute
  {
    return Attribute::make(get: function () {
      if (!is_null($this->cnf_food_id)) {
        return DB::table('cnf_conversion_factors')
          ->join('cnf_food_measures', 'cnf_food_measures.cnf_measure_id', '=', 'cnf_conversion_factors.cnf_food_measure_id')
          ->select('cnf_conversion_factors.factor', 'cnf_conversion_factors.cnf_food_measure_id', 'cnf_food_measures.id', 'cnf_food_measures.name')
          ->where('cnf_conversion_factors.cnf_food_id', '=', $this->cnf_food_id)
          ->get();
      } else {
        return null;
      }
    });
  }
}
