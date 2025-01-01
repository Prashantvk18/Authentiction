<?php
use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

    Route::get('/','login')->name('login');
    Route::get('/register','register')->name('register');
    Route::post('/register','save_register')->name('save_register');
    Route::post('/','login_user')->name('login_user');