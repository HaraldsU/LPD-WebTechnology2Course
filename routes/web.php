<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('landing');
// });

Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/home', [BlogController::class, 'getData'])->name('home')->middleware('verified');
Route::get('/', [BlogController::class, 'getData']);

Route::get('/blog/{id}', [BlogController::class, 'index']);

Route::get('/category', [BlogCategoryController::class, 'getData']);
Route::get('/category/{id}', [BlogController::class, 'index2']);

Route::get('/createblog', [BlogController::class, 'create'])->middleware('verified');

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/blog/delete/{id}', [BlogController::class, 'destroy'])->middleware('verified');
Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->middleware('verified');
Route::post('/blog/search', [BlogController::class, 'search'])->name('bsearch');
Route::post('/blogsbycateg/search', [BlogController::class, 'search1'])->name('bsearch1');


Route::get('/createcategory', [BlogCategoryController::class, 'create'])->middleware('verified');

Route::get('/category/delete/{id}', [BlogCategoryController::class, 'destroy'])->middleware('verified');
Route::get('/category/edit/{id}', [BlogCategoryController::class, 'edit'])->middleware('verified');
Route::post('/category/search', [BlogCategoryController::class, 'search'])->name('csearch');

Route::get('/comment/delete/{id}', [CommentController::class, 'destroy'])->middleware('verified');
Route::get('/user/{id}', [UserController::class, 'show'])->middleware('verified');

Route::get('/keywords', [KeywordController::class, 'create'])->middleware('verified');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('blog', BlogController::class, ['except'=>['index','create']]);
Route::resource('category', BlogCategoryController::class, ['except'=>['index','create']])->middleware('verified');
Route::resource('comment', CommentController::class, ['except'=>['index','create']])->middleware('verified');
Route::resource('user', UserController::class, ['except'=>['index','create']])->middleware('verified');
Route::resource('keyword', KeywordController::class, ['except'=>['index','create']])->middleware('verified');
