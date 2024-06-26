<?php

namespace App\Http\Controllers;

use App\Models\NutritionPlanFood;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;

class NutritionPlanFoodController extends Controller
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
   * @param  \App\Http\Requests\StoreFoodRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreFoodRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Food  $food
   * @return \Illuminate\Http\Response
   */
  public function show(NutritionPlanFood $food)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Food  $food
   * @return \Illuminate\Http\Response
   */
  public function edit(NutritionPlanFood $food)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateFoodRequest  $request
   * @param  \App\Models\Food  $food
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateFoodRequest $request, NutritionPlanFood $food)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Food  $food
   * @return \Illuminate\Http\Response
   */
  public function destroy(NutritionPlanFood $food)
  {
    //
  }
}
