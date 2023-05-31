<?php

namespace App\Services\TMDB;

use App\Services\Concerns\HasFake;

class TMDBClient
{
    use HasFake, FetchesMovies;


    public function __construct(protected string $baseUrl, protected string $apiKey)
    {
    }
}
