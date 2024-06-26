<?php

namespace App\Http\Controllers;

use App\Models\CnfFood;
use Illuminate\Http\Request;
use App\Models\CnfFoodMeasure;
use App\Http\Requests\StoreCnfFoodMeasureRequest;
use App\Http\Requests\UpdateCnfFoodMeasureRequest;

class CnfFoodMeasureController extends Controller
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
   * @param  \App\Http\Requests\StoreCnfFoodMeasureRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreCnfFoodMeasureRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\CnfFoodMeasure  $cnfFoodMeasure
   * @return \Illuminate\Http\Response
   */
  public function show(CnfFoodMeasure $cnfFoodMeasure)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\CnfFoodMeasure  $cnfFoodMeasure
   * @return \Illuminate\Http\Response
   */
  public function edit(CnfFoodMeasure $cnfFoodMeasure)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateCnfFoodMeasureRequest  $request
   * @param  \App\Models\CnfFoodMeasure  $cnfFoodMeasure
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateCnfFoodMeasureRequest $request, CnfFoodMeasure $cnfFoodMeasure)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\CnfFoodMeasure  $cnfFoodMeasure
   * @return \Illuminate\Http\Response
   */
  public function destroy(CnfFoodMeasure $cnfFoodMeasure)
  {
    //
  }
}
