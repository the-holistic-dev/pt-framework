<?php

use App\Http\Controllers\CnfFoodController;
use App\Http\Controllers\CnfFoodGroupController;
use App\Http\Controllers\NutritionPlanController;
use App\Http\Controllers\TemplateCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingTemplateController;
use App\Http\Controllers\NutritionTemplateController;
use App\Models\CnfFood;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('training-templates/{category}', [TrainingTemplateController::class, 'getByCategory']);
  Route::get('nutrition-templates/{category}', [NutritionTemplateController::class, 'getByCategory']);
  Route::post('template-categories/', [TemplateCategoryController::class, 'store']);
  Route::get('cnf-food/{name}', [CnfFoodController::class, 'get']);
  Route::get('cnf-group/{id}', [CnfFoodGroupController::class, 'getFoodGroupNutrients']);
  Route::get('nutrition-plans/{id}', [NutritionPlanController::class, 'get']);
});
