<?php

namespace Database\Seeders;

use App\Models\CnfFoodMeasure;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class CnfFoodMeasureSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $pathToFile = Storage::disk('local')->path('cnf/MEASURE NAME.xlsx');
    $reader = ReaderEntityFactory::createReaderFromFile($pathToFile);
    $reader->open($pathToFile);
    foreach ($reader->getSheetIterator() as $sheet) {
      foreach ($sheet->getRowIterator() as $index => $row) {
        if ($index > 1) {
          $cells = $row->getCells();
          $measureId = $cells[0]->getValue();
          $name = $cells[1]->getValue();
          CnfFoodMeasure::create(['name' => $name, 'cnf_measure_id' => $measureId]);
        }
      }
    }
  }
}
