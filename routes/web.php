<?php

use Illuminate\Support\Facades\Route;

Route::resource('/produks', \App\Http\Controllers\ProdukController::class);

Route::resource('/', \App\Http\Controllers\HomeController::class);