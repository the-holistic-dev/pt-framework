<?php

use App\Http\Controllers\NutritionPlanController;
use App\Http\Controllers\NutritionTemplateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TemplateCategoryController;
use App\Http\Controllers\TrainingPlanController;
use App\Http\Controllers\TrainingTemplateController;
use App\Models\NutritionTemplate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* 
?Comment Resource Routes:
 * index - Show all
 * show - Show single
 * create - Show form to create new
 * store - Save new entity from create form
 * edit - Show edit form
 * update - Update entity
 * destroy - Delete entity
 */

//================Home==========================
Route::view('/', 'home');
//===============Training plan==================
//Store
Route::post('trainings', [TrainingPlanController::class, 'store'])->name('trainings.store');
//Show create form
Route::get('trainings/create/', [TrainingPlanController::class, 'create'])->name('trainings.create');
//Show all
Route::get('trainings/index', [TrainingPlanController::class, 'index'])->name('trainings.index');
//Show edit form
Route::get('trainings/{trainingPlan}/edit', [TrainingPlanController::class, 'edit'])->name('trainings.edit');
//Update
Route::put('trainings/{trainingPlan}', [TrainingPlanController::class, 'update'])->name('trainings.update');
//Delete
Route::delete('trainings/{trainingPlan}', [TrainingPlanController::class, 'destroy'])->name('trainings.destroy');
//Show single
Route::get('trainings/{trainingPlan}', [TrainingPlanController::class, 'show'])->name('trainings.show');
//===============Training template==================
//Store
Route::post('training-templates', [TrainingTemplateController::class, 'store'])->name('training-templates.store');
//Show create form
Route::get('training-templates/create/', [TrainingTemplateController::class, 'create'])->name('training-templates.create');
//Show all
Route::get('training-templates/index', [TrainingTemplateController::class, 'index'])->name('training-templates.index');
//Show edit form
Route::get('training-templates/{template}/edit', [TrainingTemplateController::class, 'edit'])->name('training-templates.edit');
//Update
Route::put('training-templates/{template}', [TrainingTemplateController::class, 'update'])->name('training-templates.update');
//Delete
Route::delete('training-templates/{template}', [TrainingTemplateController::class, 'destroy'])->name('training-templates.destroy');
//Show single
Route::get('training-templates/{template}', [TrainingTemplateController::class, 'show'])->name('training-templates.show');
//==================User========================
//Show all
Route::get('/user/index', [UserController::class, 'index'])->can('create-users');
//Show create form
Route::get('/user/create/', [UserController::class, 'create'])->can('create-users');
//Store
Route::post('/user', [UserController::class, 'store']);
//Show edit form
Route::get('/user/{user}/edit', [UserController::class, 'edit']);
//Update
Route::put('/user/{user}', [UserController::class, 'update']);
//Delete
Route::delete('/user/{user}', [UserController::class, 'destroy']);
//Show single
Route::get('/user/{user}', [UserController::class, 'show']);
//Show login form
Route::get('/login', [UserController::class, 'login']);
//Authenticate
Route::post('/user/authenticate', [UserController::class, 'authenticate']);
//Logout
Route::post('/logout', [UserController::class, 'logout']);
//===============Template category==================
//Update
Route::put('template-categories/{category}', [TemplateCategoryController::class, 'update'])->name('template-categories.update');
//Delete
Route::delete('template-categories/{category}', [TemplateCategoryController::class, 'destroy'])->name('template-categories.destroy');
//===============Nutrition plan==================
//Store
Route::post('nutrition-plans', [NutritionPlanController::class, 'store']);
//Show create form
Route::get('/nutrition-plans/create/', [NutritionPlanController::class, 'create']);
//Show all
Route::get('/nutrition-plans/index/', [NutritionPlanController::class, 'index']);
//Show edit form
Route::get('/nutrition-plans/{nutritionPlan}/edit/', [NutritionPlanController::class, 'edit']);
//Update
Route::put('/nutrition-plans/{nutritionPlan}', [NutritionPlanController::class, 'update']);
//Delete
Route::delete('/nutrition-plans/{nutritionPlan}', [NutritionPlanController::class, 'destroy']);
//Show single
Route::get('/nutrition-plans/{nutritionPlan}', [NutritionPlanController::class, 'show']);
//===============Nutrition template==================
//Store
Route::post('nutrition-templates', [NutritionTemplateController::class, 'store']);
//Show create form
Route::get('/nutrition-templates/create/', [NutritionTemplateController::class, 'create']);
//Show all
Route::get('/nutrition-templates/index/', [NutritionTemplateController::class, 'index']);
//Show edit form
Route::get('/nutrition-templates/{template}/edit/', [NutritionTemplateController::class, 'edit']);
//Update
Route::put('/nutrition-templates/{template}', [NutritionTemplateController::class, 'update']);
//Delete
Route::delete('/nutrition-templates/{template}', [NutritionTemplateController::class, 'destroy']);
//Show single
Route::get('/nutrition-templates/{template}', [NutritionTemplateController::class, 'show']);
