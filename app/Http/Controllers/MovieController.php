<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Watchlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index()
    {
        $watchlists = Watchlist::where('user_id', Auth::id())->with('movie')->get();
        $movies = $watchlists->map(function ($watchlist) {
            return $watchlist->movie;
        });
        return view('main.home', ['films' => $movies]);
    }

    public function search(Request $request)
    {
        $request->validate([
            'movie_name' => 'required|string|max:255',
        ]);

        $movieName = $request->input('movie_name');
        $apiKey = env('OMDB_API_KEY');
        $response = Http::get("http://www.omdbapi.com/?s={$movieName}&apikey={$apiKey}");

        if ($response->successful() && isset($response['Search'])) {
            $movies = $response->json()['Search'];
            return view('result', ['movies' => $movies, 'search' => $movieName]);
        } else {
            return redirect()->back()->withErrors(['Film tidak ditemukan']);
        }
    }

    public function create(Request $request)
    {
        $imdbID = $request->input('imdbID');
        $movie = Movie::where('imdbID', $imdbID)->first();
        if ($movie) {
            Watchlist::firstOrCreate([
                'user_id' => Auth::id(),
                'movie_id' => $movie->id,
            ]);
            return redirect('/')->with('success', 'Film sudah ada di watchlist Anda');
        }
        else {
            $apiKey = env('OMDB_API_KEY');
            $response = Http::get("http://www.omdbapi.com/?i={$imdbID}&apikey={$apiKey}");

            if ($response->successful() && $response['Response'] === 'True') {
                $movieInfo = $response->json();

                // Create a new movie entry in the database
                $movie = Movie::create([
                    'imdbID' => $movieInfo['imdbID'],
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

                // Add the movie to the user's watchlist
                Watchlist::create([
                    'user_id' => Auth::id(),
                    'movie_id' => $movie->id,
                ]);

                return redirect('/')->with('success', 'Film berhasil ditambahkan ke watchlist');
            } else {
                return redirect('/')->withErrors(['Film tidak ditemukan']);
            }
        }
    }

    public function editMovie(Request $request)
    {
        $film = Movie::find($request->id);
        return view('edit', ['film' => $film]);
    }

    public function updateMovie(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:movies,id',
            'title' => 'required|string|max:255',
            'language' => 'required|string|max:255',
            'year' => 'required|string|max:4',
            'runtime' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'plot' => 'required|string',
        ]);

        $film = Movie::find($request->id);
        if (!$film) {
            return redirect()->back()->withErrors(['Film tidak ditemukan']);
        }

        $film->update([
            'title' => $request->title,
            'language' => $request->language,
            'year' => $request->year,
            'runtime' => $request->runtime,
            'director' => $request->director,
            'writer' => $request->writer,
            'country' => $request->country,
            'genre' => $request->genre,
            'plot' => $request->plot,
        ]);

        return view('show', compact('film'));
    }
    public function deleteMovie(Request $request)
    {
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
