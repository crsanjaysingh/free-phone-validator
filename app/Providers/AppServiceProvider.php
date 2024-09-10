<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;
use App\Services\RecaptchaService;


class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    $this->app->bind(RecaptchaService::class, function () {
      return new RecaptchaService();
    });
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    //
  }
}
