<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Process;

use function PHPSTORM_META\map;

class GithubWebhookController extends Controller
{
    public function pull()
    {
        // test
        info('down');
        $p = Process::path(base_path())->run('php artisan down');
        info($p->output());
        info('pulling');
        $p = Process::path(base_path())->run('git pull');
        info($p->output());
        info('pnpm i');
        $p = Process::path(base_path())->run('pnp install');
        info($p->output());
        info('build');
        $p = Process::path(base_path())->run('pnpm run build');
        info($p->output());
        info('composer i');
        $p = Process::path(base_path())->run('composer install --no-dev --no-interaction --optimize-autoloader');
        info($p->output());
        info('up');
        $p = Process::path(base_path())->run('php artisan up');
    }
}
