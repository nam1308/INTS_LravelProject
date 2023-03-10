<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryBlogController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\BannerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::match(['POST', 'GET'], 'login', [AuthController::class, 'login'])->name('admin.login');
Route::match(['POST', 'GET'], 'reset-password', [AuthController::class, 'resetPassword'])->name('admin.resetPassword');
Route::middleware(['middleware' => 'auth'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('', [DashboardController::class, 'index'])->name('admin.home');
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('settings', [SettingController::class, 'index'])->name('admin.setting');

        // Test
        Route::post('', [DashboardController::class, 'test'])->name('admin.test');

        // Products
        Route::group(['prefix' => 'products'], function () {
            Route::get('', [ProductController::class, 'index'])->name('index');
            Route::get('create', [ProductController::class, 'create'])->name('create');
            Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::get('{id}/duplicate', [ProductController::class, 'duplicate'])->name('duplicate');

            Route::get('category', [ProductController::class, 'category']);
            Route::get('attribute', [ProductController::class, 'attribute']);
            Route::get('attribute/variation/{id}', [ProductController::class, 'variation'])->name('variation');
        });

        //Settings
        Route::group(['prefix' => 'settings'], function () {
            Route::get('', [SettingController::class, 'index']);
            Route::get('menu', [SettingController::class, 'menu']);
        });

        // Blog
        Route::group(['prefix' => 'blog'], function () {
            Route::get('', [BlogController::class, 'index'])->name('index');
            Route::get('create', [BlogController::class, 'create'])->name('create');
            Route::get('{id}/edit', [BlogController::class, 'edit']);
        });

        // Category Blog
        Route::group(['prefix' => 'categoryBlog'], function () {
            Route::get('', [CategoryBlogController::class, 'index'])->name('index');
            Route::get('create', [CategoryBlogController::class, 'create'])->name('create');
            Route::get('{id}/edit', [CategoryBlogController::class, 'edit'])->name('edit');
        });

        // Testimonials
        Route::group(['prefix' => 'testimonial'], function (){
            Route::get('',[TestimonialController::class, 'index'])->name('index');
        });

        // Banner
        Route::group(['prefix' => 'banner'], function (){
            Route::get('',[BannerController::class, 'index'])->name('index');
        });

    });
});

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('', [HomeController::class, 'index']);
});

