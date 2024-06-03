<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;

Route::get('/', [MovieController::class, 'index']);
Route::post('/', [MovieController::class, 'create'])->middleware('auth');
Route::delete('/delete/{id}', [MovieController::class, 'deleteMovie'])->middleware('auth');

route::get('/login',[logincontroller::class, 'index'])->name('login')->middleware('guest');
route::post('/login',[logincontroller::class, 'authenticate']);
route::post('/logout',[logincontroller::class, 'logout'])->middleware('auth');

route::get('/register',[RegisterController::class, 'index'])->middleware('guest');
route::post('/register',[RegisterController::class, 'store']);
Route::get('/{id}', [MovieController::class, 'show'])->name('showMovies');

Route::post('/addComment', [CommentController::class, 'addComment'])->name('addComment');
Route::delete('/deleteComment/{id}', [CommentController::class, 'deleteComment'])->middleware('auth');

Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/editMovie/{id}', [MovieController::class, 'editMovie'])->name('editMovie');
Route::put('/updateMovie', [MovieController::class, 'updateMovie'])->name('updateMovie');

Route::get('/admin',[AdminController::class,'index'])->name('admin')->middleware('auth');

Route::get('/contact', [ContactController::class, 'index'])->name('contactIndex');
Route::post('/contact', [ContactController::class, 'store'])->name('contactStore');
















// // Route::get('/dashboard', function () {
// //     return view('dashboard');
// // })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// // Route::middleware('auth','verified')->group(function () {

// // });

// require __DIR__.'/auth.php';
