<?php

use App\Http\Controllers\ResultatController;
use Illuminate\Support\Facades\Route;

Route::controller(ResultatController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/vote', 'vote')->name('vote');
    Route::get('/resultats', 'resultats')->name('resultats');
});