<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MovieController::class, 'index']);

Route::get(
    '/movie/{id}',
    [MovieController::class, 'movie']
);

Route::get(
    '/watch/{id}',
    [MovieController::class, 'watch']
);