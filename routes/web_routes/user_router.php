<?php
use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::get('/home' , function(){
    return view('User.home');
});