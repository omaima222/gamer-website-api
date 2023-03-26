<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(UserController::class)->group(function(){
    Route::get('users', 'index');
    Route::put('updateMyProfile', 'update');
    Route::delete('deleteMyProfile', 'delete');
    Route::post('resetPassword', 'forgetPassword');
});



Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('user', UserController::class);

Route::get('products/title/{searching}', [ProductController::class, 'searchByTitle']);
Route::get('products/category/{searching}', [ProductController::class, 'searchByCategory']);