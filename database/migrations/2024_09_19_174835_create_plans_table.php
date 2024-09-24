<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('plans', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('plan_tags')->nullable();
      $table->decimal('plan_cost', 10, 2)->default(0);
      $table->json('features')->nullable();
      $table->enum('plan_type', ['days', 'monthly', 'yearly'])->default("monthly");
      $table->integer("lookup_limit")->default(0);
      $table->tinyInteger('is_free')->default(false)->comment("False=> Paid, True => Free");
      $table->boolean('status')->default(1)->comment(comment: "1=> Active, 0 => Inactive");
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('plans');
  }
};
