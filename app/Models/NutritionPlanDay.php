<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use stdClass;

class NutritionPlanDay extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'nutrition_plan_id',
    'nutrition_template_id'
  ];

  public function plan(): BelongsTo
  {
    return $this->belongsTo(NutritionPlan::class);
  }

  public function meals(): HasMany
  {
    return $this->hasMany(NutritionPlanMeal::class);
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
      foreach ($this->meals as $key => $meal) {
        $macros->protein += round($meal->macros->protein);
        $macros->fat += round($meal->macros->fat);
        $macros->carbohydrate += round($meal->macros->carbohydrate);
        $macros->fiber += round($meal->macros->fiber);
        $macros->calorie += round($meal->macros->calorie);
      }
      return $macros;
    });
  }
}
