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
    Schema::create('subscriptions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->foreignId('plan_id')->constrained('plans')->onDelete('cascade');
      $table->integer('lookups_remaining')->default(0);
      $table->timestamp('started_at')->nullable();
      $table->timestamp('ends_at')->nullable();
      $table->boolean('is_recurring')->default(true);
      $table->timestamp('next_billing_date')->nullable();
      $table->boolean('status')->default(true);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('subscriptions');
  }
};
