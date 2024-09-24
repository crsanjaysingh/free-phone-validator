<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
  use HasFactory;
  protected $fillable = ['wallet_id', 'amount', 'added_by', 'memo'];
  public function wallet()
  {
    return $this->belongsTo(Wallet::class);
  }

  public function addedByUser()
  {
    return $this->belongsTo(User::class, 'added_by');
  }
}
