<?php

namespace Actinity\StageLogin;

use Closure;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class StageLoginController
{
    use ValidatesRequests;

    public function index()
    {
        return view('stage-login::index');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'code' => [
                'required',
                'string',
                function(string $attribute, mixed $value, Closure $fail) {
                    if(strtoupper($value) !== config('stage-login.code')) {
                        $fail("Sorry, that code was not recognised");
                    }
                }
            ]
        ]);

        $url = $request->cookie('redirect_after_stage') ?: '/';

        Cookie::queue(cookie()->forget('redirect_after_stage'));
        Cookie::queue(cookie()->forever('stage_login',1));

        return redirect($url);
    }
}