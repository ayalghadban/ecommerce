<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;




// Register Customer
Route::post('/register', [AuthController::class, 'register']);
// Login Customer
Route::post('/login', [AuthController::class, 'login']);
// Product
Route::get('/search_product', [ProductController::class, 'search_product']);
Route::get('/get_product', [ProductController::class, 'get_product']);

// get all category
Route::get('/category' , [CategoryController::class , 'get_all_categories']);

Route::group(['middleware' => ['auth:sanctum'] ], function ()
{
    // Logout
    Route::get('logout', [AuthController::class, 'logout']);

    // Edit User Info
    Route::prefix('account')->group( function () {
        Route::get('/show_profile', [UserController::class, 'get_profile']);
        Route::post('/update', [UserController::class, 'update_user']);
        Route::post('/delete', [UserController::class, 'delete_user_account']);
    });

    // Cart
    Route::prefix('cart')->group( function () {
        Route::get('/details', [CartController::class, 'get_cart_details']);
        Route::post('/add_product', [CartController::class, 'add_product_to_cart']);
        Route::post('/remove_product', [CartController::class, 'remove_product_from_cart']);
    });

    // Order
    Route::prefix('order')->group( function () {
        Route::get('/all_orders', [OrderController::class, 'get_all_orders']);
        Route::get('/search_order',[OrderController::class, 'search_order']);
        Route::post('/create_order',[OrderController::class, 'create_order']);
        Route::post('/update_order',[OrderController::class, 'update_order']);
        Route::delete('/delete_order',[OrderController::class, 'delete_order']);
    });
});
