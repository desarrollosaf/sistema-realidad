<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ARController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/ar/{idioma}', [ARController::class, 'murales'])->name('ar.murales');
Route::get('/marcador', [ARController::class, 'muralesQR'])->name('ar.qr');
Route::get('/video/{idioma}', [ARController::class, 'muralesVD'])->name('ar.video');
Route::get('/ra', [ARController::class, 'muralesRA'])->name('ar.ra');