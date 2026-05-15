<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->get('lang', 'en-US');

        // Trending Movies
        $trendingResponse = Http::get(
            'https://api.themoviedb.org/3/trending/movie/week',
            [
                'api_key' => env('TMDB_API_KEY'),
                'language' => $lang
            ]
        );

        $movies = $trendingResponse->json()['results'];

        // Thriller Picks
        $thrillerResponse = Http::get(
            'https://api.themoviedb.org/3/discover/movie',
            [
                'api_key' => env('TMDB_API_KEY'),
                'language' => $lang,
                'with_genres' => 53,
                'sort_by' => 'popularity.desc'
            ]
        );

        $thrillerMovies =
            $thrillerResponse->json()['results'];

        $hero = $movies[0];

        return view(
            'home',
            compact(
                'movies',
                'hero',
                'lang',
                'thrillerMovies'
            )
        );
    }
}