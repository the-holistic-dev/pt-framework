<?php

use App\Models\Exercise;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Workout;

class CreateExerciseParametersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('exercise_parameters', function (Blueprint $table) {
      $table->id();
      $table->string('order');
      $table->integer('set');
      $table->string('rep');
      $table->string('tempo');
      $table->integer('rest');
      $table->string('technique')->nullable();
      $table->string('note')->nullable();
      $table->foreignIdFor(Exercise::class);
      $table->foreignIdFor(Workout::class)->constrained()->cascadeOnDelete();
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
    Schema::dropIfExists('exercise_parameters');
  }
}
