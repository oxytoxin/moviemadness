<?php

namespace App\Http\Livewire;

use App\Services\TMDB\Enums\Images\BackdropSize;
use App\Services\TMDB\Enums\Images\PosterSize;
use App\Services\TMDB\TMDBClient;
use Livewire\Component;

class Homepage extends Component
{
    public $discover_movies = [];
    public $movies = [];

    public function mount(TMDBClient $client)
    {
        $this->discover_movies = $client->discover_movies()->results->map(function ($result) use ($client) {
            $result->backdrop_path = $client->getImageUrl(BackdropSize::w1280, $result->backdrop_path);
            $result->poster_path = $client->getImageUrl(PosterSize::w185, $result->poster_path);
            return $result;
        })->toArray();
        ['popular' => $this->movies['popular'], 'upcoming' => $this->movies['upcoming'], 'now_playing' => $this->movies['now_playing'], 'top_rated' => $this->movies['top_rated']] = $client->getAllMovies();
        foreach ($this->movies as $key => $movie) {
            $this->movies[$key] = $movie->results->map(function ($result) use ($client) {
                $result->backdrop_path = $client->getImageUrl(BackdropSize::w1280, $result->backdrop_path);
                $result->poster_path = $client->getImageUrl(PosterSize::w185, $result->poster_path);
                return $result;
            })->toArray();
        }
    }

    public function render()
    {
        return view('livewire.homepage');
    }

    public function formatRunTime($minutes)
    {
        $hours = floor($minutes / 60);
        $mins = $minutes % 60;

        $hoursString = str_pad($hours, 2, '0', STR_PAD_LEFT);
        $minsString = str_pad($mins, 2, '0', STR_PAD_LEFT);

        return $hoursString . 'h' . $minsString . 'm';
    }
}
