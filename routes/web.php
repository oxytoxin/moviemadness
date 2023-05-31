<?php

use App\Http\Livewire\Homepage;
use App\Services\TMDB\DTO\Movie;
use App\Services\TMDB\DTO\MovieCollection;
use App\Services\TMDB\Enums\Images\BackdropSize;
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

Route::get('/', Homepage::class);
