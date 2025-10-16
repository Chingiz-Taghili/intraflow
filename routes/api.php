<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\CategoryResponsibleApiController;
use App\Http\Controllers\Api\RequisitionApiController;
use App\Http\Controllers\Api\RequisitionImageApiController;
use App\Http\Controllers\Api\SubcategoryApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ---------- PUBLIC API ----------
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);


// ---------- PROTECTED API ----------
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/me', [AuthApiController::class, 'me']);

    Route::apiResource('requisitions', RequisitionApiController::class)
        ->except('index');
    Route::apiResource('users', UserApiController::class)->only('update');

    Route::middleware('role:admin|superadmin')->group(function () {
        Route::apiResource('categories', CategoryApiController::class);
        Route::apiResource('categories.subcategories', SubcategoryApiController::class);
        Route::apiResource('responsibles', CategoryResponsibleApiController::class);
        Route::apiResource('requisitions', RequisitionApiController::class)
            ->only('index');
        Route::apiResource('requisitions.images', RequisitionImageApiController::class);
    });

    Route::middleware('role:superadmin')->group(function () {
        Route::apiResource('users', UserApiController::class)->except('update');
    });
});
