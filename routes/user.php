<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\UserWalletController;
use App\Http\Controllers\User\LookupController;
use App\Http\Controllers\User\UserPlanController;
use App\Http\Controllers\User\ProfileController as UserProfile;


Route::group(['middleware' => ['auth', 'verified', 'role:user'], 'prefix' => 'user', 'as' => 'user.'], function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('profile', [UserProfile::class, 'index'])->name('profile');
  Route::post('profile', [UserProfile::class, 'store'])->name('profile.store');
  Route::delete('/profile', [UserProfile::class, 'destroy'])->name('profile.destroy');
  Route::get('wallet/history/{userId?}',  [UserWalletController::class, 'showWalletHistory'])->name('wallet.history');
  Route::get('recent-lookups', [LookupController::class, 'index'])->name('lookup.index');
  Route::get('recent-lookups/data', [LookupController::class, 'getData'])->name('lookup.data');
  Route::get('my-plan', [UserPlanController::class, 'index'])->name(name: 'plans.index');
  Route::get('my-plan/edit{userId?}', [UserPlanController::class, 'index'])->name(name: 'plans.edit');
  Route::get('my-plan/show/{userId?}', [UserPlanController::class, 'index'])->name(name: 'plans.show');
});
