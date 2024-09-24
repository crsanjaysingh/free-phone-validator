<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Create roles
    $adminRole = Role::create(['name' => 'admin']);
    $userRole = Role::create(['name' => 'user']);

    // Create permissions
    $permissions = [
      // Plans module permissions
      'view plans',
      'create plans',
      'edit plans',
      'delete plans',

      // Lookups module permissions
      'view lookups',
      'create lookups',
      'edit lookups',
      'delete lookups',

      // Wallet module permissions
      'view wallet',
      'add funds to wallet',
      'withdraw from wallet',
    ];

    // Create permissions in the database
    foreach ($permissions as $permission) {
      Permission::create(['name' => $permission]);
    }

    // Assign permissions to admin role (admin can do everything)
    $adminRole->syncPermissions(Permission::all());

    // Assign specific permissions to the user role (user has limited permissions)
    $userRole->syncPermissions([
      'view plans',
      'view lookups',
      'create lookups',
      'view wallet',
      'add funds to wallet'
    ]);
  }
}
