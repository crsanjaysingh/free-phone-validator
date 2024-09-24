<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LookupController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Wallet\WalletController;
use App\Http\Controllers\Admin\DashboardController;


Route::group(['middleware' => ['auth', 'verified', 'role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('profile', [ProfileController::class, 'index'])->name('profile');
  Route::post('profile', [ProfileController::class, 'store'])->name('profile.store');
  Route::get('users', [UserController::class, 'index'])->name('users.index');
  Route::post('block/{userId?}', [UserController::class, 'block'])->name('users.block');
  Route::post('wallet/add', [WalletController::class, 'addFunds'])->name('wallet.add');
  Route::post('wallet/update', action: [WalletController::class, 'updateFunds'])->name('wallet.edit');
  Route::get('wallet/history/{userId?}', [WalletController::class, 'showWalletHistory'])->name('wallet.history');
  Route::get('recent-lookups', [LookupController::class, 'index'])->name('lookup.index');
  Route::get('recent-lookups/data', [LookupController::class, 'getData'])->name('lookup.data');
  Route::resource('plans', PlanController::class);
  Route::get('plans/toggle/{planId}', [PlanController::class, 'toggleStatus'])->name('plans.toggle');
});
