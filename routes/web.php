<?php

use App\Http\Controllers\KomoditasController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('komoditas', KomoditasController::class);
Route::resource('transaksi', TransaksiController::class);
