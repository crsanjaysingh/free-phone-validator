<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  use HasFactory;
  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'organization',
    'phone_number',
    'address',
    'state',
    'zip_code',
    'country',
    'language',
    'timezone',
    'currency',
    'profile_image',
    'role'
  ];
}
