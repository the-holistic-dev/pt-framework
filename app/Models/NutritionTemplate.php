<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NutritionTemplate extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'notes',
    'user_id',
    'template_category_id',
  ];

  public function days(): HasMany
  {
    return $this->hasMany(NutritionPlanDay::class);
  }
  public function templateCategory(): HasOne
  {
    return $this->hasOne(TemplateCategory::class, 'id');
  }
}
