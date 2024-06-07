<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
     public function index()
    {
        $movies = Movie::all();
        return view('main.home', ['films' => $movies]);
    }

}
