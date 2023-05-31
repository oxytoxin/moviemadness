<?php

use App\Services\TMDB\TMDBClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (TMDBClient $client) {
    dd($client->upcoming());
    return Inertia::render('Welcome', [
        'user' => 'Mark'
    ]);
});

Route::inertia('/about', 'About', [
    'user' => 'John'
]);
