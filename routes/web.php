<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', [MovieController::class, 'index']);
Route::post('/', [MovieController::class, 'create']);

// Route::get('/token', return csrf_token());

