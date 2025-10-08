<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\CategoryResponsibleApiController;
use App\Http\Controllers\Api\RequisitionApiController;
use App\Http\Controllers\Api\RoleApiController;
use App\Http\Controllers\Api\SubcategoryApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('users', UserApiController::class);
Route::apiResource('roles', RoleApiController::class);
Route::apiResource('categories', CategoryApiController::class);
Route::apiResource('subcategories', SubcategoryApiController::class);
Route::apiResource('responsibles', CategoryResponsibleApiController::class);
Route::apiResource('requisitions', RequisitionApiController::class);
