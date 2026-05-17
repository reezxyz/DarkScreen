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
    public function movie($id)
    {
        $response = Http::get(
            "https://api.themoviedb.org/3/movie/$id",
            [
                'api_key' => env('TMDB_API_KEY'),
                'append_to_response' =>
                    'videos,images,credits'
            ]
        );

        $movie = $response->json();

        // Trailer
        $trailer = collect(
            $movie['videos']['results'] ?? []
        )
        ->where('site', 'YouTube')
        ->firstWhere('type', 'Trailer');

        // Logo PNG (prioritas English)
        $logos = collect(
            $movie['images']['logos'] ?? []
        );

        $logo =
            $logos->firstWhere(
                'iso_639_1',
                'en'
            )
            ??
            $logos->firstWhere(
                'iso_639_1',
                null
            )
            ??
            $logos->first();

        // Runtime format
        $runtime = $movie['runtime'] ?? 0;

        $hours = floor($runtime / 60);
        $minutes = $runtime % 60;

        $formattedRuntime =
            $hours . 'h ' .
            $minutes . 'm';

        

        $actors = collect(
            $movie['credits']['cast'] ?? []
        )->take(12);

        return view(
            'movie',
            compact(
                'movie',
                'trailer',
                'logo',
                'formattedRuntime',
                'actors'
            )
        );

    }

    public function watch($id)
{
    return view(
        'watch',
        compact('id')
    );
}
}