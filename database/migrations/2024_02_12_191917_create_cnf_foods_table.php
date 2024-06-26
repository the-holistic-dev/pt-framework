<?php

use App\Models\CnfFoodGroup;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCnfFoodsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('cnf_foods', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->integer('cnf_food_id');
      $table->foreignIdFor(CnfFoodGroup::class);
      $table->boolean('curated')->default(false);
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
    Schema::dropIfExists('cnf_foods');
  }
}
