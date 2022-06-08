<?php

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

Route::get('/', [App\Http\Controllers\PostController::class, 'index']);
Route::get('/posts/{post}/read', [App\Http\Controllers\PostController::class, 'show']);

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/posts/create', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::patch('/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit')->middleware('can:edit,post');
    Route::delete('/posts/{post}/delete', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.delete')->middleware('can:destroy,post');

    Route::middleware(['admin'])->group(function () {
        Route::get('/posts/fetch-posts', App\Http\Controllers\ImportBlogPosts::class);
    });
});

