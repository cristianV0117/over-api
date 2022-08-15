<?php

use Illuminate\Support\Facades\Route;
use Src\Application\Home\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$appVersion = env("APP_VERSION");
Route::get('/', static function () use ($appVersion) {
    return redirect('api/' . $appVersion);
});

Route::get('/' . $appVersion, HomeController::class);

Route::post($appVersion . '/users', \Src\Application\User\Infrastructure\Controllers\UserStoreController::class);
