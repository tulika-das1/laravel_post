<?php

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
Route::get('/create-post',[PageController::class, 'createPost'])->name('create-post');
Route::post('/create-post', [PageController::class, 'createPostProcess']);
Route::get('/all-posts', [PageController::class, 'allPosts'])->name('all-posts');
Route::get('/post/{post}', [PageController::class, 'singlePost'])->name('single-post');
Route::get('/edit-post/{post}', [PageController::class, 'editPost'])->name('edit-post');
Route::post('/edit-post/{post}', [PageController::class, 'updatePost']);

