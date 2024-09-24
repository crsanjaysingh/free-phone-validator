<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $adminRole = Role::firstOrCreate(['name' => 'admin']);

    $user = User::firstOrCreate(
      ['email' => 'no.reply@knotnetworks.com'],
      [
        'name' => 'Admin User',
        'password' => Hash::make('Admin@knotnetworks^&&&*#$%'),
      ]
    );

    $user->assignRole($adminRole);
  }
}
