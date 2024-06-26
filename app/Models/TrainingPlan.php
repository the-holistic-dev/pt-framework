<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainingPlan extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'goal',
    'phase',
    'notes',
    'user_id'
  ];

  public function workouts(): HasMany
  {
    return $this->hasMany(Workout::class);
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }
}
