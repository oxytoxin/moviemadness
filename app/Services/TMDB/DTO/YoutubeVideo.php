<?php

namespace App\Services\TMDB\DTO;

use Spatie\LaravelData\Data;

class YoutubeVideo extends Data
{
    public function __construct(
        public string $id,
        public string $name,
        public string $key,
        public string $site,
        public string $type,
        public bool $official,
        public ?string $thumbnail,
    ) {
    }
}
