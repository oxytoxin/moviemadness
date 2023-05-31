<?php

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

Route::get('/', function () {
    $response = Http::acceptJson()->get('https://api.themoviedb.org/3/movie/latest', [
        'api_key' => '147227c8a08db71af336e5c33ac616bd',
    ]);
    dd($response->json());
    return Inertia::render('Welcome', [
        'user' => 'Mark'
    ]);
});

Route::inertia('/about', 'About', [
    'user' => 'John'
]);
