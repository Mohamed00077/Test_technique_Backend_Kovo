<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/api/documentation');
});

Route::get('/login', function () {
    return response()->json(['message' => 'Unauthenticated.'], 401);
})->name('login');
