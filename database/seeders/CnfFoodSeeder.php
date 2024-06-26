<?php

namespace Database\Seeders;

use App\Models\CnfFood;
use App\Models\CnfFoodGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class CnfFoodSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $pathToFile = Storage::disk('local')->path('cnf/FOOD NAME.xlsx');
    $reader = ReaderEntityFactory::createReaderFromFile($pathToFile);
    $reader->open($pathToFile);
    foreach ($reader->getSheetIterator() as $sheet) {
      foreach ($sheet->getRowIterator() as $index => $row) {
        if ($index > 1) {
          $cells = $row->getCells();
          $cnfFoodId = $cells[0]->getValue();
          $cnfFoodGroupId = $cells[2]->getValue();
          $name = $cells[4]->getValue();
          $meatFoodGroupIds = [5, 10, 13, 15, 17];
          if (in_array($cnfFoodGroupId, $meatFoodGroupIds)) {
            if ((!str_contains($name, 'raw') && !str_contains($name, 'uncooked')) && (str_contains($name, 'roasted') || str_contains($name, 'cooked') || str_contains($name, 'broiled'))) {
              $cnfFoodGroup = CnfFoodGroup::where('food_group_id', $cnfFoodGroupId)->first();
              CnfFood::create(['name' => $name, 'cnf_food_group_id' => $cnfFoodGroup->food_group_id, 'cnf_food_id' => $cnfFoodId]);
            }
          } else if ($cnfFoodGroupId == 1 && !str_contains($name, 'raw')) {
            $cnfFoodGroup = CnfFoodGroup::where('food_group_id', $cnfFoodGroupId)->first();
            CnfFood::create(['name' => $name, 'cnf_food_group_id' => $cnfFoodGroup->food_group_id, 'cnf_food_id' => $cnfFoodId]);
          } else {
            $cnfFoodGroup = CnfFoodGroup::where('food_group_id', $cnfFoodGroupId)->first();
            if (!is_null($cnfFoodGroup)) {
              CnfFood::create(['name' => $name, 'cnf_food_group_id' => $cnfFoodGroup->food_group_id, 'cnf_food_id' => $cnfFoodId]);
            }
          }
        }
      }
    }
  }
}
