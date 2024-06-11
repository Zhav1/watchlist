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
Route::post('/', [MovieController::class, 'create'])->name('movies.create')->middleware('auth');
Route::delete('/delete/{id}', [MovieController::class, 'deleteMovie'])->name('deleteMovie')->middleware('auth');

// Search route
Route::get('/search', [MovieController::class, 'search'])->name('movies.search')->middleware('auth');

// Authentication routes
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// Registration routes
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Movie specific routes
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('showMovies');  // Changed to avoid conflict with home route
Route::get('/editMovie/{id}', [MovieController::class, 'editMovie'])->name('editMovie')->middleware('auth');
Route::put('/updateMovie', [MovieController::class, 'updateMovie'])->name('updateMovie')->middleware('auth');

// Comment routes
Route::post('/addComment', [CommentController::class, 'addComment'])->name('addComment')->middleware('auth');
Route::delete('/deleteComment/{id}', [CommentController::class, 'deleteComment'])->name('deleteComment')->middleware('auth');

// User routes
Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('auth');
Route::get('/input', [UserController::class, 'index'])->name('input')->middleware('auth');
Route::post('/input', [UserController::class, 'store'])->middleware('auth');

// Admin routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('auth');

// Contact routes
Route::get('/contact', [ContactController::class, 'index'])->name('contactIndex');
Route::post('/contact', [ContactController::class, 'store'])->name('contactStore');
