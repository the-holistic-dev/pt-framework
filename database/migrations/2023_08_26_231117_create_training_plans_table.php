<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingPlansTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('training_plans', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('goal');
      $table->string('phase');
      $table->longText('notes')->nullable();
      $table->foreignIdFor(User::class);
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
    Schema::dropIfExists('training_plans');
  }
}
