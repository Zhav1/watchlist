<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // Query untuk menghitung total
        $totalMovies = Movie::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalComments = Comment::count();

        // Query untuk mendapatkan data users dan comments dengan pagination
        $users = User::withCount(['watchlists', 'comments'])
            ->where('role', 'user') // Memfilter hanya pengguna dengan peran 'user'
            ->simplePaginate(5, ['*'], 'user_page');

        $comments = Movie::withCount(['comments', 'users'])
            ->simplePaginate(5, ['*'], 'comment_page');

        return view('adminPage.home', [
            'users' => $users,
            'comments' => $comments,
            'totalMovies' => $totalMovies,
            'totalUsers' => $totalUsers,
            'totalComments' => $totalComments,
        ]);
    }

    public function detailmovies()
    {
        $movies = Movie::all(); // Mengambil semua data movie dari database

        return view('adminPage.detailmovie', [
            'movies' => $movies
        ]);
    }

    public function detailuser()
    {
        $users = User::all()->where('role','user'); // Mengambil semua data user dari database

        return view('adminPage.detailuser', [
            'users' => $users
        ]);
    }


}
