<?php

namespace App\Services\TMDB;

use App\Services\Concerns\HasFake;
use App\Services\TMDB\DTO\Genre;
use App\Services\TMDB\Enums\Images\BackdropSize;
use App\Services\TMDB\Enums\Images\LogoSize;
use App\Services\TMDB\Enums\Images\PosterSize;
use App\Services\TMDB\Enums\Images\ProfileSize;
use App\Services\TMDB\Enums\Images\StillSize;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class TMDBClient
{
    use HasFake, FetchesMovies;


    public function __construct(protected string $baseUrl, protected string $imageBaseUrl, protected string $apiKey)
    {
    }

    public static function getImageUrl(BackdropSize|LogoSize|PosterSize|ProfileSize|StillSize $size, $path): string
    {
        return config('tmdb.image_base_url') . "{$size->value}{$path}";
    }

    public static function getYoutubeVideoThumbnail($key): string
    {
        return "https://img.youtube.com/vi/$key/hqdefault.jpg";
    }

    public function getGenres()
    {
        return Cache::remember('genres', 3600, function () {
            $response = Http::tmdb()->get("/genre/movie/list", [
                'api_key' => $this->apiKey
            ]);

            if (!$response->successful()) {
                return $response->toException();
            }

            return Genre::collection($response->json()['genres']);
        });
    }
}
