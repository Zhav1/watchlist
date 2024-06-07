<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;

// Home and movie routes
Route::get('/', [MovieController::class, 'index']);
Route::post('/', [MovieController::class, 'create'])->middleware('auth');
Route::delete('/delete/{id}', [MovieController::class, 'deleteMovie'])->name('deleteMovie')->middleware('auth');

// Authentication routes
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// Registration routes
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Movie specific routes
Route::get('/{id}', [MovieController::class, 'show'])->name('showMovies');
Route::get('/editMovie/{id}', [MovieController::class, 'editMovie'])->name('editMovie');
Route::put('/updateMovie', [MovieController::class, 'updateMovie'])->name('updateMovie');

// Comment routes
Route::post('/addComment', [CommentController::class, 'addComment'])->name('addComment');
Route::delete('/deleteComment/{id}', [CommentController::class, 'deleteComment'])->name('deleteComment');

// User routes
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/input', [UserController::class, 'index'])->name('input')->middleware('auth');
Route::post('/input', [UserController::class, 'store']);

// Admin routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

// Contact routes
Route::get('/contact', [ContactController::class, 'index'])->name('contactIndex');
Route::post('/contact', [ContactController::class, 'store'])->name('contactStore');
