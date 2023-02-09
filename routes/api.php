<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Api\SettingController;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ProductCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UploadController;

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
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['prefix' => 'media'], function () {
        Route::post('getImagePath', [UploadController::class, 'getImagePath']);
        Route::post('deleteImage', [UploadController::class, 'deleteImage']);
    });

    Route::group(['prefix' => 'setting'], function () {
        Route::post('save', [SettingController::class, 'save']);
        Route::get('', [SettingController::class, 'index']);
    });

    Route::group(['as' => 'product-category.'], function () {
        Route::get('product-category', [ProductCategoryController::class, 'list'])->name('index');
        Route::post('product-category/search/', [ProductCategoryController::class, 'search'])->name('search');
        Route::get('product-category/{category}', [ProductCategoryController::class, 'show'])->name('show');
        Route::post('product-category', [ProductCategoryController::class, 'store'])->name('store');
        Route::put('product-category/{category}', [ProductCategoryController::class, 'update'])->name('update');
        Route::delete('product-category/{category}', [ProductCategoryController::class, 'destroy'])->name('destroy');
    });
});
