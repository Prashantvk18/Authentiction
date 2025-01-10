<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\UserData;
use App\Models\TripData;
use App\Models\RoadMapData;
use Illuminate\Http\Request;

class RoadMapController extends Controller
{
    //
    public function admin_permission($id){
        $user = \Auth::user();
        $is_delete  = TripData::where('id' , $id)->where('is_delete' , 0)->first();
        $created_by = TripData::where('id',$id)->pluck('created_by')->first();
        $trip_id_arr = UserData::where('mobile_no', $user->mobile_no)->pluck('trip_id')->toArray();
        if(($user->id == $created_by || in_array($id , $trip_id_arr)) && $is_delete) {
           return true;
        }
        return false;
    }

    public function is_admin($trip_id){
        $user = \Auth::user();
        $admin_status = UserData::where('trip_id' , $trip_id)->where('mobile_no' , $user->mobile_no)->first();
        $created_by = TripData::where('id' , $trip_id)->where('is_delete' , 0)->pluck('created_by')->first();
        
        if($admin_status->is_admin == 1 or $created_by == $user->id){
            return true;
        }else{
            return false;
        }
    }
    public function road_map_view($id){
        $user = \Auth::user();
        $permission = $this->admin_permission($id);
        if($permission){
            $is_admin = $this->is_admin($id);
            $admin = 0;
            if($is_admin){
                $admin = 1;
            }
            $trip_data = TripData::where('id',$id)->first();
            $road_map = RoadMapData::where('trip_id' , $id)->get();
            return view('RoadMap.roadmap_view' , ['trip_name' => $trip_data->trip_name , 'roadmap_data' => $road_map , 'trip_id' => $id , 'admin' => $admin]);
        }else{
            return redirect()->route('expanse')->with('error', 'You are not authorized to view this page.');
        }  
    }

    public function roadmap_model(){
        $edit = $_GET['edit'];
        $view = $_GET['view'];
        $trip_id = $_GET['trip_id'];
        $user = \Auth::user();
        $permission = $this->admin_permission($trip_id);
        if($permission){
            $roadmap_data = RoadMapData::where('id' ,$edit )->first();
        return response()->json(
            ['data' => view('RoadMap.roadmap_model',['edit' => $edit , 'view' => $view , 'trip_id' => $trip_id , 'roadmap_data' =>  $roadmap_data])->render()]);
        }
        return response()->json(['error' => 'Something went wrong'],400);
    }

    public function roadmap_save(Request $request){
        $permission = $this->admin_permission($request->trip_id);
        if($permission){
            $user = \Auth::user();
            $rules = [
                'time_taken' => 'required',
                'from_place' => 'required',
                'to_place'   => 'required',
                'by_transport'=>'required',
                'descrip'    => 'required|string|max:515'
            ];
            $validator = Validator::make($request->all() , $rules);

            if($validator->fails()){
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $road_map = new RoadMapData();
            if(isset($request->edit) && $request->edit > 0){
                $road_map = RoadMapData::where('id', $request->edit)->first();
                $road_map->updated_by = $user->id;
            }else{
                $road_map->created_by = $user->id;
            }
            $road_map->trip_id = $request->trip_id;
            $road_map->from_place = $request->from_place;
            $road_map->to_place = $request->to_place;
            $road_map->by_transport = $request->by_transport;
            $road_map->descrip = $request->descrip;
            $road_map->time_taken = $request->time_taken;
            $road_map->save();
        }
    }

    public function submit_roadmap(Request $request){
        $trip_id = $request->trip_id;
        $permission = $this->admin_permission($request->trip_id);
        if($permission){
            $trip_data = TripData::where('id' , $trip_id)->where('is_delete' , 0)->first();
            $trip_data->submit_roadmap = $request->rid > 0 ? 0 : 1;
            $msg = $request->rid > 0 ? 'Removed' : 'Submitted';
            $trip_data->save();
            return response()->json(['message' => 'Road Map '.$msg]);
        }
            return redirect()->route('expanse')->with('error', 'You are not authorized to view this page.');
    }
    
    public function roadmap_delete(Request $request){
        RoadMapData::where('id', $request->delete)
        ->delete();
        return response()->json(['message' => 'Form Deleted successfully']);
    }
    public function trip_roadmap(Request $request){
        $search_name = $request->search_name;
        if($search_name != ''){
            $trip_data = TripData::where('trip_name', 'like', '%' . $search_name . '%')
            ->where('is_delete' , 0)
            ->where('submit_roadmap' , 1)
            ->orderBy('created_at', 'desc')->get();
        }else{
            $trip_data = TripData::where('is_delete' , 0)->where('submit_roadmap' , 1)->get();
        }
        return view('RoadMap.trip_roadmap' , ['trip_data' => $trip_data]);
    }

    public function trip_roadmap_detail(Request $request){
        $trip_id = $request->id;
        $roadmap_data = RoadMapData::where('trip_id' , $trip_id)->get();
        return view('RoadMap.trip_roadmap_detail' , ['roadmap_data' => $roadmap_data]);
    }
    
}
