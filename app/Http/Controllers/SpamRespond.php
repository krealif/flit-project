<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;
use Spatie\Honeypot\SpamResponder\SpamResponder;

class SpamRespond implements SpamResponder
{
    public function respond(Request $request, Closure $next)
    {
        return abort('403', 'Spam Detected');
    }
}
