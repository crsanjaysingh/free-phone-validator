<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneValidationController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    // return view('welcome');
    return view('home');
});

Route::post('/validate-phone', [PhoneValidationController::class, 'validatePhone'])->name('validate.phone');;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/theme.php';
