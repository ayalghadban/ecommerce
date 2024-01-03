<?php

use App\Http\Controllers\DashBoard\AuthController;
use App\Http\Controllers\DashBoard\CategoryController;
use App\Http\Controllers\DashBoard\OrderController;
use App\Http\Controllers\DashBoard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;

// Login Admin

Route::group(['prefix' => 'admin'], function () {

    Route::post('login', [AuthController::class, 'adminLogin']);

    Route::group(['middleware' => ['auth:sanctum'] ], function () {

        // Logout
        Route::get('logout', [AuthController::class, 'logout']);

        // Category Management
        Route::group(['prefix' => 'category'], function () {
            Route::get('/all' , [CategoryController::class ,'get_all_categories']);
            Route::post('/create' , [CategoryController::class ,'add_category']);
            Route::post('/update' , [CategoryController::class ,'update_category']);
            Route::post('/delete' , [CategoryController::class ,'delete_category']);
            Route::post('/change_status' , [CategoryController::class ,'update_category_status']);
        });

        // Order Management
        Route::group(['prefix' => 'order'], function () {
            Route::get('/all' , [OrderController::class ,'getAllOrder']);
            Route::get('/' , [OrderController::class ,'getOrder']);
            Route::post('/accept', [OrderController::class, 'acceptPendingOrder']);
            Route::post('/cancel', [OrderController::class, 'cancelOrder']);
            Route::post('/delivering', [OrderController::class, 'deliveringAcceptedOrder']);
            Route::post('/delivered', [OrderController::class, 'makeOrderDelivered']);
            Route::post('/delete', [OrderController::class, 'deleteOrder']);
        });

        // Products Management
        Route::group(['prefix' => 'product'], function () {
            Route::get('/all', [ProductController::class, 'all']);
            Route::get('/details', [ProductController::class, 'getProduct']);
            Route::post('/add', [ProductController::class, 'addProduct']);
            Route::post('/update', [ProductController::class, 'updateProduct']);
            Route::post('/delete', [ProductController::class, 'deleteProduct']);
            Route::post('/update_status', [ProductController::class, 'updateProductStatus']);
        });

        // User Management
        Route::group(['prefix' => 'user'], function () {
            Route::get('/all', [UserController::class, 'allUser']);
            Route::post('/update', [UserController::class, 'updateUser']);
            Route::post('/delete', [UserController::class, 'deleteUser']);
        });

    });

});



