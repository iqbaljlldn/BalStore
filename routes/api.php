<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('register/check', [RegisterController::class,'check'])->name('api-register-check');
Route::get('provinces', [LocationController::class, 'provinces'])->name('api-provinces');
Route::get('regencies/{provinces_id}', [LocationController::class, 'regencies'])->name('api-regencies');
Route::get('districts/{regencies_id}', [LocationController::class, 'districts'])->name('api-districts');
Route::get('villages/{districts_id}', [LocationController::class, 'villages'])->name('api-villages');
