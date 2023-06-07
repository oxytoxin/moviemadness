<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;

use function PHPSTORM_META\map;

class GithubWebhookController extends Controller
{
    public function pull()
    {
        //test
        Process::path(base_path())->run('php artisan down');
        Process::path(base_path())->run('git pull');
        Process::path(base_path())->run('pnp install');
        Process::path(base_path())->run('pnpm run build');
        Process::path(base_path())->run('composer install --no-dev --no-interaction --optimize-autoloader');
        Process::path(base_path())->run('php artisan up');
    }
}
