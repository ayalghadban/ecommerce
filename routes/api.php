<?php



// Register Customer

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
// Login Customer
// Product
Route::get('/search_product', [ProductController::class, 'search_product']);
Route::get('/get_product', [ProductController::class, 'get_product']);

// get all category
Route::get('/category' , [CategoryController::class , 'get_all_categories']);
Route::get('/search_category',[CategoryController::class, 'search']);
Route::group(['middleware' => ['auth:sanctum','abilities:user-api'] ], function ()
{
    Route::post('/login', [AuthController::class, 'customerLogin']);

    // Logout
    Route::get('logout', [AuthController::class, 'logout']);

    // Edit User Info
    Route::prefix('account')->group( function () {
        Route::get('/show_profile', [UserController::class, 'get_profile']);
        Route::post('/update', [UserController::class, 'update_user']);
        Route::post('/delete', [UserController::class, 'delete_user_account']);
    });

});
