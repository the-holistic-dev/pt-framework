<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workout extends Model
{
  use HasFactory;

  protected $fillable = ['title', 'training_plan_id', 'training_template_id'];

  public function training(): BelongsTo
  {
    return $this->BelongsTo(TrainingPlan::class);
  }

  public function exercises(): HasMany
  {
    return $this->HasMany(ExerciseParameters::class);
  }
}
