<?php

use App\Models\CnfFood;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCnfFoodNutrientsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('cnf_food_nutrients', function (Blueprint $table) {
      $table->id();
      $table->float('value');
      $table->integer('nutrient_id');
      $table->foreignIdFor(CnfFood::class);
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
    Schema::dropIfExists('cnf_food_nutrients');
  }
}
