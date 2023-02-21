<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::post('/', ForgotUserForgotPasswordController::class);

Route::put('/reset-password', ForgotUserResetPasswordController::class);
