<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    // public function index()
    // {
    //     $movies = Movie::all();
    //     return view('home', ['films' => $movies]);
    // }
    public function index()
    {
        $movies = Movie::where('user_id', Auth::id())->get();
        return view('home', ['films' => $movies]);
    }

    public function create(Request $request)
    {

        $request->validate([
            'movie_name' => 'required|string|max:255',
        ]);

        $movieName = $request->input('movie_name');
        $apiKey = env('OMDB_API_KEY');
        $response = Http::get("http://www.omdbapi.com/?t={$movieName}&apikey={$apiKey}");

        if ($response->successful() && $response['Response'] === 'True') {
            $movieInfo = $response->json();

            Movie::create([
                'imdbID' => $movieInfo['imdbID'],
                'user_id' => auth::id(),
                'title' => $movieInfo['Title'],
                'plot' => $movieInfo['Plot'],
                'poster' => $movieInfo['Poster'],
                'genre' => $movieInfo['Genre'],
                'year' => $movieInfo['Year'],
                'runtime' => $movieInfo['Runtime'],
                'director' => $movieInfo['Director'],
                'writer' => $movieInfo['Writer'],
                'country' => $movieInfo['Country'],
                'language' => $movieInfo['Language'],
            ]);

            return redirect('/');
        }
        else {
            return redirect('/')->withErrors(['Film tidak ditemukan']);
        }

    }
    public function EditMovie(Request $request){
        $film = Movie::find($request->id);
        return view('edit', [
            'film' => $film
        ]);
    }
    public function updateMovie(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:movies,id',
        'movie_name' => 'required|string|max:255',
    ]);

    $movieId = $request->input('id');
    $movieName = $request->input('movie_name');
    $apiKey = env('OMDB_API_KEY');
    $response = Http::get("http://www.omdbapi.com/?t={$movieName}&apikey={$apiKey}");

    if ($response->successful() && $response['Response'] === 'True') {
        $movieInfo = $response->json();

        $film = Movie::find($movieId);
        if (!$film) {
            return redirect()->back()->withErrors(['Film tidak ditemukan']);
        }

        $film->update([
            'title' => $movieInfo['Title'],
            'plot' => $movieInfo['Plot'],
            'poster' => $movieInfo['Poster'],
            'genre' => $movieInfo['Genre'],
            'year' => $movieInfo['Year'],
            'runtime' => $movieInfo['Runtime'],
            'director' => $movieInfo['Director'],
            'writer' => $movieInfo['Writer'],
            'country' => $movieInfo['Country'],
            'language' => $movieInfo['Language'],
        ]);

        return redirect('/')->with('success', 'Film berhasil diperbarui');
    } else {
        return redirect('/')->withErrors(['Film tidak ditemukan']);
    }
}


    // public function deleteMovie(Request $request) {
    //     Movie::where('id', $request->id)-> delete();

    //     return redirect('/');
    // }

    // public function show($id)
    // {
    //     $film = Movie::find($id);

    //     if (!$film) {
    //         return redirect('/')->with('error', 'Movie not found');
    //     }

    //     return view('show', compact('film'));
    // }

    public function deleteMovie(Request $request) {
        Movie::where('id', $request->id)->delete();

        return redirect('/');
    }

    public function show($id)
    {
        $film = Movie::find($id);
        if (!$film) {
            return redirect('/')->with('error', 'Movie not found');
        }

        return view('show', compact('film'));
    }
}
