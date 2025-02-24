<?php

namespace App\Oxytoxin;

use App\Models\WatchlistItem;
use App\Services\TMDB\Enums\Images\PosterSize;
use App\Services\TMDB\TMDBClient;
use Filament\Notifications\Notification;

trait ManagesMovieWatchlist
{

    public function addToWatchlist($movie_id, TMDBClient $client)
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }
        $movie = $client->getMovie($movie_id);
        WatchlistItem::query()->firstOrCreate([
            'user_id' => auth()->id(),
            'movie_id' => $movie->id
        ], [
            'other_details' => [
                'movie_poster_path' => $client->getImageUrl(PosterSize::w185, $movie->poster_path),
                'movie_title' => $movie->title,
                'movie_overview' => $movie->overview,
            ]
        ]);
        $this->dispatch('watchlisted', movie_id: $movie_id);
        Notification::make()->title('Movie added to watchlist!')->success()->send();
        $this->skipRender();
    }
}
