<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PhoneValidationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\OtpController;

Route::post('/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');
Route::get('/', function () {
  return view('frontend.home', ['title' => 'Home Page']);
})->name(name: 'home');
Route::get('otp-verify', action: [OtpController::class, 'show'])->name('otp.verify');
Route::post('otp-verify', action: [OtpController::class, 'verify'])->name('otp.verify.store');
Route::get('/about', function () {
  return view('frontend.about');
})->name('about');

Route::get('contact', [ContactController::class, 'index'])->name('contact.get');
Route::post('contact', [ContactController::class, 'contact'])->name('contact.post');

Route::get('/privacy-policy', function () {
  return view('frontend.privacy-policy');
})->name('privacy.policy');

Route::get('/terms-of-service', function () {
  return view('frontend.terms-of-service');
})->name('terms.of.service');

Route::get('/refund-policy', function () {
  return view('frontend.refund-policy');
})->name('refund.policy');

Route::get('/faqs', function () {
  return view('frontend.faqs');
})->name('faqs');
// 1440 minute for a day
Route::post('/validate-phone', [PhoneValidationController::class, 'validatePhone'])->middleware('throttle:20,1440')->name('validate.phone');

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(middleware: ['auth', 'verified'])->name('dashboard');
// right_user

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/user.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/theme.php';
