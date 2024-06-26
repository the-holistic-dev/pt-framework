<?php

namespace App\Models;

use stdClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CnfFood extends Model
{
  use HasFactory;

  protected $table = 'cnf_foods';
  protected $appends = ['protein', 'fat', 'carbohydrate', 'calorie', 'fiber', 'factors'];

  protected function protein(): Attribute
  {
    return Attribute::make(get: function () {
      return round(CnfFoodNutrient::where('cnf_food_id', $this->cnf_food_id)
        ->where('nutrient_id', 203)
        ->first()->value);
    });
  }

  protected function fat(): Attribute
  {
    return Attribute::make(get: function () {
      return round(CnfFoodNutrient::where('cnf_food_id', $this->cnf_food_id)
        ->where('nutrient_id', 204)
        ->first()->value);
    });
  }


  protected function carbohydrate(): Attribute
  {
    return Attribute::make(get: function () {
      return round(CnfFoodNutrient::where('cnf_food_id', $this->cnf_food_id)
        ->where('nutrient_id', 205)
        ->first()->value);
    });
  }


  protected function calorie(): Attribute
  {
    return Attribute::make(get: function () {
      return round(CnfFoodNutrient::where('cnf_food_id', $this->cnf_food_id)
        ->where('nutrient_id', 208)
        ->first()->value);
    });
  }


  protected function fiber(): Attribute
  {
    return Attribute::make(get: function () {
      $fiber = CnfFoodNutrient::where('cnf_food_id', $this->cnf_food_id)
        ->where('nutrient_id', 291)
        ->first();
      if (!is_null($fiber)) {
        return $fiber->value;
      } else {
        return 0;
      }
    });
  }


  protected function factors(): Attribute
  {
    return Attribute::make(get: function () {
      return DB::table('cnf_conversion_factors')
        ->join('cnf_food_measures', 'cnf_food_measures.cnf_measure_id', '=', 'cnf_conversion_factors.cnf_food_measure_id')
        ->select('cnf_conversion_factors.factor', 'cnf_conversion_factors.cnf_food_measure_id', 'cnf_food_measures.id', 'cnf_food_measures.name')
        ->where('cnf_conversion_factors.cnf_food_id', '=', $this->cnf_food_id)
        ->get();
    });
  }

  public function foodGroup(): HasOne
  {
    return $this->hasOne(CnfFoodGroup::class, 'id', 'cnf_food_group_id');
  }
}
