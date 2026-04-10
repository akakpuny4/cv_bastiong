<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KuitansiController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/kuitansi/{id}/cetak', [KuitansiController::class, 'cetakPdf'])->name('kuitansi.cetak');