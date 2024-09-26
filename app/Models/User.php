<?php

namespace App\Models;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Event;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable implements MustVerifyEmail
{
  use HasFactory, Notifiable, HasRoles;


  protected static function booted()
  {
    static::created(function ($user) {
      if (!$user->hasAnyRole(Role::all())) {
        $user->assignRole('user');
      }
    });
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'last_name',
    'email',
    'phone_number',
    'profile_image',
    'password',
    'otp',
    'otp_expires_at'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
    'otp',
    'otp_expires_at'
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }
  public function wallet()
  {
    return $this->hasOne(Wallet::class);
  }

  public function subscription()
  {
    return $this->hasOne(Subscription::class);
  }

  public function subscriptions()
  {
    return $this->hasMany(Subscription::class);
  }

  public function deductWallet($amount)
  {
    $this->wallet_balance -= $amount;
    $this->save();
  }
}
