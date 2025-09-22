<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/search',[\App\Http\Controllers\GoogleSearchController::class,'search'])->name('index.search');
