<?php
use App\Http\Controllers\RoadMapController;
use Illuminate\Support\Facades\Route;

    Route::controller(RoadMapController::class)->group(function(){
        Route::get('roadmap_model' , 'roadmap_model')->name('roadmap_model');
        Route::get('roadmap_{id}' , 'road_map_view')->name('road_map_view');
        Route::get('trip_roadmap' , 'trip_roadmap')->name('trip_roadmap');
        Route::get('trip_roadmap_detail_{id}' , 'trip_roadmap_detail')->name('trip_roadmap_detail');
        Route::post('roadmap_save' , 'roadmap_save')->name('roadmap_save');
        Route::post('submit_roadmap' , 'submit_roadmap')->name('submit_roadmap');  
        Route::post('roadmap_delete' , 'roadmap_delete')->name('roadmap_delete');    
    });
