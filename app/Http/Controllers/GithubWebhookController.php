<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class GithubWebhookController extends Controller
{
    public function pull()
    {
        try {
            exec('git pull');

            return response('Pull from repository successful.', 200);
        } catch (\Throwable $th) {
            info('Unable to pull from repository.');
            abort(500);
        }
    }
}
