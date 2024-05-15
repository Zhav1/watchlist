<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('home', ['movies' => $movies]);
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
}
