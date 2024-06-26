<?php

namespace Database\Seeders;

use App\Models\CnfFoodGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class CnfFoodGroupSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $pathToFile = Storage::disk('local')->path('cnf/FOOD GROUP.xlsx');
    $reader = ReaderEntityFactory::createReaderFromFile($pathToFile);
    $reader->open($pathToFile);
    foreach ($reader->getSheetIterator() as $sheet) {
      foreach ($sheet->getRowIterator() as $index => $row) {
        if ($index > 1) {
          $cells = $row->getCells();
          $cnfFoodGroupId = $cells[0]->getValue();
          $notAllowedGroup = [3];
          if (!in_array($cnfFoodGroupId, $notAllowedGroup)) {
            $name = $cells[2]->getValue();
            CnfFoodGroup::create(['name' => $name, 'food_group_id' => $cnfFoodGroupId]);
          }
        }
      }
    }
  }
}
