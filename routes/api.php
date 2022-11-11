<?php

use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Users
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);


Route::group( ['middleware' => ["auth:sanctum"]], function(){
    //Users
    Route::get('user-profile', [UserController::class, 'userProfile']);
    Route::get('logout', [UserController::class, 'logout']);


    //Products
    Route::post('insertProduct', [ProductsController::class, 'insertProduct']);
    Route::post('deleteProduct', [ProductsController::class, 'deleteProduct']);
    Route::post('updateProduct', [ProductsController::class, 'updateProduct']);
    Route::post('showProduct', [ProductsController::class, 'showProduct']);

    
    //Categories
    Route::post('insertCategory', [CategoriesController::class, 'insertCategory']);
    Route::post('deleteCategory', [CategoriesController::class, 'deleteCategory']);
    Route::post('updateCategory', [CategoriesController::class, 'updateCategory']);
    Route::post('showCategory', [CategoriesController::class, 'showCategory']);
    
});

Route::middleware('auth:sanctum')->get('/user', function (Request 
$request) {

    return $request->user();
    
});