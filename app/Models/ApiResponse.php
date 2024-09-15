<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiResponse extends Model
{
  use HasFactory;
  protected $fillable = [
    'lookup_type',
    'lookup_for',
    'fraud_score',
    'status',
    'country',
    'user_id',
    'response_data',
  ];
  protected $casts = [
    'response_data' => 'json',
    'fraud_score' => 'decimal:2',
  ];
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
