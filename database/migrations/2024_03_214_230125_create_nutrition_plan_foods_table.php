<?php

use App\Models\CnfFood;
use App\Models\CnfFoodGroup;
use App\Models\CnfFoodMeasure;
use App\Models\CustomFood;
use App\Models\CustomFoodPortion;
use App\Models\NutritionPlanMeal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionPlanFoodsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('nutrition_plan_foods', function (Blueprint $table) {
      $table->id();
      $table->float('factor')->default(1);
      $table->integer('quantity');
      $table->foreignIdFor(CnfFoodMeasure::class)->nullable();
      $table->foreignIdFor(CnfFood::class)->nullable();
      $table->foreignIdFor(CnfFoodGroup::class)->nullable();
      $table->foreignIdFor(CustomFoodPortion::class)->nullable();
      $table->foreignIdFor(CustomFood::class)->nullable();
      $table->foreignIdFor(NutritionPlanMeal::class)->constrained()->cascadeOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('nutrition_plan_foods');
  }
}
