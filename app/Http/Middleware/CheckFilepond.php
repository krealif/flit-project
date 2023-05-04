<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CheckFilepond
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('upload-length')) {
            $uploadlength = $request->header()['upload-length'];
            $filesize = (int) $uploadlength[0];
            $limitsize = 10000000;
            if ($filesize >= $limitsize) {
                return Response::json(['filepond' => 'File is too large'], 422);
            }
        }

        return $next($request);
    }
}
