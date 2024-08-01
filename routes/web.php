<?php

use Illuminate\Support\Facades\Route;

Route::get('/{catch?}', function () {
    return view('app');
})->where('catch', '^(?!api).*$');
