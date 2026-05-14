<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [MovieController::class, 'index']);
Route::get('/movie/{id}', [MovieController::class, 'show']);
