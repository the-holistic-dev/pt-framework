<?php

namespace App\Http\Controllers;

use stdClass;
use Exception;
use App\Models\CnfFood;
use App\Models\CnfFoodGroup;
use Illuminate\Http\Request;
use App\Models\NutritionPlan;
use App\Models\CnfFoodNutrient;
use App\Models\NutritionPlanDay;
use App\Models\TemplateCategory;
use App\Models\NutritionPlanFood;
use App\Models\NutritionPlanMeal;
use App\Models\NutritionTemplate;
use Illuminate\Support\Facades\DB;
use App\Models\CnfConversionFactor;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreNutritionPlanRequest;
use App\Http\Requests\UpdateNutritionPlanRequest;

class NutritionPlanController extends Controller
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
    $foodGroups =  CnfFoodGroup::getCuratedFoodGroup();
    $mealLabels = ['Breakfast', 'Lunch', 'Dinner'];
    $templateId = $request->get('template');
    $template = NutritionTemplate::find($templateId);
    $templateCats = TemplateCategory::where('user_id', auth()->user()->id)->get();
    $templates = NutritionTemplate::where('user_id', auth()->user()->id)->where('template_category_id', $templateCats->first()->id)->get();
    return view('nutrition-plans.create', [
      'heading' => 'Create new nutrition plan',
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
   * @param  \App\Http\Requests\StoreNutritionPlanRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreNutritionPlanRequest $request)
  {
    $fields = $this->validateFields($request);
    $this->saveNutritionPlan($fields);
    return redirect("/user/{$request->get('user_id')}");
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\NutritionPlan  $nutritionPlan
   * @return \Illuminate\Http\Response
   */
  public function show(NutritionPlan $nutritionPlan)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\NutritionPlan  $nutritionPlan
   * @return \Illuminate\Http\Response
   */
  public function edit(NutritionPlan $nutritionPlan)
  {
    $mealLabels = ['Breakfast', 'Lunch', 'Dinner'];
    $foodGroups =  CnfFoodGroup::getCuratedFoodGroup();
    return view('nutrition-plans.edit', [
      'heading' => 'Edit nutrition plan',
      'foodGroups' => $foodGroups,
      'mealLabels' => $mealLabels,
      'plan' => $nutritionPlan,
      'userId' => $nutritionPlan->user->id,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\UpdateNutritionPlanRequest  $request
   * @param  \App\Models\NutritionPlan  $nutritionPlan
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateNutritionPlanRequest $request, NutritionPlan $nutritionPlan)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\NutritionPlan  $nutritionPlan
   * @return \Illuminate\Http\Response
   */
  public function destroy(NutritionPlan $nutritionPlan)
  {
    $nutritionPlan->delete();
    return redirect("/user/{$nutritionPlan->user_id}");
  }

  public function get(int $id)
  {
    $plan = NutritionPlan::findOrFail($id);
    $foods = $plan->days->map(function ($dayItem) {
      return $dayItem->meals->map(function ($mealItem) {
        return $mealItem->foods;
      });
    });
    return response()->json($foods);
  }

  private function validateFields(Request $request)
  {
    $validFields = [];
    $validator = $this->createNutritionPlanValidator($request);
    $validator->validate();
    $validFields = $validator->validated();
    foreach ($request->get('day') as $dayIndex => $day) {
      ['meal' => $meals] = $day;
      if (!$this->allMealAreEmpty($meals)) {
        $validFields['day'][$dayIndex]['title'] = '';
        //Validate workout fields
        $validator = $this->createDayValidator($dayIndex, $request);
        $validator->validate();
        $dayFields = $validator->validated();
        $validFields['day'][$dayIndex] = $dayFields['day'][$dayIndex];
        foreach ($meals as $mealIndex => $meal) {
          $validFields['day'][$dayIndex]['meal'][$mealIndex] = ['name' => '', 'food' => [], 'group' => []];
          //Validate meal fields
          $validator = $this->createMealValidator($dayIndex, $mealIndex, $request);
          $validator->validate();
          $mealFields = $validator->validated();
          $validFields['day'][$dayIndex]['meal'][$mealIndex] = $mealFields['day'][$dayIndex]['meal'][$mealIndex];
          if (array_key_exists('food', $meal)) {
            //Validate food fields
            $validator = $this->createFoodValidator($request, $dayIndex, $mealIndex, $meal['food']);
            if ($validator->fails()) {
              dd($validator->errors()->messages());
            }
            $foodFields = $validator->validated();
            $validFields['day'][$dayIndex]['meal'][$mealIndex]['food'] = $foodFields['day'][$dayIndex]['meal'][$mealIndex]['food'];
          }
          if (array_key_exists('group', $meal)) {
            //Validate food group fields
            $validator = $this->createFoodGroupValidator($request, $dayIndex, $mealIndex, $meal['group']);
            if ($validator->fails()) {
              dd($validator->errors()->messages());
            }
            $groupFields = $validator->validated();
            $validFields['day'][$dayIndex]['meal'][$mealIndex]['group'] = $groupFields['day'][$dayIndex]['meal'][$mealIndex]['group'];
          }
        }
      }
    }
    return $validFields;
  }

  private function createNutritionPlanValidator(Request $request)
  {
    $rules = [
      'title' => 'required',
      'goal' => 'required',
      'notes' => 'nullable',
      'user_id' => 'required',
    ];
    $vals = [
      'title' => $request->get('title'),
      'goal' => $request->get('goal'),
      'notes' => $request->get('notes'),
      'user_id' => $request->get('user_id'),
    ];

    return Validator::make($vals, $rules);
  }

  private function createDayValidator(int $dayIndex, Request $request)
  {
    $rules = [
      "day.{$dayIndex}.title" => 'required'
    ];
    return Validator::make($request->all(), $rules, ['required' => 'The day title field is required']);
  }

  private function createMealValidator(int $dayIndex, int $mealIndex, Request $request)
  {
    $rules = [
      "day.{$dayIndex}.meal.{$mealIndex}.name" => 'required'
    ];
    return Validator::make($request->all(), $rules, ['required' => 'The meal name field is required']);
  }

  private function createFoodValidator(Request $request, int $dayIndex, int $mealIndex, array $foods)
  {
    $rules = [];
    $foodKeys = array_keys($foods);
    foreach ($foodKeys as $foodIndex) {
      $rules['day.' . $dayIndex . '.meal.' . $mealIndex . '.food.' . $foodIndex . '.id'] = 'sometimes|exists:cnf_foods,id';
      $rules['day.' . $dayIndex . '.meal.' . $mealIndex . '.food.' . $foodIndex . '.quantity'] = 'numeric|gt:0|required_with:day.' . $dayIndex . '.meal.' . $mealIndex . '.food.' . $foodIndex . '.id';
      $rules['day.' . $dayIndex . '.meal.' . $mealIndex . '.food.' . $foodIndex . '.portion'] = 'exists:cnf_food_measures,id|required_with:day.' . $dayIndex . '.meal.' . $mealIndex . '.food.' . $foodIndex . '.id';
    }
    return Validator::make($request->all(), $rules, ['required_with' => 'This field is required when an food is selected']);
  }

  private function createFoodGroupValidator(Request $request, int $dayIndex, int $mealIndex, array $groups)
  {
    $rules = [];
    $groupKeys = array_keys($groups);
    foreach ($groupKeys as $groupIndex) {
      $rules['day.' . $dayIndex . '.meal.' . $mealIndex . '.group.' . $groupIndex . '.id'] = 'sometimes|exists:cnf_food_groups,id';
      $rules['day.' . $dayIndex . '.meal.' . $mealIndex . '.group.' . $groupIndex . '.quantity'] = 'numeric|gt:0|required_with:day.' . $dayIndex . '.meal.' . $mealIndex . '.group.' . $groupIndex . '.id';
    }
    return Validator::make($request->all(), $rules, ['required_with' => 'This field is required when an food is selected']);
  }

  private function saveNutritionPlan($fields)
  {
    $dayFields = $fields['day'];
    unset($fields['day']);
    $newPlanId = NutritionPlan::create($fields)->id;
    foreach ($dayFields as $dayField) {
      $meal = $dayField['meal'];
      unset($dayField['meal']);
      $dayField['nutrition_plan_id'] = $newPlanId;
      $nutritionPlanDayId = NutritionPlanDay::create($dayField)->id;
      foreach ($meal as $mealFields) {
        $group = null;
        $food = null;
        if (array_key_exists('group', $mealFields)) {
          $group = $mealFields['group'];
          unset($mealFields['group']);
        }
        if (array_key_exists('food', $mealFields)) {
          $food = $mealFields['food'];
          unset($mealFields['food']);
        }
        $mealFields['nutrition_plan_day_id'] = $nutritionPlanDayId;
        $mealId = NutritionPlanMeal::create($mealFields)->id;
        if (!is_null($group)) {
          foreach ($group as $groupFields) {
            ['id' => $id] =  $groupFields;
            $foodGroup = CnfFoodGroup::find($id);
            $groupFields['nutrition_plan_meal_id'] = $mealId;
            $groupFields['cnf_food_group_id'] = $foodGroup->food_group_id;
            NutritionPlanFood::create($groupFields);
          }
        }
        if (!is_null($food)) {
          foreach ($food as $foodFields) {
            ['id' => $id, 'portion' => $portion] =  $foodFields;
            $food = CnfFood::find($id);
            $factor = CnfConversionFactor::find($portion);
            $foodFields['factor'] = $factor->factor;
            $foodFields['nutrition_plan_meal_id'] = $mealId;
            $foodFields['cnf_food_id'] = CnfFood::find($id)->cnf_food_id;
            $foodFields['cnf_food_measure_id'] = CnfFoodMeasure::find($portion)->cnf_measure_id;
            NutritionPlanFood::create($foodFields);
          }
        }
      }
    }
  }

  private function allMealAreEmpty($meals): bool
  {
    foreach ($meals as $meal) {
      return $this->allFoodAreEmpty($meal);
    }
    return true;
  }

  private function allFoodAreEmpty($meal): bool
  {
    $groupEmpty = true;
    $foodEmpty = true;
    if (array_key_exists('group', $meal)) {
      foreach ($meal['group'] as $food) {
        if (!is_null($food['id'])) {
          $groupEmpty = false;
          break;
        }
      }
    }
    if (array_key_exists('food', $meal)) {
      foreach ($meal['food'] as $food) {
        if (!is_null($food['id'])) {
          $foodEmpty = false;
          break;
        }
      }
    }
    return $groupEmpty && $foodEmpty;
  }
}
