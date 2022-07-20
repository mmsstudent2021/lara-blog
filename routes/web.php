<?php

use App\Http\Controllers\PhotoController;
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

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;

Route::get('/',[PageController::class,'index'])->name('page.index');
Route::get('/detail/{slug}',[PageController::class,'detail'])->name('page.detail');
Route::get("/category/{category:slug}",[PageController::class,'postByCategory'])->name('page.category');


Route::get('/file-test', function () {
    return \Illuminate\Support\Facades\Storage::allFiles('public');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get("/test",[HomeController::class,'test'])->name('test');

Route::middleware("auth")->prefix("dashboard")->group(function(){
    Route::resource('/category',CategoryController::class);
    Route::resource('/post',PostController::class);
    Route::resource('/photo',PhotoController::class);
    Route::resource('/nation',\App\Http\Controllers\NationController::class);
    Route::resource("/user",\App\Http\Controllers\UserController::class)->middleware('isAdmin');
});
