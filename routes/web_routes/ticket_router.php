<?php
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\TicketData;
use Illuminate\Support\Facades\Route;

    Route::controller(TicketData::class)->group(function(){
        Route::get("/ticketview" , 'ticket_view')->name('ticket_view');
        Route::get("/add_ticket" , 'add_ticket')->name('add_ticket');
        Route::post("/ticketsave" , 'ticket_submit')->name('ticket_submit');
       
    });
    