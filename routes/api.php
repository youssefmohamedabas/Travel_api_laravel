<?php

use App\Http\Controllers\Api\V1\Admin\TravelController as AdminTravelController;
use App\Http\Controllers\Api\V1\Admin\TourController as AdminTourController;

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\TravelController;
use App\Http\Controllers\API\V1\TourController;
use App\Http\Middleware\RoleMiddleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/travels', [TravelController::class, 'index'])->name('home');
Route::get('/travels/{travel:slug}/tours', [TourController::class, 'index']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('travels', [AdminTravelController::class, 'store'])->name('admin.store');
    Route::post('travels/{travel}/tours', [AdminTourController::class, 'store'])->name('admin.tourstore');
});
Route::post('login', [LoginController::class, '__invoke']);