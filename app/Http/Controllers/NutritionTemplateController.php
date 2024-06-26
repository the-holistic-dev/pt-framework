<?php

namespace App\Http\Controllers;

use App\Models\CnfFood;
use App\Models\CnfFoodGroup;
use Illuminate\Http\Request;
use App\Models\TemplateCategory;
use App\Models\NutritionTemplate;
use App\Http\Requests\StoreNutritionTemplateRequest;
use App\Http\Requests\UpdateNutritionTemplateRequest;

class NutritionTemplateController extends Controller
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
  public function create(Request $request)
  {
    $foods =  CnfFood::all();
    $foodGroups =  CnfFoodGroup::getCuratedFoodGroup();
    $mealLabels = ['Breakfast', 'Lunch', 'Dinner'];
    $templateId = $request->get('template');
    $template = NutritionTemplate::find($templateId);
    $templateCats = TemplateCategory::where('user_id', auth()->user()->id)->get();
    $templates = NutritionTemplate::where('user_id', auth()->user()->id)->where('template_category_id', $templateCats->first()->id)->get();
    return view('nutrition-templates.create', [
      'heading' => 'Create new nutrition template',
      'foodGroups' => $foodGroups,
      'mealLabels' => $mealLabels,
      'templateCats' => $templateCats,
      'templates' => $templates,
      'template' => $template,
      'userId' => $request->get('userId'),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\StoreNutritionTemplateRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreNutritionTemplateRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\NutritionTemplate  $nutritionTemplate
   * @return \Illuminate\Http\Response
   */
  public function show(NutritionTemplate $nutritionTemplate)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\NutritionTemplate  $nutritionTemplate
   * @return \Illuminate\Http\Response
   */
  public function edit(NutritionTemplate $nutritionTemplate)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateNutritionTemplateRequest  $request
   * @param  \App\Models\NutritionTemplate  $nutritionTemplate
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateNutritionTemplateRequest $request, NutritionTemplate $nutritionTemplate)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\NutritionTemplate  $nutritionTemplate
   * @return \Illuminate\Http\Response
   */
  public function destroy(NutritionTemplate $nutritionTemplate)
  {
    //
  }

  public function getByCategory(int $category)
  {
    $templates = NutritionTemplate::where('user_id', 2)->where('template_category_id', $category)->get();
    return $templates;
  }
}
