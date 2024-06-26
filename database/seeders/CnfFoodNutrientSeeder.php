<?php

namespace Database\Seeders;

use App\Models\CnfFood;
use App\Models\CnfFoodNutrient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class CnfFoodNutrientSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $pathToFile = Storage::disk('local')->path('cnf/NUTRIENT AMOUNT.xlsx');
    $reader = ReaderEntityFactory::createReaderFromFile($pathToFile);
    $reader->open($pathToFile);
    $allowedNutrient = [203, 204, 205, 208, 291];
    foreach ($reader->getSheetIterator() as $sheet) {
      foreach ($sheet->getRowIterator() as $index => $row) {
        if ($index > 1) {
          $cells = $row->getCells();
          $nutrientId = $cells[1]->getValue();
          $foodId = $cells[0]->getValue();
          if (in_array($nutrientId, $allowedNutrient) && !is_null(CnfFood::where('cnf_food_id', $foodId)->first())) {
            $nutrientValue = $cells[2]->getValue();
            CnfFoodNutrient::create(['value' => $nutrientValue, 'nutrient_id' => $nutrientId, 'cnf_food_id' => $foodId]);
          }
        }
      }
    }
  }
}
