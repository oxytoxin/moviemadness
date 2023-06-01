<?php

namespace App\Services\TMDB\DTO;

use Spatie\LaravelData\Data;

class Genre extends Data
{
    public function __construct(
        public int $id,
        public string $name,
    ) {
    }
}
