<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\logincontroller;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RegisterController;

Route::get('/', [MovieController::class, 'index']);
Route::post('/', [MovieController::class, 'create']);
Route::delete('/delete/{id}', [MovieController::class, 'deleteMovie']);

route::get('/login',[logincontroller::class, 'index']);
route::post('/login',[logincontroller::class, 'authenticate']);
route::post('/logout',[logincontroller::class, 'logout']);

route::get('/register',[RegisterController::class, 'index']);
route::post('/register',[RegisterController::class, 'store']);




















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

