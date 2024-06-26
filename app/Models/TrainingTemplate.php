<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrainingTemplate extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'user_id',
    'template_category_id',
    'notes'
  ];

  public function workouts(): HasMany
  {
    return $this->hasMany(Workout::class);
  }

  public function templateCategory(): HasOne
  {
    return $this->hasOne(TemplateCategory::class, 'id');
  }
}
