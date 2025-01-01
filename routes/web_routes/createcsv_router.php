<?php
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CSVController;
use Illuminate\Support\Facades\Route;

    Route::controller(CSVController::class)->group(function(){
        Route::get("/csv_view" , 'csv_view')->name('csv_view');
        Route::get("/csv_setting" , 'csv_setting')->name('csv_setting');
        Route::post("/create_csv" , 'create_csv')->name('create_csv');
       
    });
    