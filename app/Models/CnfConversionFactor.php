<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CnfConversionFactor extends Model
{
  use HasFactory;

  public function food(): BelongsTo
  {
    return $this->belongsTo(CnfFood::class, 'cnf_food_id', 'id');
  }

  public function measure(): BelongsTo
  {
    return $this->belongsTo(CnfFoodMeasure::class, 'cnf_food_measure_id', 'id');
  }
}
