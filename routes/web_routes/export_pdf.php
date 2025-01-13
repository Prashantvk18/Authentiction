<?php
use App\Http\Controllers\ExportPdfController;
use Illuminate\Support\Facades\Route;

    Route::controller(ExportPdfController::class)->group(function(){
        Route::get('/export_pdf' , 'export_pdf')->name('export_pdf');   
        Route::get('/export_user_contro_pdf' , 'export_user_contro_pdf')->name('export_user_contro_pdf'); 
        Route::get('/export_user_expanse_pdf' , 'export_user_expanse_pdf')->name('export_user_expanse_pdf'); 
        Route::get('/export_user_pdf' , 'export_user_pdf')->name('export_user_pdf'); 
        Route::get('/export_roadmap_pdf' , 'export_roadmap_pdf')->name('export_roadmap_pdf');
          
        
    });