<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;

use function PHPSTORM_META\map;

class GithubWebhookController extends Controller
{
    public function pull()
    {
        info(__DIR__);
        Process::run('php artisan down');
    }
}
