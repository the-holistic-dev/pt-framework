<?php

namespace Database\Seeders;

use App\Models\TemplateCategory;
use Illuminate\Database\Seeder;

class TemplateCategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    TemplateCategory::create([
      'name' => 'Uncategorized',
      'user_id' => '2'
    ]);
    TemplateCategory::create([
      'name' => 'Accumulation',
      'user_id' => '2'
    ]);
    TemplateCategory::create([
      'name' => 'Intensification',
      'user_id' => '2'
    ]);
    TemplateCategory::create([
      'name' => 'Low carbs',
      'user_id' => '2'
    ]);
  }
}
