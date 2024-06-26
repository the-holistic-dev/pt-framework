<?php

namespace Database\Seeders;

use App\Models\CnfFood;
use App\Models\CnfFoodMeasure;
use Illuminate\Database\Seeder;
use App\Models\CnfConversionFactor;
use Illuminate\Support\Facades\Storage;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class CnfConversionFactorSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $pathToFile = Storage::disk('local')->path('cnf/CONVERSION FACTOR.xlsx');
    $reader = ReaderEntityFactory::createReaderFromFile($pathToFile);
    $reader->open($pathToFile);
    foreach ($reader->getSheetIterator() as $sheet) {
      foreach ($sheet->getRowIterator() as $index => $row) {
        if ($index > 1) {
          $cells = $row->getCells();
          $cnfFoodId = intval($cells[0]->getValue());
          $cnfMeasureId = intval($cells[1]->getValue());
          $cnfFood = CnfFood::where('cnf_food_id', $cnfFoodId)->first();
          $cnfMeasure = CnfFoodMeasure::where('cnf_measure_id', $cnfMeasureId)->first();
          $factor = $cells[2]->getValue();
          if (!is_null($cnfMeasure) && !is_null($cnfFood)) {
            CnfConversionFactor::create(['factor' => $factor, 'cnf_food_id' => $cnfFood->cnf_food_id, 'cnf_food_measure_id' => $cnfMeasure->cnf_measure_id]);
          }
        }
      }
    }
  }
}
