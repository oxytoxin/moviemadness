<?php

namespace App\Services\TMDB\DTO\Casts;

use Carbon\CarbonImmutable;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Support\DataProperty;

class CarbonCast implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $context): mixed
    {
        try {
            return CarbonImmutable::create($value);
        } catch (\Throwable $th) {
            return Uncastable::create();
        }
    }
}
