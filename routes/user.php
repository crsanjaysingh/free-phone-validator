<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\UserWalletController;
use App\Http\Controllers\User\LookupController;
use App\Http\Controllers\User\UserPlanController;
use App\Http\Controllers\User\ProfileController as UserProfile;
use App\Http\Controllers\User\SubscriptionController;


Route::group(['middleware' => ['auth', 'verified', 'role:user'], 'prefix' => 'user', 'as' => 'user.'], function () {

  // Dashboard
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  // Profile
  Route::get('profile', [UserProfile::class, 'index'])->name('profile');
  Route::post('profile', [UserProfile::class, 'store'])->name('profile.store');
  Route::delete('/profile', [UserProfile::class, 'destroy'])->name('profile.destroy');

  // Wallet
  Route::get('wallet/history/{userId?}',  [UserWalletController::class, 'showWalletHistory'])->name('wallet.history');

  // Lookups
  Route::get('recent-lookups', [LookupController::class, 'index'])->name('lookup.index');
  Route::get('recent-lookups/data', [LookupController::class, 'getData'])->name('lookup.data');

  // Plans
  Route::get('my-plan', [UserPlanController::class, 'index'])->name(name: 'plans.index');
  Route::post('plan-status', [UserPlanController::class, 'planStatus'])->name(name: 'plan.status');

  // Subscriptions
  Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name("subscribe");
  Route::post('/update-plan', [SubscriptionController::class, 'changePlan'])->name("update.subscription");
  Route::get('/check-lookup-limit', [SubscriptionController::class, 'checkLookupLimit']);
  Route::post('/process-subscription-fees', [SubscriptionController::class, 'autoDeductSubscriptionFees']);
});
