<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;

use function PHPSTORM_META\map;

class GithubWebhookController extends Controller
{
    public function pull()
    {
        info('down');
        Process::path(base_path())->run('php artisan down');
        info('pulling');
        Process::path(base_path())->run('git pull');
        info('pnpm i');
        Process::path(base_path())->run('pnp install');
        info('build');
        Process::path(base_path())->run('pnpm run build');
        info('composer i');
        Process::path(base_path())->run('composer install --no-dev --no-interaction --optimize-autoloader');
        info('up');
        Process::path(base_path())->run('php artisan up');
    }
}
