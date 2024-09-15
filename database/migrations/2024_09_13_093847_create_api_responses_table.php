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
    Schema::create('api_responses', function (Blueprint $table) {
      $table->id();
      $table->string('lookup_type');
      $table->string('lookup_for');
      $table->decimal('fraud_score', 5, 2);
      $table->string('status');
      $table->string('country');
      $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
      $table->json('response_data');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('api_responses');
  }
};
