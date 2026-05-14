<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index()
    {
        $response = Http::get(
            'https://api.themoviedb.org/3/trending/movie/week',
            [
                'api_key' => env('TMDB_API_KEY')
            ]
        );

        $movies = $response->json()['results'];

        $hero = $movies[0];

        return view('home', compact('movies', 'hero'));
    }
}