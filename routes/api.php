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

Route::get($appVersion . '/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

Route::get($appVersion . '/mercado-pago', function () {
    MercadoPago\SDK::setAccessToken('TEST-8684101127692985-030220-d8770bea427647a0535183302a4c3c27-555279991');
    $preference = new MercadoPago\Preference();
    $item = new MercadoPago\Item();
    $item->title = 'Mi producto';
    $item->quantity = 1;
    $item->unit_price = 75;
    $preference->items = array($item);
    $preference->save();
    return response()->json($preference->id);
});
