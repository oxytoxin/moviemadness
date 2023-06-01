<?php

namespace App\Services\TMDB\DTO;

use App\Services\TMDB\DTO\Casts\CarbonCast;
use Carbon\CarbonImmutable;
use DateTime;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithCastable;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class Movie extends Data
{
    public function __construct(
        public ?bool $adult,
        public ?string $backdrop_path,
        public ?array $belongs_to_collection,
        public ?int $budget,
        public ?array $genres,
        public ?array $keywords,
        public ?string $homepage,
        public int $id,
        public ?string $imdb_id,
        public string $original_language,
        public string $original_title,
        public string $overview,
        public float|int $popularity,
        public ?string $poster_path,
        public ?array $production_companies,
        public ?array $production_countries,
        #[WithCast(CarbonCast::class)]
        public CarbonImmutable $release_date,
        public ?int $revenue,
        public ?int $runtime,
        public ?array $spoken_languages,
        public ?string $status,
        public ?string $tagline,
        public string $title,
        public bool $video,
        public float|int $vote_average,
        public int $vote_count,
        public ?array $images,
        #[DataCollectionOf(YoutubeVideo::class)]
        public ?DataCollection $videos,
        public ?array $credits,
        public ?array $trailer,
        public ?array $reviews,
        public ?array $similar,
    ) {
    }
}
