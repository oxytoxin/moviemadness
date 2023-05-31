<?php

namespace App\Services\TMDB;

use Illuminate\Support\Facades\Http;

trait FetchesMovies
{
    public function discoverMovies(array $query): array
    {
        $query = array_merge($query, [
            'api_key' => $this->apiKey,
        ]);

        return Http::acceptJson()
            ->get("{$this->baseUrl}/discover/movie", $query)
            ->json();
    }

    public function popular(array $query = [])
    {
        return $this->getMovies('popular', $query);
    }

    public function upcoming(array $query = [])
    {
        return $this->getMovies('upcoming', $query);
    }

    public function now_playing(array $query = [])
    {
        return $this->getMovies('now_playing', $query);
    }

    public function top_rated(array $query = [])
    {
        return $this->getMovies('top_rated', $query);
    }

    private function getMovies(string $type, array $query): array
    {
        $query = array_merge($query, [
            'api_key' => $this->apiKey,
        ]);

        return Http::acceptJson()
            ->get("{$this->baseUrl}/movie/{$type}", $query)
            ->json();
    }
}
