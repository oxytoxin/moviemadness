<?php

namespace App\Services\TMDB;

use App\Services\Concerns\HasFake;
use App\Services\TMDB\Enums\Images\BackdropSize;
use App\Services\TMDB\Enums\Images\LogoSize;
use App\Services\TMDB\Enums\Images\PosterSize;
use App\Services\TMDB\Enums\Images\ProfileSize;
use App\Services\TMDB\Enums\Images\StillSize;

class TMDBClient
{
    use HasFake, FetchesMovies;


    public function __construct(protected string $baseUrl, protected string $imageBaseUrl, protected string $apiKey)
    {
    }

    public function getImageUrl(BackdropSize|LogoSize|PosterSize|ProfileSize|StillSize $size, $path): string
    {
        return "{$this->imageBaseUrl}/{$size->value}{$path}";
    }
}
