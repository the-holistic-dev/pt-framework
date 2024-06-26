<?php

use App\Models\CustomFood;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFoodPortionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('custom_food_portions', function (Blueprint $table) {
      $table->id();
      $table->string('name');
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
    Schema::dropIfExists('custom_food_portions');
  }
}
