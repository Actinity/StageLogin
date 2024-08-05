<?php

return [
    'prefix' => env('STAGE_LOGIN_PREFIX','WY-'),
    'code' => env('STAGE_LOGIN_CODE', 'WY-STAGING'),
    'route' => env('STAGE_LOGIN_ROUTE','stage-login'),
    'title' => env('STAGE_LOGIN_TITLE','Authenticate'),
    'enabled' => env('REQUIRE_STAGE_LOGIN') || env('APP_ENV') === 'stage',


    /*
     * Set a host path if your app is served via a transparent
     * proxy and you need redirect URLs to include that.
     */

    'host_path' => env('STAGE_LOGIN_HOST_PATH',''),

];