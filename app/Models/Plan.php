<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
  use HasFactory;
  protected $fillable = ['name', 'plan_tags', 'plan_cost', 'features', 'plan_type', 'is_free', 'status'];
  protected $casts = [
    'features' => 'array',
  ];
}
