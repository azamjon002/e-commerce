<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin','middleware'=>'auth'], function (){
   Route::get('dashboard',[\App\Http\Controllers\AdminController::class, 'admin'])->name('admin');

   //Banner Section
    Route::resource('banner','\App\Http\Controllers\BannerController');
    Route::post('banner_status', [\App\Http\Controllers\BannerController::class, 'bannerStatus'])->name('banner.status');

   //Category Section
    Route::resource('category','\App\Http\Controllers\CategoryController');
    Route::post('category_status', [\App\Http\Controllers\CategoryController::class, 'categoryStatus'])->name('category.status');
});
