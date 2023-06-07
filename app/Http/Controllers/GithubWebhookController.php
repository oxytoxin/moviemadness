<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class GithubWebhookController extends Controller
{
    public function pull()
    {
        exec('php artisan down');
        try {
            exec('git pull');
            exec('pnpm install');
            exec('pnpm build');
            exec('composer install --no-dev --optimize-autoloader --no-interaction');
            exec('php artisan up');
            return response('Pull from repository successful.', 200);
        } catch (\Throwable $th) {
            info('Unable to pull from repository.');
            abort(500);
        }
        exec('php artisan up');
    }
}
