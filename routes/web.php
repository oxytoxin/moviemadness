<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Homepage;
use App\Http\Livewire\Movies\DiscoverMovies;
use App\Http\Livewire\Movies\MovieDetails;
use App\Http\Livewire\Movies\MoviesByType;
use App\Http\Livewire\Movies\SearchMovies;
use Illuminate\Support\Facades\Route;

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

Route::get('/', Homepage::class)->name('home');
Route::prefix('movies')->name('movies.')->group(function () {
    Route::get('search', SearchMovies::class)->name('search');
    Route::get('discover', DiscoverMovies::class)->name('discover');
    Route::get('type/{type}', MoviesByType::class)->name('by-type');
    Route::get('{movie_id}', MovieDetails::class)->name('details')->where('movie_id', '[0-9]+');
});


Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});
