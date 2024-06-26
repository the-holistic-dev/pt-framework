<?php

namespace App\Models;

use stdClass;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CnfFoodGroup extends Model
{
  use HasFactory;

  protected $appends = ['nutrients'];

  protected function nutrients(): Attribute
  {
    return Attribute::make(get: function () {
      $nutrients = new stdClass();
      $nutrients->protein = 0;
      $nutrients->fat = 0;
      $nutrients->carbohydrate = 0;
      $nutrients->fiber = 0;
      $nutrients->calorie = 0;
      $cnfFoods = CnfFood::where('cnf_food_group_id', $this->food_group_id)->where('curated', 1)->get();

      $sizeof = sizeof($cnfFoods);
      foreach ($cnfFoods as $food) {
        $nutrients->protein += $food->protein;
        $nutrients->fat += $food->fat;
        $nutrients->carbohydrate += $food->carbohydrate;
        $nutrients->fiber += $food->fiber;
        $nutrients->calorie += $food->calorie;
      }
      $nutrients->protein /= $sizeof;
      $nutrients->fat /= $sizeof;
      $nutrients->carbohydrate /= $sizeof;
      $nutrients->fiber /= $sizeof;
      $nutrients->calorie /= $sizeof;

      return $nutrients;
    });
  }

  public static function getCuratedFoodGroup()
  {
    $foodGroups =  CnfFoodGroup::all();
    $curatedGroups = collect([]);
    foreach ($foodGroups as $group) {
      $food = CnfFood::where('cnf_food_group_id', $group->food_group_id)->where('curated', 1)->first();
      if (!is_null($food)) {
        $curatedGroups->push($group);
      }
    }
    return $curatedGroups;
  }
}
