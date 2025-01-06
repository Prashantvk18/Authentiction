<?php
use App\Http\Controllers\BloodCampController;
use Illuminate\Support\Facades\Route;

    Route::controller(BloodCampController::class)->group(function(){
        Route::get('blood' , 'blood')->name('blood');
        Route::get('blood_modal' , 'blood_modal')->name('blood_modal');
        Route::get('get_user_data' , 'get_user_data')->name('get_user_data');
        Route::post('save_blood' , 'save_blood')->name('save_blood');
        Route::post('export_pdf' , 'export_pdf')->name('export_pdf');
    });
