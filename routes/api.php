<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\CategoryResponsibleApiController;
use App\Http\Controllers\Api\RequisitionApiController;
use App\Http\Controllers\Api\RequisitionImageApiController;
use App\Http\Controllers\Api\RoleApiController;
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

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('users', UserApiController::class);
    Route::apiResource('roles', RoleApiController::class);
    Route::apiResource('categories', CategoryApiController::class);
    Route::apiResource('subcategories', SubcategoryApiController::class);
    Route::apiResource('responsibles', CategoryResponsibleApiController::class);
    Route::apiResource('requisitions', RequisitionApiController::class);
    Route::apiResource('requisitions.images', RequisitionImageApiController::class);
});
