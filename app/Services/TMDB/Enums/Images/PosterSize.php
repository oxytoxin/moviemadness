<?php

namespace App\Services\TMDB\Enums\Images;

enum PosterSize: string
{
    case w92 = "w92";
    case w154 = "w154";
    case w185 = "w185";
    case w342 = "w342";
    case w500 = "w500";
    case w780 = "w780";
    case original = "original";
}
