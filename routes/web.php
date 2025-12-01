<?php

use App\Http\Controllers\KomoditasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('komoditas', KomoditasController::class);
