<?php

use App\Models\CnfFood;
use App\Models\CnfFoodMeasure;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCnfConversionFactorsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('cnf_conversion_factors', function (Blueprint $table) {
      $table->id();
      $table->float('factor');
      $table->foreignIdFor(CnfFood::class);
      $table->foreignIdFor(CnfFoodMeasure::class);
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
    Schema::dropIfExists('cnf_conversion_factors');
  }
}
