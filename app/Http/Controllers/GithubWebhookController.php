<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;

use function PHPSTORM_META\map;

class GithubWebhookController extends Controller
{
    public function pull()
    {
        $process = Process::path('/var/www/moviemadness')->run('php artisan down');
        info($process->output()); //test
    }
}
