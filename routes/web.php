<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\Auth\LoginController;
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
    return view('landing');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [BlogController::class, 'getData']);
Route::get('/blog/{id}', [BlogController::class, 'index']);

Route::get('/category', [BlogCategoryController::class, 'getData']);
Route::get('/category/{id}', [BlogController::class, 'index2']);

Route::get('/createblog', [BlogController::class, 'create']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/blog/delete/{id}', [BlogController::class, 'destroy']);
Route::get('/blog/edit/{id}', [BlogController::class, 'edit']);
Route::post('/blog/search', [BlogController::class, 'search'])->name('bsearch');

Route::get('/createcategory', [BlogCategoryController::class, 'create']);

Route::get('/category/delete/{id}', [BlogCategoryController::class, 'destroy']);
Route::get('/category/edit/{id}', [BlogCategoryController::class, 'edit']);
Route::post('/category/search', [BlogCategoryController::class, 'search'])->name('csearch');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('blog', BlogController::class, ['except'=>['index','create']]);
Route::resource('category', BlogCategoryController::class, ['except'=>['index','create']]);
