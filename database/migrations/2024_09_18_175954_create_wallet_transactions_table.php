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
    Schema::create('wallet_transactions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
      $table->decimal('amount', 10, 2);
      $table->foreignId('added_by')->constrained('users')->onDelete('cascade'); // User who added the amount
      $table->text('memo')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('wallet_transactions');
  }
};
