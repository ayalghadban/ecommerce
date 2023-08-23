<?php

use App\Http\Controllers\DashBoard\AuthController as DashBoardAuthController;
use App\Http\Controllers\DashBoard\CategoryController;
use App\Http\Controllers\DashBoard\ProductController;
use App\Http\Controllers\DashBoard\UserController as DashBoardUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('/dashboard')->group(function()
{
    Route::post('/login',[DashBoardAuthController::class, 'Login']);

    //Routes for user
    Route::prefix('/user')->group(function ()
    {
        Route::get('/all',[DashBoardUserController::class,'get_all_users']);
        Route::get('/one_user',[DashBoardUserController::class, 'get_one_user']);
        Route::post('/create',[DashBoardUserController::class,'create_user']);
        Route::post('/update',[DashBoardUserController::class,'update_user']);
        Route::delete('/delete',[DashBoardUserController::class,'delete_user']);
    });

    Route::prefix('/category')->group(function ()
    {
        Route::get('/all',[CategoryController::class,'get_all_categories']);
        Route::get('/one_category',[CategoryController::class, 'get_one_category']);
        Route::post('/create',[CategoryController::class,'create_category']);
        Route::post('/update',[CategoryController::class,'update_category']);
        Route::delete('/delete',[CategoryController::class,'delete_category']);
    });
    Route::prefix('/product')->group(function ()
    {
        Route::get('/all',[ProductController::class,'get_all_products']);
        Route::get('/one_product',[ProductController::class, 'get_one_product']);
        Route::post('/create',[ProductController::class,'create_product']);
        Route::post('/update',[ProductController::class,'update_product']);
        Route::delete('/delete',[ProductController::class,'delete_product']);
    });
});
