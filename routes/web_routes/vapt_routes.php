<?php
use App\Http\Controllers\VAPTController;
use Illuminate\Support\Facades\Route;

Route::controller(VAPTController::class)->group(function(){
    Route::get('/vapt_index' , 'vapt_index')->name('vapt_index');
    Route::get('/vapt_model' , 'vapt_model')->name('vapt_model');
    Route::post('/vapt_save' , 'vapt_save')->name('vapt_save');
    Route::get('/exportpdf' , 'exportpdf')->name('exportpdf');
});
