<?php

namespace App\Http\Controllers;

use App\Models\NutritionPlanMeal;
use App\Http\Requests\StoreNutritionPlanMealRequest;
use App\Http\Requests\UpdateNutritionPlanMealRequest;

class NutritionPlanMealController extends Controller
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
     * @param  \App\Http\Requests\StoreNutritionPlanMealRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNutritionPlanMealRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NutritionPlanMeal  $nutritionPlanMeal
     * @return \Illuminate\Http\Response
     */
    public function show(NutritionPlanMeal $nutritionPlanMeal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NutritionPlanMeal  $nutritionPlanMeal
     * @return \Illuminate\Http\Response
     */
    public function edit(NutritionPlanMeal $nutritionPlanMeal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNutritionPlanMealRequest  $request
     * @param  \App\Models\NutritionPlanMeal  $nutritionPlanMeal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNutritionPlanMealRequest $request, NutritionPlanMeal $nutritionPlanMeal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NutritionPlanMeal  $nutritionPlanMeal
     * @return \Illuminate\Http\Response
     */
    public function destroy(NutritionPlanMeal $nutritionPlanMeal)
    {
        //
    }
}
