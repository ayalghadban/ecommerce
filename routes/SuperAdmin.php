<?php

use App\Http\Controllers\Super_Admin\AuthController;
use App\Http\Controllers\Super_Admin\AdminController;
use App\Http\Controllers\Super_Admin\CategoryController;
use App\Http\Controllers\Super_Admin\ProductController;
use App\Http\Controllers\Super_Admin\RoleController;
use App\Http\Controllers\Super_Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('/super_admin')->group(function()
{
    Route::post('/login',[AuthController::class,'login_super_admin']);

    Route::group(['middleware' => ['auth:sanctum','admin-api'] ], function ()
    {
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::prefix('/admin')->group(function ()
        {
            Route::get('/all',[AdminController::class,'all']);
            Route::post('/create',[AdminController::class,'create']);
            Route::post('/update',[AdminController::class,'update']);
            Route::delete('/delete',[AdminController::class,'delete']);
            Route::get('/one',[AdminController::class,'one']);
        });

        Route::prefix('/category')->group(function ()
        {
            Route::get('/all',[CategoryController::class,'all']);
            Route::post('/create',[CategoryController::class,'create']);
            Route::post('/update',[CategoryController::class,'update']);
            Route::delete('/delete',[CategoryController::class,'delete']);
            Route::get('/one',[CategoryController::class,'one']);
        });

        Route::prefix('/sub_category')->group(function ()
        {
            Route::get('/all',[SubCategoryController::class,'all']);
            Route::post('/create',[SubCategoryController::class,'create']);
            Route::post('/update',[SubCategoryController::class,'update']);
            Route::delete('/delete',[SubCategoryController::class,'delete']);
            Route::get('/one',[SubCategoryController::class,'one']);
        });

        Route::prefix('/product')->group(function ()
        {
            Route::get('/all',[ProductController::class,'all']);
            Route::post('/create',[ProductController::class,'create']);
            Route::post('/update',[ProductController::class,'update']);
            Route::delete('/delete',[ProductController::class,'delete']);
            Route::get('/one',[ProductController::class,'one']);
        });

        Route::prefix('/role')->group(function ()
        {
            Route::get('/all',[RoleController::class,'all']);
            Route::post('/create',[RoleController::class,'create']);
            Route::post('/update',[RoleController::class,'update']);
            Route::delete('/delete',[RoleController::class,'delete']);
            Route::get('/one',[RoleController::class,'one']);
        });

        Route::prefix('/permission')->group(function ()
        {
            Route::get('/all',[AdminController::class,'all']);
            Route::post('/create',[AdminController::class,'create']);
            Route::post('/update',[AdminController::class,'update']);
            Route::delete('/delete',[AdminController::class,'delete']);
            Route::get('/one',[AdminController::class,'one']);
        });
    });
});
