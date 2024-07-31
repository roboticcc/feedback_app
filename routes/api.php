<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Feedback\FeedbackController;
use App\Http\Middleware\CheckRole;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::middleware(CheckRole::class . ':manager')->group(function () {
        Route::get('feedbacks', [FeedbackController::class, 'index']);
        Route::get('feedbacks/{id}', [FeedbackController::class, 'show']);
    });

    Route::middleware(CheckRole::class . ':client')->group(function () {
        Route::post('feedbacks', [FeedbackController::class, 'store']);
    });
});
