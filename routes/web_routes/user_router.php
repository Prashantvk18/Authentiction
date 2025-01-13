<?php
use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;


Route::get('/home' , [AuthenticationController::class , 'home'])->name('home');