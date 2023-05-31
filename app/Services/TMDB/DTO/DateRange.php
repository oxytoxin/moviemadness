<?php

namespace App\Services\TMDB\DTO;

use App\Services\TMDB\DTO\Casts\CarbonCast;
use Carbon\CarbonImmutable;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

class DateRange extends Data
{
    public function __construct(
        #[WithCast(CarbonCast::class)]
        public CarbonImmutable  $maximum,
        #[WithCast(CarbonCast::class)]
        public CarbonImmutable $minimum
    ) {
    }
}
