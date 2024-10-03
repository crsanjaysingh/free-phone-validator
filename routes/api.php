<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Phone\ApiRequestController;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');


Route::post('phone', [ApiRequestController::class, "index"])->middleware('token_verify')->name('api.phone');
