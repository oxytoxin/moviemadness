<?php

namespace App\Services\TMDB;

use App\Services\TMDB\DTO\MovieCollection;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use PDO;

trait FetchesMovies
{
    public function discover_movies(array $query = [])
    {
        $query = array_merge($query, [
            'api_key' => $this->apiKey,
        ]);

        return Cache::remember('discover', 3600, function () use ($query) {
            $response = Http::tmdb()
                ->get("/discover/movie", $query);
            if (!$response->successful()) {
                return $response->toException();
            }
            return MovieCollection::from($response->json());
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
        $response = Http::tmdb()
            ->get("/movie/{$id}", [
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

        $response =  Http::tmdb()
            ->get("/movie/{$type}", $query);

        if (!$response->successful()) {
            return $response->toException();
        }

        return MovieCollection::from($response->json());
    }

    public function getAllMovies()
    {
        return Cache::remember('all-movies', 3600, function () {
            $responses = Http::pool(function (Pool $pool) {
                return [
                    $pool->as('popular')->baseUrl($this->baseUrl)->acceptJson()->get("/movie/popular", [
                        'api_key' => $this->apiKey
                    ]),
                    $pool->as('upcoming')->baseUrl($this->baseUrl)->acceptJson()->get("/movie/upcoming", [
                        'api_key' => $this->apiKey
                    ]),
                    $pool->as('now_playing')->baseUrl($this->baseUrl)->acceptJson()->get("/movie/now_playing", [
                        'api_key' => $this->apiKey
                    ]),
                    $pool->as('top_rated')->baseUrl($this->baseUrl)->acceptJson()->get("/movie/top_rated", [
                        'api_key' => $this->apiKey
                    ]),
                ];
            });

            $data = [];

            foreach ($responses as $key => $response) {
                if (!$response->ok()) {
                    $response->toException();
                }
                $data[$key] = MovieCollection::from($response->json());
            }

            return $data;
        });
    }
}
