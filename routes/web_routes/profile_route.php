<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

    Route::controller(ProfileController::class)->group(function(){
        Route::get('profile_view' , 'profile_view')->name('profile_view');
        Route::post('profile_save' , 'profile_save')->name('profile_save');
        Route::post('change_pwd' , 'change_pwd')->name('change_pwd');
 
    });
