<?php

use App\Http\Controllers\Auth\UserAuthenticationController;
use App\Http\Controllers\PageController;
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

Route::get('/', [PageController::class,'homepage'])->name('homepage');
Route::get('/create-post',[PageController::class, 'createPost'])->middleware('auth')->name('create-post');
Route::post('/create-post', [PageController::class, 'createPostProcess'])->middleware('auth');
Route::get('/all-posts', [PageController::class, 'allPosts'])->name('all-posts');
Route::get('/post/{post}', [PageController::class, 'singlePost'])->name('single-post');
Route::get('/edit-post/{post}', [PageController::class, 'editPost'])->name('edit-post')->middleware('auth');
Route::post('/edit-post/{post}', [PageController::class, 'updatePost'])->middleware('auth');

// Authentication
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [UserAuthenticationController::class, 'registerForm'])->name('register');
    Route::post('/register', [UserAuthenticationController::class, 'register']);

    Route::get('/login', [UserAuthenticationController::class, 'loginForm'])->name('login');
    Route::post('/login', [UserAuthenticationController::class, 'login']);
});

// Dasbhoard
Route::get('/home', [PageController::class, 'home'])->middleware('auth')->name('home');
