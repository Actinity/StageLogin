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

        $enabled = config('stage-login') ? config('stage-login.enabled') : app()->environment('stage');

        if(
            $enabled &&
            !$request->cookie('stage_login') &&
            $request->getPathInfo() !== $url
        ) {
            Cookie::queue('redirect_after_stage',$request->path());

            return redirect(config('stage-login.host_path','').$url);
        }

        return $next($request);
    }

}