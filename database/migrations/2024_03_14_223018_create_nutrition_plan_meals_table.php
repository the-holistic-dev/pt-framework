<?php

use App\Models\NutritionPlanDay;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionPlanMealsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('nutrition_plan_meals', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->foreignIdFor(NutritionPlanDay::class)->constrained()->cascadeOnDelete();
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
    Schema::dropIfExists('nutrition_plan_meals');
  }
}
