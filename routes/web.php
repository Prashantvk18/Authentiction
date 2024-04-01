<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Middleware\Checkedloggedin;

Route::controller(AuthenticationController::class)->group(function(){
    Route::get('/','login')->name('login');
    Route::get('/register','register')->name('register');
    Route::post('/register','save_register')->name('save_register');
    Route::post('/','login_user')->name('login_user');
});


Route::get('/welcome' , function(){
    return view('welcome');
})->middleware(['checkedloggedin']);

Route::get('/logout',[AuthenticationController::class,'logout'])->name('logout');