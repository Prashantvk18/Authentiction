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
    




    

Route::get('/dashboard', function () {
    $user = \Auth::user();
    if($user->is_admin == 1){
        $locations = DB::table('user_locations')->get();
        return view('location.dashboard', compact('locations'));
    }elseif($user->is_admin == 3){
        $array = ['1','16','17','18','13','12','14','19','20','3'];
        $locations = DB::table('user_locations')->whereIn('user_id', $array)->get();
        return view('location.dashboard', compact('locations'));
    }
    
});
});


Route::get('/track/{id}', function ($id) {
    return view('location.track' , ['id' => $id]);
});

Route::post('/update-location', function (\Illuminate\Http\Request $request) {
 $array = ['1','16','17','18','3','13','7','12','15','14','19','20'];
 if(in_array( $request->userId , $array)){
    DB::table('user_locations')->updateOrInsert(
        ['user_id' => $request->userId],
        [
            'user_id' => $request->userId,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'updated_at' => now()
        ]
        );
    return response()->json(['status' => 'updated']);
 };
    return response()->json(['status' => 'No permission']);
});


Route::get('/welcome' , function(){
    return view('welcome2');
});

// web.php



//->middleware(['checkedloggedin']);
