<?php

namespace App\Services\TMDB\DTO;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class MovieCollection extends Data
{
    public function __construct(
        public int $page,
        #[DataCollectionOf(Movie::class)]
        public DataCollection $results,
        public int $total_pages,
        public int $total_results,
        public ?DateRange $dates
    ) {
    }
}
