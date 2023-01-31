<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Content\CategoryController;
use App\Http\Controllers\Content\ProductController;

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

Route::post('auth/register', RegisterController::class);
Route::post('auth/login', LoginController::class);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', LogoutController::class);
 
    Route::get('/category-products', [CategoryController::class, 'index'])
            ->name('index');
    Route::get('/category-products/{id}', [CategoryController::class, 'show'])
            ->name('show');
    Route::post('/category-products', [CategoryController::class, 'store'])
            ->name('store');
    Route::put('/category-products/{id}', [CategoryController::class, 'update'])
            ->name('update');
    Route::delete('/category-products/{id}', [CategoryController::class, 'destroy'])
            ->name('destroy');

    Route::get('/products', [ProductController::class, 'index'])
            ->name('index');
    Route::get('/products/{id}', [ProductController::class, 'show'])
            ->name('show');
    Route::post('/products', [ProductController::class, 'store'])
            ->name('store');
    Route::put('/products/{id}', [ProductController::class, 'update'])
            ->name('update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])
            ->name('destroy');
});
