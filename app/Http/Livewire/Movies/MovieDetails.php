<?php

namespace App\Http\Livewire\Movies;

use App\Services\TMDB\Enums\Images\BackdropSize;
use App\Services\TMDB\Enums\Images\PosterSize;
use App\Services\TMDB\Enums\Images\ProfileSize;
use App\Services\TMDB\TMDBClient;
use Livewire\Component;

class MovieDetails extends Component
{
    public $movie = [];

    public function mount($movie_id, TMDBClient $client)
    {
        $this->movie = $client->getMovie($movie_id, [
            'append_to_response' => 'images,videos,credits,reviews,keywords,similar'
        ])->toArray();
        $this->movie['videos'] = collect($this->movie['videos'])
            ->groupBy('type')
            ->sortKeysDesc()
            ->toArray();
        $this->movie['backdrop_path'] = TMDBClient::getImageUrl(BackdropSize::w1280, $this->movie['backdrop_path']);
        $this->movie['poster_path'] = TMDBClient::getImageUrl(PosterSize::w185, $this->movie['poster_path']);
        $this->movie['credits']['cast'] = collect($this->movie['credits']['cast'])->take(10)
            ->map(function ($c) {
                $c['profile_path'] = TMDBClient::getImageUrl(ProfileSize::w185, $c['profile_path']);
                return $c;
            });
        $this->movie['credits']['crew'] = collect($this->movie['credits']['crew'])
            ->filter(fn ($c) => in_array($c['job'], ['Writer', 'Director']))
            ->map(function ($c) {
                $c['profile_path'] = TMDBClient::getImageUrl(ProfileSize::w185, $c['profile_path']);
                return $c;
            });
        $this->movie['similar']['results'] = collect($this->movie['similar']['results'])->map(function ($m) {
            $m['backdrop_path'] = TMDBClient::getImageUrl(BackdropSize::w1280, $m['backdrop_path']);
            $m['poster_path'] = TMDBClient::getImageUrl(PosterSize::w185, $m['poster_path']);
            return $m;
        })->toArray();
    }

    public function render()
    {
        return view('livewire.movies.movie-details');
    }
}
