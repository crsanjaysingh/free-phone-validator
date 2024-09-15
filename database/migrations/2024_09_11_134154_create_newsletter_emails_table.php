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
    Schema::create('newsletter_emails', function (Blueprint $table) {
      $table->id();
      $table->string('email')->unique();
      $table->tinyInteger('status')->default(0)->comment("1=>Unsubscribed, 0=> Subscribed");
      $table->tinyInteger('block')->default(0)->comment("1=>Blocked, 0=>Unblocked");
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('newsletter_emails');
  }
};
