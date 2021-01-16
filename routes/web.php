<?php

use App\Http\Controllers\UserController;
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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home', [App\Http\Controllers\UserController::class, 'indexHome'])->name('loggedIn');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/news/index', [\App\Http\Controllers\PostController::class, 'index'])->name('news');
    Route::get('/news/create', [\App\Http\Controllers\PostController::class, 'create'])->name('news.create');
    Route::post('/news/create', [\App\Http\Controllers\PostController::class, 'store'])->name('news.createPost');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/news/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('news.edit');
    Route::patch('/news/{post}/edit', [\App\Http\Controllers\PostController::class, 'update'])->name('news.update');
    Route::get('news/{post}/delete', [\App\Http\Controllers\PostController::class, 'destroy'])->name('news.delete');
});



Route::group(['middleware' => ['auth']], function () {
    Route::resource('user', UserController::class);
    Route::get('user/{user}', [UserController::class, 'indexHome'])->name('login');
    Route::get('user/{user}/delete', [UserController::class, 'destroy'])->name('user.delete');
});
