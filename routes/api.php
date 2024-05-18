<?php

use App\Http\Controllers\CategoryControler;
use App\Http\Controllers\ProductControler;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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



Route::middleware(['jwt-auth'])->group(function () {
    Route::middleware(['role-everyone'])->group(function() {
        Route::get('products', [ProductControler::class, 'read']);
        Route::get('products/{id}', [ProductControler::class, 'readById']);
        Route::post('products', [ProductControler::class, 'create']);
        Route::put('products/{id}', [ProductControler::class, 'update']);
        Route::delete('products/{id}', [ProductControler::class, 'delete']);
    });
    
    Route::middleware(['role-admin'])->group(function() {
        Route::get('categories', [CategoryControler::class, 'read']);
        Route::get('categories/{id}', [CategoryControler::class, 'readById']);
        Route::post('categories', [CategoryControler::class, 'create']);
        Route::put('categories/{id}', [CategoryControler::class, 'update']);
        Route::delete('categories/{id}', [CategoryControler::class, 'delete']);
    });
});

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
