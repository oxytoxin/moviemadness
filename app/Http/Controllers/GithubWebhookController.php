<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class GithubWebhookController extends Controller
{
    public function pull()
    {
        // testsss
        exec('php artisan down');
    }
}
