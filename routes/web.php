<?php

// use Illuminate\Support\Facades\Route;

// require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
