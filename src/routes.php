<?php

use Illuminate\Support\Facades\Route;
use Actinity\StageLogin\StageLoginController;

Route::prefix(config('stage-login.route'))
    ->middleware([
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
    ])
    ->group(function() {
    Route::get('',[StageLoginController::class,'index'])
        ->name('stage-login.start');

    Route::middleware('throttle:stage-login')
        ->post('',[StageLoginController::class,'verify'])
        ->name('stage-login.verify');
});