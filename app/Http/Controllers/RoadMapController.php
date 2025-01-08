<?php

namespace App\Http\Controllers;
use App\Models\UserData;
use App\Models\TripData;
use Illuminate\Http\Request;

class RoadMapController extends Controller
{
    //
    public function road_map_view($id){
        $user = \Auth::user();
        $trip_data = UserData::where('trip_id' , $id)->pluck('mobile_no')->toArray();
        $trip_user = TripData::where('id',$id)->pluck('created_by')->first();
        if($user->id == $trip_user || in_array( $user->mobile_no , $trip_data)){
            return view('RoadMap.roadmap_view');
        }else{
            return redirect()->route('expanse')->with('error', 'You are not authorized to view this page.');
        }  
    }

    public function roadmap_model(){
        $edit = $_GET['edit'];
        $view = $_GET['view'];
        $trip_id = 0;
        return response()->json(
            ['data' => view('RoadMap.roadmap_model',['edit' => $edit , 'view' => $view , 'trip_id' => $trip_id ])->render()]);
    }
}
