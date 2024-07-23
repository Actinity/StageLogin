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
        $url = route(name: 'stage-login.start', absolute: false);

        if(
            app()->environment('stage') &&
            !$request->cookie('stage_login') &&
            $request->getPathInfo() !== $url
        ) {
            Cookie::queue('redirect_after_stage',$request->url());
            return redirect($url);
        }

        return $next($request);
    }

}