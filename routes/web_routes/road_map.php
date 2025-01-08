<?php
use App\Http\Controllers\RoadMapController;
use Illuminate\Support\Facades\Route;

    Route::controller(RoadMapController::class)->group(function(){
        Route::get('roadmap_model' , 'roadmap_model')->name('roadmap_model');
        Route::get('roadmap_{id}' , 'road_map_view')->name('road_map_view');
        
    });
