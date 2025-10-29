<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryResponsibleController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\RequisitionController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// -------------------- PUBLIC ROUTES --------------------
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('categories.subcategories', SubcategoryController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('responsibles', CategoryResponsibleController::class);
        Route::resource('requisitions', RequisitionController::class)
            ->only('index');
        Route::resource('users', UserController::class)->except('update');
        Route::post('users/{user}/assign-role/{role}', [UserController::class, 'assignRole']);
        Route::delete('users/{user}/remove-role/{role}', [UserController::class, 'removeRole']);
});



// -------------------- PROTECTED ROUTES --------------------
Route::middleware(['auth'])->group(function () {



    // -------------------- Admin-panel routes --------------------
    /*Route::prefix('admin')->name('admin.')->middleware(['verified'])->group(function () {

        // -------------------- admin|superadmin only --------------------
        Route::middleware(['role:admin|superadmin'])->group(function () {
            Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
            Route::resource('categories', CategoryController::class);
            Route::resource('categories.subcategories', SubcategoryController::class);
            Route::resource('departments', DepartmentController::class);
            Route::resource('responsibles', CategoryResponsibleController::class);
            Route::resource('requisitions', RequisitionController::class)
                ->only('index');
        });


        // -------------------- superadmin only --------------------
        Route::middleware(['role:superadmin'])->group(function () {
            Route::resource('users', UserController::class)->except('update');
            Route::post('users/{user}/assign-role/{role}', [UserController::class, 'assignRole']);
            Route::delete('users/{user}/remove-role/{role}', [UserController::class, 'removeRole']);
        });
    });*/
});
