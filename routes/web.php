<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin-dashboard');

    //Users
    Route::get('/users', [App\Http\Controllers\UserController::class, 'getUsers'])->name('users');
   // Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'getUsers'])->name('users');


    //Banners
    Route::get('/banners', [App\Http\Controllers\BannerController::class, 'getBanners'])->name('banners');
    Route::get('/banners/add', [App\Http\Controllers\BannerController::class, 'addBanners'])->name('banners.add');
    Route::post('/banners/store', [App\Http\Controllers\BannerController::class, 'storeBanners'])->name('banners.store');
    Route::post('/updateStatus', [App\Http\Controllers\BannerController::class, 'updateStatus'])->name('banners.status');

    //Categories
    Route::get('/categories', [App\Http\Controllers\CoreController::class, 'getCategories'])->name('categories');
    Route::get('/categories/{id}', [App\Http\Controllers\CoreController::class, 'getCategoryById']);

    //Brands
    Route::get('/brands', [App\Http\Controllers\CoreController::class, 'getBrands'])->name('brands');
    Route::post('/brands/add', [App\Http\Controllers\CoreController::class, 'storeBrands'])->name('brands.add');

});
