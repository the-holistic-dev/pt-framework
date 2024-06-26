<?php

namespace App\Models;

use App\Models\NutritionPlanDay;
use App\Models\NutritionPlanFood;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use stdClass;

class NutritionPlanMeal extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
    'nutrition_plan_day_id'
  ];

  public function day(): BelongsTo
  {
    return $this->BelongsTo(NutritionPlanDay::class);
  }
  public function foods(): HasMany
  {
    return $this->hasMany(NutritionPlanFood::class);
  }

  protected function macros(): Attribute
  {
    return Attribute::make(get: function () {
      $macros = new stdClass();
      $macros->protein = 0;
      $macros->fat = 0;
      $macros->carbohydrate = 0;
      $macros->fiber = 0;
      $macros->calorie = 0;
      foreach ($this->foods as $key => $food) {
        $macros->protein += round($food->protein);
        $macros->fat += round($food->fat);
        $macros->carbohydrate += round($food->carbohydrate);
        $macros->fiber += round($food->fiber);
        $macros->calorie += round($food->calorie);
      }
      return $macros;
    });
  }
}
