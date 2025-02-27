<?php

use App\Http\Controllers\ResultatController;
use Illuminate\Support\Facades\Route;

Route::controller(ResultatController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/resultats', 'resultats')->name('resultats');
    Route::get('/store', 'getStore');
    Route::post('/store', 'store')->name('store');
    
});