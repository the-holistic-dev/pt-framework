<?php

namespace Database\Seeders;

use App\Models\NutritionTemplate;
use Illuminate\Database\Seeder;

class NutritionTemplateSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    NutritionTemplate::create([
      'title' => '1500 cals',
      'user_id' => 2,
      'template_category_id' => 4
    ]);
  }
}
