<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\CnfFoodGroup;
use Illuminate\Http\Request;
use App\Models\CnfFoodNutrient;
use App\Http\Requests\StoreCnfFoodGroupRequest;
use App\Http\Requests\UpdateCnfFoodGroupRequest;
use App\Models\CnfFood;

class CnfFoodGroupController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreCnfFoodGroupRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreCnfFoodGroupRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\CnfFoodGroup  $cnfFoodGroup
   * @return \Illuminate\Http\Response
   */
  public function show(CnfFoodGroup $cnfFoodGroup)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\CnfFoodGroup  $cnfFoodGroup
   * @return \Illuminate\Http\Response
   */
  public function edit(CnfFoodGroup $cnfFoodGroup)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateCnfFoodGroupRequest  $request
   * @param  \App\Models\CnfFoodGroup  $cnfFoodGroup
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateCnfFoodGroupRequest $request, CnfFoodGroup $cnfFoodGroup)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\CnfFoodGroup  $cnfFoodGroup
   * @return \Illuminate\Http\Response
   */
  public function destroy(CnfFoodGroup $cnfFoodGroup)
  {
    //
  }

  public function getFoodGroupNutrients(Request $request, int $id)
  {
    $group = new stdClass();
    $cnfGroup = CnfFoodGroup::findOrFail($id);
    $cnfFoods = CnfFood::where('cnf_food_group_id', $cnfGroup->food_group_id)->get();
    $values = [203 => 0, 204 => 0, 205 => 0, 208 => 0, 291 => 0];
    $cnfFoods = CnfFood::where('cnf_food_group_id', $cnfGroup->food_group_id)->where('curated', 1)->get();
    foreach ($cnfFoods as $food) {
      $nutrients = CnfFoodNutrient::where('cnf_food_id', $food->cnf_food_id)->get();
      foreach ($nutrients as $nutrient) {
        $values[$nutrient->nutrient_id] += $nutrient->value;
      }
    }
    foreach ($values as $key => $val) {
      $values[$key] = round($val / sizeof($cnfFoods));
    }
    $group->id = $cnfGroup->food_group_id;
    $group->name = $cnfGroup->name;
    $group->protein = $values[203];
    $group->fat = $values[204];
    $group->carbohydrate = $values[205];
    $group->calorie = $values[208];
    $group->fiber = $values[291];

    return response()->json($group);
  }
}
