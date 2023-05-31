<?php

namespace App\Services\Concerns;

use Illuminate\Support\Facades\Http;

trait HasFake
{
    public static function fake(null|callable|array $callback = null): void
    {
        Http::fake($callback);
    }
}
