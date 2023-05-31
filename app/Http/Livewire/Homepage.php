<?php

namespace App\Http\Livewire;

use App\Services\TMDB\Enums\Images\BackdropSize;
use App\Services\TMDB\Enums\Images\PosterSize;
use App\Services\TMDB\TMDBClient;
use Livewire\Component;

class Homepage extends Component
{
    public $upcoming_movies = [];

    public function mount(TMDBClient $client)
    {
        $this->upcoming_movies = $client->upcoming([
            'append_to_response' => 'images',
        ])->results->map(function ($result) use ($client) {
            $result->backdrop_path = $client->getImageUrl(BackdropSize::w1280, $result->backdrop_path);
            $result->poster_path = $client->getImageUrl(PosterSize::w185, $result->poster_path);
            return $result;
        })->toArray();
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
