<?php

use Illuminate\Support\Facades\Route;

Route::post('/', TaskStoreController::class);

Route::patch('/close/{id}', TaskCloseController::class);
