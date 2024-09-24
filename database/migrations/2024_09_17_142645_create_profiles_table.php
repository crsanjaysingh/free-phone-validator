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
    Schema::create('profiles', function (Blueprint $table) {
      $table->id();
      $table->string('role')->default('user');
      $table->string('first_name');
      $table->string('last_name');
      $table->string('email')->unique();
      $table->string('organization')->nullable();
      $table->string('phone_number')->nullable();
      $table->string('address')->nullable();
      $table->string('state')->nullable();
      $table->string('zip_code')->nullable();
      $table->string('country')->nullable();
      $table->string('language')->nullable();
      $table->string('timezone')->nullable();
      $table->string('currency')->nullable();
      $table->string('profile_image')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('profiles');
  }
};
