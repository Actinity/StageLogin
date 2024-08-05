<?php

return [
    'prefix' => env('STAGE_LOGIN_PREFIX','WY-'),
    'code' => env('STAGE_LOGIN_CODE', 'WY-STAGING'),
    'route' => env('STAGE_LOGIN_ROUTE','stage-login'),
    'title' => env('STAGE_LOGIN_TITLE','Authenticate'),
    'enabled' => env('APP_ENV','stage') || env('REQUIRE_STAGE_LOGIN'),
];