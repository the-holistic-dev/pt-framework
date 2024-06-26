<?php

use App\Models\TrainingPlan;
use App\Models\TrainingTemplate;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('workouts', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->foreignIdFor(TrainingPlan::class)->nullable()->constrained()->cascadeOnDelete();
      $table->foreignIdFor(TrainingTemplate::class)->nullable()->constrained()->cascadeOnDelete();
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
    Schema::dropIfExists('workouts');
  }
}
