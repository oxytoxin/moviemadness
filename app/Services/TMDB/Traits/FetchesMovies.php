<?php

namespace App\Services\TMDB\Traits;

use App\Services\TMDB\DTO\Movie;
use App\Services\TMDB\DTO\MovieCollection;
use App\Services\TMDB\TMDBClient;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

trait FetchesMovies
{
    public function search_movies(array $query = [])
    {
        $query = array_merge($query, [
            'api_key' => $this->apiKey,
        ]);

        $response = Http::tmdb()
            ->get("/search/movie", $query);

        if (!$response->successful()) {
            return $response->toException();
        }

        $data = $response->json();

        return MovieCollection::from($data);
    }


    public function discover_movies(array $query = [], $key = null)
    {
        $query = array_merge($query, [
            'api_key' => $this->apiKey,
        ]);

        $key ??= now()->timestamp;

        return Cache::remember($key, 3600, function () use ($query) {
            $response = Http::tmdb()
                ->get("/discover/movie", $query);
            if (!$response->successful()) {
                return $response->toException();
            }
            $data = $response->json();
            $videos = collect($data['results']);
            $responses = Http::pool(function (Pool $pool) use ($videos) {
                $pools = [];
                foreach ($videos as $key => $video) {
                    $pools[] = $pool->baseUrl($this->baseUrl)->acceptJson()->get("/movie/{$video['id']}", [
                        'api_key' => $this->apiKey,
                        'append_to_response' => 'videos'
                    ]);
                }
                return $pools;
            });
            foreach ($data['results'] as $key => $result) {
                $data['results'][$key]['videos'] = collect($responses[$key]->json()['videos']['results'])->filter(fn ($v) => $v['site'] == 'YouTube' && $v['official'])->toArray();
                $data['results'][$key]['trailer'] = collect($responses[$key]->json()['videos']['results'])->where('site', 'YouTube')->where('type', 'Trailer')->where('official', true)->first();
            }
            return MovieCollection::from($data);
        });
    }

    public function getMovie(int $id, array $query = [])
    {
        return Cache::remember("movie-$id", 3600, function () use ($id, $query) {
            $query = array_merge($query, [
                'api_key' => $this->apiKey,
            ]);
            $response = Http::tmdb()
                ->get("/movie/{$id}", $query);

            abort_if($response->status() == Response::HTTP_NOT_FOUND, Response::HTTP_NOT_FOUND);

            if (!$response->successful()) {
                return $response->toException();
            }

            $data = $response->json();
            $data['videos'] = collect($data['videos']['results'])
                ->filter(fn ($v) => $v['site'] == 'YouTube' && $v['official'])
                ->map(function ($v) {
                    $v['thumbnail'] = TMDBClient::getYoutubeVideoThumbnail($v['key']);
                    return $v;
                })
                ->toArray();
            $data['similar'] = $data['similar']['results'];
            return Movie::from($data);
        });
    }

    public function getMovies(string $type, array $query)
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
