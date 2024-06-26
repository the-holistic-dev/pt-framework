<?php

use App\Models\CustomFood;
use App\Models\CustomFoodPortion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFoodNutrientsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('custom_food_nutrients', function (Blueprint $table) {
      $table->id();
      $table->integer('protein');
      $table->integer('fat');
      $table->integer('carbohydrate');
      $table->integer('calorie');
      $table->integer('fibre');
      $table->foreignIdFor(CustomFoodPortion::class);
      $table->foreignIdFor(CustomFood::class);
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
    Schema::dropIfExists('custom_food_nutrients');
  }
}
