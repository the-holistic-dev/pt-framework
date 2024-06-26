<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NutritionPlan extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'goal',
    'notes',
    'user_id'
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function days(): HasMany
  {
    return $this->hasMany(NutritionPlanDay::class);
  }
}
