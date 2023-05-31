<?php

namespace App\Services\TMDB;

use App\Services\TMDB\DTO\MovieCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use PDO;

trait FetchesMovies
{
    public function discoverMovies(array $query): array
    {

        $query = array_merge($query, [
            'api_key' => $this->apiKey,
        ]);

        return Cache::remember('discover', 3600, function () use ($query) {
            return Http::acceptJson()
                ->get("{$this->baseUrl}/discover/movie", $query)
                ->json();
        });
    }

    public function popular(array $query = [])
    {

        return Cache::remember('popular', 3600, function () use ($query) {
            return $this->getMovies('popular', $query);
        });
    }

    public function upcoming(array $query = [])
    {
        return Cache::remember('upcoming', 3600, function () use ($query) {
            return $this->getMovies('upcoming', $query);
        });
    }

    public function now_playing(array $query = [])
    {
        return Cache::remember('now_playing', 3600, function () use ($query) {
            return $this->getMovies('now_playing', $query);
        });
    }

    public function top_rated(array $query = [])
    {
        return Cache::remember('top_rated', 3600, function () use ($query) {
            return $this->getMovies('top_rated', $query);
        });
    }

    public function getMovie(int $id, array $query = []): array
    {

        $query = array_merge($query, [
            'api_key' => $this->apiKey,
        ]);
        $response = Http::acceptJson()
            ->get("{$this->baseUrl}/movie/{$id}", [
                'api_key' => $this->apiKey,
            ]);

        if (!$response->successful()) {
            return $response->toException();
        }

        return $response->json();
    }

    private function getMovies(string $type, array $query)
    {
        $query = array_merge($query, [
            'api_key' => $this->apiKey,
        ]);

        $response =  Http::acceptJson()
            ->get("{$this->baseUrl}/movie/{$type}", $query);

        if (!$response->successful()) {
            return $response->toException();
        }

        return MovieCollection::from($response->json());
    }
}
