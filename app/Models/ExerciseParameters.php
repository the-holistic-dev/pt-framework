<?php

namespace App\Models;

use App\Models\Workout;
use App\Models\Exercise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExerciseParameters extends Model
{
  use HasFactory;

  protected $fillable = [
    'order',
    'set',
    'rep',
    'tempo',
    'rest',
    'exercise_id',
    'workout_id',
  ];

  public function workout(): HasOne
  {
    return $this->hasOne(Workout::class);
  }

  public function exercise(): BelongsTo
  {
    return $this->belongsTo(Exercise::class);
  }
}
