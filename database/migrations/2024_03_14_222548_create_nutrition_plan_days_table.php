<?php

use App\Models\NutritionPlan;
use App\Models\NutritionTemplate;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionPlanDaysTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('nutrition_plan_days', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->foreignIdFor(NutritionPlan::class)->nullable()->constrained()->cascadeOnDelete();
      $table->foreignIdFor(NutritionTemplate::class)->nullable()->constrained()->cascadeOnDelete();
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
    Schema::dropIfExists('nutrition_plan_days');
  }
}
