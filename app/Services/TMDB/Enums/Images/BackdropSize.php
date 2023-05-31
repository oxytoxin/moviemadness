<?php

namespace App\Services\TMDB\Enums\Images;

enum BackdropSize: string
{
    case w300 = "w300";
    case w780 = "w780";
    case w1280 = "w1280";
    case original = "original";
}
