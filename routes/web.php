<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ARController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/ar/{idioma}', [ARController::class, 'murales'])->name('ar.murales');
Route::get('/ar/qr', [ARController::class, 'muralesQR'])->name('ar.qr');