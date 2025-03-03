<?php
use App\Http\Controllers\TicektTrackerController;
use Illuminate\Support\Facades\Route;

    Route::controller(TicektTrackerController::class)->group(function(){
        
        Route::get('create_ticket_model' , 'create_ticket_model')->name('create_ticket_model');
        Route::get('ticket_tracker' , 'ticket_tracker')->name('ticket_tracker');
        Route::get('ticket_view_{id}' , 'ticket_view')->name('ticket_view');
        Route::post('log_data_save' , 'log_data_save')->name('log_data_save');
        Route::post('ticket_save' , 'ticket_save')->name('ticket_save');

    });
