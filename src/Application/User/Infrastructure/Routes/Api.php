<?php

use Illuminate\Support\Facades\Route;

Route::get('/', UserIndexController::class);
Route::get('/{id}', UserShowController::class);
Route::delete('/{id}', UserDestroyController::class);
