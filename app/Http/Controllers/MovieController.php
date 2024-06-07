<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;
use App\Models\Watchlist;
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

    public function create(Request $request)
    {
        $request->validate([
            'movie_name' => 'required|string|max:255',
        ]);

        $movieName = $request->input('movie_name');
        $movie = Movie::where('title', $movieName)->first();

        if ($movie) {
            Watchlist::firstOrCreate([
                'user_id' => Auth::id(),
                'movie_id' => $movie->id,
            ]);
            return redirect('/')->with('success', 'Film sudah ada di watchlist Anda');
        } else {
            $apiKey = env('OMDB_API_KEY');
            $response = Http::get("http://www.omdbapi.com/?t={$movieName}&apikey={$apiKey}");

            if ($response->successful() && $response['Response'] === 'True') {
                $movieInfo = $response->json();

                $movie = Movie::create([
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

    public function editMovie($id)
    {
        $film = Movie::find($id);
        if (!$film) {
            return redirect('/')->withErrors(['Film tidak ditemukan']);
        }

        return view('edit', ['film' => $film]);
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

    public function deleteMovie(Request $request, $id)
    {
        $film = Movie::find($id);
        if (!$film) {
            return redirect('/')->withErrors(['Film tidak ditemukan']);
        }

        $film->delete();
        return redirect('/')->with('success', 'Film berhasil dihapus');
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
