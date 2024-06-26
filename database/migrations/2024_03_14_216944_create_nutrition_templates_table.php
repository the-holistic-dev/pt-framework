<?php

use App\Models\User;
use App\Models\TemplateCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNutritionTemplatesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('nutrition_templates', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->longText('notes')->nullable();
      $table->foreignIdFor(User::class);
      $table->foreignIdFor(TemplateCategory::class);
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
    Schema::dropIfExists('nutrition_templates');
  }
}
