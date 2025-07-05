<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Middleware\Checkedloggedin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
//For sign in and signup page

Route::get('/viewdocument', function () {
 return view('Expanse.ViewDocument');
});

Route::group(['middleware' => 'guest'],function() {
    Route::controller(AuthenticationController::class)->group(function(){
        require __DIR__ . '/web_routes/auth_routes.php'; 
    });
});
//After sign in
Route::group(['middleware' => 'checkedloggedin'],function() {
    require __DIR__ . '/web_routes/profile_route.php';
    require __DIR__ . '/web_routes/user_router.php';
    require __DIR__ . '/web_routes/ticket_router.php';
    require __DIR__ . '/web_routes/createcsv_router.php';
    require __DIR__ . '/web_routes/vapt_routes.php';
    require __DIR__ . '/web_routes/bloodcamp_routes.php';
    require __DIR__ . '/web_routes/expanse_routes.php';
    require __DIR__ . '/web_routes/export_pdf.php';
    require __DIR__ . '/web_routes/road_map.php';
    require __DIR__ . '/web_routes/ticket_tracker.php';
    Route::get('/logout',[AuthenticationController::class,'logout'])->name('logout');
    


Route::get('/track', function () {
    return view('location.track');
});

Route::post('/update-location', function (\Illuminate\Http\Request $request) {
    $user = \Auth::user();
    DB::table('user_locations')->updateOrInsert(
        ['user_id' => $user->id],
        [
            'name' =>$user->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'updated_at' => now()
        ]
    );
    return response()->json(['status' => 'updated']);
});

Route::get('/dashboard', function () {
    $locations = DB::table('user_locations')->get();
    return view('location.dashboard', compact('locations'));
});
});

Route::get('/welcome' , function(){
    return view('welcome2');
});

// web.php



//->middleware(['checkedloggedin']);
