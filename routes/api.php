<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Register Customer




Route::post('register', [AuthController::class, 'register']);
// Login Customer
Route::post('login', [AuthController::class, 'customerLogin']);


// Product
Route::get('search_product', [ProductController::class, 'searchProduct']);
Route::get('all_products', [ProductController::class, 'allProducts']);
Route::get('get_product', [ProductController::class, 'getProduct']);

    // get all category
Route::get('category' , [CategoryController::class , 'getAllCategory']);
Route::group(['middleware' => ['auth:sanctum'] ], function () {

    // Logout
    Route::get('logout', [AuthController::class, 'logout']);

    // Edit User Info
    Route::group(['prefix' => 'account'], function () {
        Route::get('/show_profile', [UserController::class, 'getProfile']);
        Route::post('/update', [UserController::class, 'updateUserInfo']);
        Route::post('/update_password', [UserController::class, 'updateUserPassword']);
        Route::post('/delete', [UserController::class, 'deleteUserAccount']);
    });

    // Cart
    Route::group(['prefix' => 'cart'], function () {
        Route::get('/details', [CartController::class, 'getCartDetails']);
        Route::post('/add_product', [CartController::class, 'addProductToCart']);
        Route::post('/remove_product', [CartController::class, 'removeProductFromCart']);
    });

    // Order
    Route::group(['prefix' => 'order'], function () {
        Route::post('checkout', [OrderController::class, 'userCheckout']);
        Route::get('all', [OrderController::class, 'getUserOrders']);
        Route::get('details', [OrderController::class, 'getOrderTrackDetails']);
        Route::get('cancel', [OrderController::class, 'cancelOrder']);
    });


});



