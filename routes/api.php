<?php

use App\Http\Controllers\API\V1\TravelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/travels', [TravelController::class, 'index']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');