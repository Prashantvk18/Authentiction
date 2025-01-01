<?php
use App\Http\Controllers\ExpanseController;
use Illuminate\Support\Facades\Route;

    Route::controller(ExpanseController::class)->group(function(){
        Route::get('expanse' , 'expanse')->name('expanse');
        Route::get('/trip_model' , 'trip_model')->name('trip_model');
        Route::get('/expanse_model' , 'expanse_model')->name('expanse_model');
        Route::get('/user_model' , 'user_model')->name('user_model');
        Route::get('/user_contro_model' , 'user_contro_model')->name('user_contro_model');
        Route::get('/user_split_model' , 'user_split_model')->name('user_split_model');
        Route::get('/expanse_{id}_{created_by}' , 'expanse_view')->name('expanse_view');
        Route::get('/user_{id}_{created_by}' , 'user_view')->name('user_view');
        Route::post('/trip_save' , 'trip_save')->name('trip_save');
        Route::post('/trip_delete' , 'trip_delete')->name('trip_delete');
        Route::post('/expanse_save' , 'expanse_save')->name('expanse_save');
        Route::post('/user_save' , 'user_save')->name('user_save');
        Route::post('/user_contro_save' , 'user_contro_save')->name('user_contro_save');
        Route::post('/user_split_save' , 'user_split_save')->name('user_split_save');
        Route::post('/user_contro_delete' , 'user_contro_delete')->name('user_contro_delete');
        Route::post('/calculate_contro' , 'calculate_contro')->name('calculate_contro');
    });