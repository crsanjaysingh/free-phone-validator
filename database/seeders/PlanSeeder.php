<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('plans')->insert([
      [
        'name' => 'Basic Plan',
        'plan_tags' => 'starter,individual',
        'plan_cost' => 0.00,
        'features' => json_encode(['feature_1' => 'Access to basic features', 'feature_2' => 'Email support']),
        'plan_type' => 'monthly',
        'lookup_limit' => 600,
        'is_free' => true,
        'status' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Pro Plan',
        'plan_tags' => 'advanced,professional',
        'plan_cost' => 49.99,
        'features' => json_encode(['feature_1' => 'All Basic Plan features', 'feature_2' => 'Priority support', 'feature_3' => 'Custom reports']),
        'plan_type' => 'monthly',
        'lookup_limit' => 6000,
        'is_free' => false,
        'status' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Enterprise Plan',
        'plan_tags' => 'enterprise,business',
        'plan_cost' => 199.99,
        'features' => json_encode(['feature_1' => 'All Pro Plan features', 'feature_2' => 'Dedicated account manager', 'feature_3' => '24/7 support']),
        'plan_type' => 'yearly',
        'lookup_limit' => 60000,
        'is_free' => false,
        'status' => true,
        'created_at' => now(),
        'updated_at' => now(),
      ]
    ]);
  }
}
