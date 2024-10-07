<?php

namespace Actinity\StageLogin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class StageLoginMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $enabled = config('stage-login') ? config('stage-login.enabled') : app()->environment('stage');

        if(
            $enabled &&
            (
                !$request->cookie('stage_login') ||
                $request->cookie('stage_login') !== config('stage_login.code')
            )
        ) {
            return response()->view('stage-login::index');
        }

        return $next($request);
    }

}