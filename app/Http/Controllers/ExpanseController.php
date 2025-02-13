<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\TripData;
use App\Models\UserData;
use App\Models\UserContro;
use App\Models\ExpanseData;
use App\Models\User;
class ExpanseController extends Controller
{
    //
    public function admin_permission($id){
        $user = \Auth::user();
        $created_by = TripData::where('id',$id)->pluck('created_by')->first();
        $trip_id_arr = UserData::where('uname', $user->uname)->where('request' , 'A')->pluck('trip_id')->toArray();
        if($user->id == $created_by || in_array($id , $trip_id_arr)) {
           return true;
        }
        return false;
    }
    function expanse(){
        $user = \Auth::user();
        $trip_id_arr = UserData::where('uname', $user->uname)->where('request' , 'A')->pluck('trip_id')->toArray();
        $admin_trip_id_arr = UserData::where('uname', $user->uname)->where('is_admin' , '1')->where('request' , 'A')->pluck('trip_id')->toArray();
        $trip_data = TripData::where('created_by', $user->id)
        ->orWhereIn('id', $trip_id_arr)
        ->orderBy('created_by', 'desc')
        ->paginate(10);
        return view('Expanse.index',['trip_data' => $trip_data, 'admin_trip_id_arr'=> $admin_trip_id_arr , 'user_id' => $user->id]);
    }

    public function trip_model() {
        $edit = $_GET['edit'];
        $view = $_GET['view'];
        $permission = $this->admin_permission($edit);
        $trip_data = TripData::where('id',$edit)->first();
        if($permission || !$trip_data ){
            
            return response()->json(
                ['data' => view('Expanse.trip_model',['edit' => $edit , 'view' => $view , 'trip_data_all' => $trip_data])->render()]);
        }
        return response()->json(['error' => 'Something went wrong'],400);
        
    }
    public function get_trip_uno(){
        $count = 0;
        $result =  rand(10000, 999999);
        $is_present = TripData::where('trip_uno' , $result)->get();
        if(count($is_present) > 0){
            $count++;
            if($count > 10){
                $result =  rand(10000, 9999999);
                return $result;
            }
            $this->get_trip_uno();
       }
       return $result;
    }
    public function trip_save(Request $request) {
        $user = \Auth::user();
        $rules = [
            'Trip_name' => 'required|string|max:255',
        ];
        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $trip_data = new TripData();    
        
        if(isset($request->edit) && $request->edit > 0){
            $permission = $this->admin_permission($request->edit);
            if($permission){
                $trip_data = TripData::where('id', $request->edit)->first();
                $trip_data->update_by = $user->id;
            }else{
                return response()->json(['error' => 'Form submitted failed'],400);
            }
            
        }else{
            $trip_uno = $this->get_trip_uno();
            $trip_data->trip_uno = $trip_uno;
            $trip_data->created_by = $user->id;
        }
        $trip_data->trip_name = $request->Trip_name;
        $trip_data->start_date = $request->start_date;
        $trip_data->End_date = $request->end_date;
        $trip_data->save();
        return response()->json(['message' => 'Form submitted successfully']);
    }

    public function trip_delete(Request $request){ 
        $user = \Auth::user();
        $permission = $this->admin_permission($request->delete);
        if($permission){
            $trip_data = TripData::where('id', $request->delete)->first();
            $trip_data->is_delete = 1;
            $trip_data->update_by = $user->id;
            $trip_data->save();
            return response()->json(['message' => 'Form Deleted successfully']);
        }
        return redirect()->route('expanse')->with('error', 'You are not authorized to view this page.');

    }

    public function expanse_view($id , $created_by){
        $user = \Auth::User();
        // $trip_id = UserData::where('user_name', $user->uname)->pluck('trip_id')->toArray();
        $is_delete  = TripData::where('id' , $id)->where('is_delete' , 0)->first();
        $trip_name = $is_delete->trip_name;
         $trip_data = UserData::where('trip_id' , $id)->where('request' , 'A')->pluck('uname')->toArray();
         $trip_user = TripData::where('id',$id)->pluck('created_by')->first();
         if(($user->id == $trip_user || in_array( $user->uname , $trip_data)) && $is_delete){
            $is_admin = UserData::where('uname', $user->uname)->where('trip_id' , $id)->where('request' , 'A')->pluck('is_admin')->first(); 
           // $user_data = UserData::where('trip_id', $id)->get();
            if($user->id ==  $trip_user ){
                $is_admin = 1;
            }
           $expanse_data = ExpanseData::where('trip_id', $id)->orderby('date','asc')->get();
            return view('Expanse.expanse_view',['trip_id' => $id , 'expanse_data' => $expanse_data , 'is_admin' => $is_admin , 'trip_name' => $trip_name]);
        }else{
            return redirect()->route('expanse')->with('error', 'You are not authorized to view this page.');
        }  
        
    }

    public function expanse_model() {
        $edit = $_GET['edit'];
        $view = $_GET['view'];
        $trip_id = $_GET['trip_id'];
        $permission = $this->admin_permission($trip_id);
        if($permission){
        $expanse_data = '';
        $expanse_data_user_arr = [];
        if($edit > 0){
            $expanse_data = ExpanseData::where('id',$edit)->first();
            //$expanse_data_user_arr = explode(",",$expanse_data->user_id);
            
            $expanse_data_user_arr = $expanse_data->user_id != null ? explode(",", $expanse_data->user_id) : [];

        }
        $user_data = UserData::where('trip_id',$trip_id)->where('request' , 'A')->orderBy('uname', 'asc')->get();
        return response()->json(
            ['data' => view('Expanse.expanse_model',['edit' => $edit , 'view' => $view, 'trip_id' =>$trip_id , 'user_data' => $user_data,'expanse_data'=>$expanse_data , 'exp_user_array' => $expanse_data_user_arr])->render()]);
        }
        return response()->json(['error' => 'Something went wrong'],400);
    }
    
    public function expanse_save(Request $request){
       
        $user = \Auth::user();
        $rules = [
            'price' => 'required|string|max:255',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $checkbox_str = '';
        $checkbox_array = [];
        if(isset($request->exclude)){
            $array = (array) $request->all();
           
            $exclude_key = ['expanse_name','price','start_date','desc','exclude','trip_id', 'edit'];
            
            foreach ($array as $key => $value) {
                if( !in_array($key , $exclude_key) ){
                    $checkbox_array[] = $key;
                }
            };
            $checkbox_str = implode( ',' , $checkbox_array );
            
        }
        $expanse_data = new ExpanseData();
        if(isset($request->edit) && $request->edit > 0){
            $expanse_data = ExpanseData::where('id', $request->edit)->first();
            $expanse_data->update_by = $user->id;
        }else{
            $expanse_data->added_by = $user->id;
        }
        $expanse_data->trip_id = $request->trip_id;
        $expanse_data->user_id = $checkbox_str;    
        $expanse_data->expanse_name = $request->expanse_name;
        $expanse_data->expanse_amount = $request->price;
        $expanse_data->desc = $request->desc;
        $expanse_data->include_all = isset($request->include_all) ? 1 : 0 ;
        $expanse_data->date = is_null($request->start_date) ? date('Y-m-d') : $request->start_date ;
        //$expanse_data->added_by = $user->id;
        $expanse_data->save();
       /* $user_data = UserData::where('trip_id' , $request->trip_id)->whereNotIn('id',$checkbox_array )->get();
        $per_user_contro = $request->price / count($user_data);
       // print_r($per_user_contro);die();
       if($edit == 0){
        foreach ($user_data as $data) {
            $data->total_balance = $data->total_balance + $per_user_contro;
            $data->save();
        }
       }*/
        
        return response()->json(['message' => 'Form submitted successfully']);

    }
    
    public function calculate_contro(Request $request){
        $permission = $this->admin_permission($request->trip_id);
        if($permission){
        $expanse_data = ExpanseData::where('trip_id',$request->trip_id)->get();
        $user_data = UserData::where('trip_id' , $request->trip_id)->where('request' , 'A')->get();
        $final_expanses = 0;
        $user_array=[];
        foreach ($user_data as $data1) {
            $user_array[$data1->id] = 0;
        }
        $user_array_count = count($user_array);
        foreach ($expanse_data as $data){
            if($data->include_all == 1 or $data->user_id != ''){
                $exclude_arr = [];
                if($data->include_all == 0){
                    $exclude_arr = $data->user_id != null ? explode(",", $data->user_id) : [];
                }
                $contro_user_count = $user_array_count - count($exclude_arr);
                $contro_distrtibute = $data->expanse_amount / $contro_user_count;
                foreach($user_array as $id => $value) {
                    if(!in_array($id,$exclude_arr)){
                        $user_array[$id] = $value + $contro_distrtibute;
                    }
                }
                $final_expanses = $final_expanses +  $data->expanse_amount;
                }
        }
          
            $trip_final_data = TripData::where('id',$request->trip_id)->first();
            
            $trip_final_data->final_expanse = $final_expanses ;
          
            $trip_final_data->save();
        //print_r($user_array);die;
            //$user_data = UserData::where('trip_id' , $request->trip_id)->whereNotIn('id',$exclude_arr )->get();
            //$per_user_contro = $data->expanse_amount / count($user_data);
            foreach ($user_data as $data1) {
                $data1->total_balance = round($user_array[$data1->id]);
                $data1->save();
            }
        
            return response()->json(['message' => 'Calculation done']);
        }
        return response()->json(['message' => 'Something went wrong']);
    }

    public function user_view($id , $created_by){
        $user = \Auth::User();
       // $trip_id = UserData::where('user_name', $user->uname)->pluck('trip_id')->toArray();
       $is_delete  = TripData::where('id' , $id)->where('is_delete' , 0)->first();
       //$trip_name = $is_delete->trip_name;
        $trip_data = UserData::where('trip_id' , $id)->where('request' , 'A')->pluck('uname')->toArray();
        $trip_user = TripData::where('id',$id)->pluck('created_by')->first();
        if(($user->id == $trip_user || in_array( $user->uname , $trip_data)) && $is_delete){
            $is_admin = UserData::where('uname', $user->uname)->where('request' , 'A')->where('trip_id' , $id)->pluck('is_admin')->first(); 
           // $user_data = UserData::where('trip_id', $id)->get();
            if($user->id == $trip_user ){
                $is_admin = 1;
            }
            $user_data = UserData::where('trip_id', $id)->where('request', 'A')->paginate(10);
            $user_pend_data = UserData::where('trip_id', $id)->where('request', 'P')->paginate(10);
            return view('Expanse.user_view',['trip_id' => $id , 'user_data' => $user_data ,'user_pend_data' => $user_pend_data , 'is_admin' => $is_admin ,'trip_name'=>$is_delete]);
        }else{
            return redirect()->route('expanse')->with('error', 'You are not authorized to view this page.');
        }   
    }

    public function user_model() {
        $edit = $_GET['edit'];
        $view = $_GET['view'];
        $trip_id = $_GET['trip_id'];
        $user_data = UserData::where('id',$edit)->where('request' , 'A')->first();
        $permission = $this->admin_permission($trip_id);
        if($permission || !$user_data){
        return response()->json(
            ['data' => view('Expanse.user_model',['edit' => $edit , 'view' => $view , 'trip_id' => $trip_id , 'user_data' => $user_data ])->render()]);
        }
        return response()->json(['error' => 'Something went wrong'],400);
    }
    

    public function user_save(Request $request){
        //print_r($request->all());die;
        $user = \Auth::user();
     

        // Check if validation fails
        
        $user_data = new UserData();
        if(isset($request->edit) && $request->edit > 0){
            $rules = [
                'user_name' => 'required|string|max:255',
            ];
    
            // Validate the request
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
            $user_data = UserData::where('id', $request->edit)->where('request' , 'A')->first();
            $user_data->update_by = $user->id;
            $user_data->user_name =   $request->user_name;
            $user_data->request = isset($request->can_remove)? 'P' : 'A';
        }else{
            $user_data->added_by = $user->id;
            $user_data->uname = $user->uname;
            $user_data->user_name =   $user->name;
            $user_data->request = 'P';
            $user_data->add_date = date('Y-m-d');
        }
        $user_data->trip_id = $request->trip_id;
        $user_data->is_admin = isset($request->can_edit)? 1 : 0;
        
        $user_data->save();
        return response()->json(['message' => 'Form submitted successfully']);
        
    }


    public function user_contro_model() {
        $user = \Auth::user();
        $edit = $_GET['edit'];
        $view = $_GET['view'];
        $trip_id = $_GET['trip_id'];
        $permission = $this->admin_permission($trip_id);
        if($permission){
            $is_admin = UserData::where('uname',$user->uname)->where('request' , 'A')->pluck('is_admin')->first();
        
            $user_contro = '';
            $user_data = [];
            if($view > 0 ){
                $created_by = TripData::where('id',$trip_id)->pluck('created_by')->first();
                if($user->id == $created_by){
                    $is_admin = 1;
                }
                $user_contro = UserContro::where('user_id',$edit)
                                    ->where('trip_id',$trip_id)
                                    ->get();
                $user_data = UserData::where('trip_id', $trip_id)
                ->pluck('user_name', 'id')
                ->toArray();
            
            }
            return response()->json(
                ['data' => view('Expanse.user_contro_model',['edit' => $edit , 'view' => $view, 'trip_id' => $trip_id , 'user_contro' => $user_contro ,'user_data' => $user_data , 'is_admin' => $is_admin])->render()]);
        }
        return response()->json(['error' => 'Something went wrong'],400);
    }
    
    public function user_contro_save(Request $request){
       $user_split_total_contro = 0;
        $user = \Auth::user();
        $rules = [
            'amount' => 'required|string|max:255',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $user_contro = new UserContro();
        $user_contro->user_id = $request->edit;
        $user_contro->trip_id = $request->trip_id;
        $user_contro->contro_amount = $request->amount;
        $user_contro->contro_name = $request->product;
        $user_contro->added_by = $user->id;
        $user_contro->save();

        $user_total_contro = UserContro::where('user_id',$request->edit)
        ->where('trip_id',$request->trip_id)
        ->where('split', '!=', 'split')
        ->sum('contro_amount');

        $user_split_total_contro = UserContro::where('user_id',$request->edit)
        ->where('trip_id',$request->trip_id)
        ->where('split', 'split')
        ->sum('contro_amount');

        $user_total_contro = $user_total_contro -  $user_split_total_contro;
        $user_contro_data = UserData::where('id',$request->edit)->where('trip_id',$request->trip_id)->where('request' , 'A')->first();

        $user_contro_data->total_contro = $user_total_contro;
        $user_contro_data->save();

        return response()->json(['message' => 'Form submitted successfully']);
    }

    public function user_contro_delete(Request $request){
        $permission = $this->admin_permission($request->trip_id);
        if($permission){
        $user_split = UserContro::where('id',$request->delete)->first();
        if($user_split->to_user > 0){
            $to_user_total_contro = UserContro::where('split','split')->get();
            
            $to_user_total_contro = UserContro::where('user_id',$user_split->to_user)
            ->where('trip_id',$request->trip_id)
            ->where('split', '!=', 'split')
            ->sum('contro_amount');

            $user_split_total_contro = UserContro::where('user_id',$user_split->to_user)
            ->where('trip_id',$request->trip_id)
            ->where('split', 'split')
            ->sum('contro_amount');

            $to_user_total_contro = $to_user_total_contro -  $user_split_total_contro;

            $to_user_contro_data = UserData::where('id',$user_split->to_user)->where('trip_id',$request->trip_id)->first();

            $to_user_contro_data->total_contro = $to_user_total_contro + $user_split->contro_amount;

            $to_user_contro_data->save();
        }
        UserContro::where('id', $request->delete)
                    ->delete();
                    $del_id = $request->delete + 1;
        UserContro::where('id', $del_id)
        ->delete();


        $user_total_contro = UserContro::where('user_id',$request->uid)
        ->where('trip_id',$request->trip_id)
        ->where('split', '!=', 'split')
        ->sum('contro_amount');

        $user_split_total_contro = UserContro::where('user_id',$request->uid)
        ->where('trip_id',$request->trip_id)
        ->where('split', 'split')
        ->sum('contro_amount');

        $user_total_contro = $user_total_contro -  $user_split_total_contro;

        $user_contro_data = UserData::where('id',$request->uid)->where('trip_id',$request->trip_id)->first();

        $user_contro_data->total_contro = $user_total_contro;
        $user_contro_data->save();

        return response()->json(['message' => 'Form Deleted successfully']);
        }
        return response()->json(['error' => 'Something went wrong'],400);
    }

    public function user_split_model(){

        $edit = $_GET['edit'];
        $view = $_GET['view'];
        $trip_id = $_GET['trip_id'];
        $permission = $this->admin_permission($trip_id);
        if($permission){
        $user_data = UserData::where('trip_id',$trip_id)->where('request' , 'A')->get();
        return response()->json(
            ['data' => view('Expanse.user_split_model',['edit' => $edit , 'view' => $view , 'trip_id' => $trip_id , 'user_data' => $user_data ])->render()]);
        }
        return response()->json(['error' => 'Something went wrong'],400);
    }

    public function user_split_save(Request $request){
        //
        $user = \Auth::user();
        $rules = [
            'amount' => 'required|string|max:55',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        

        $user_contro = new UserContro();
        $user_contro->user_id = $request->frm_user;
        $user_contro->trip_id = $request->trip_id;
        $user_contro->contro_amount = $request->amount;
        $user_contro->contro_name = 'split';
        $user_contro->added_by = $request->edit;
        $user_contro->to_user = $request->to_user;
        $user_contro->split = 'contro';        
        $user_contro->save();

        $user_contro = new UserContro();
        $user_contro->user_id = $request->to_user;
        $user_contro->trip_id = $request->trip_id;
        $user_contro->contro_amount = $request->amount;
        $user_contro->contro_name = 'split';
        $user_contro->added_by = $request->edit;
        $user_contro->to_user = $request->frm_user;
        $user_contro->split = 'split';        
        $user_contro->save();

        

        $frm_user_total_contro = UserContro::where('user_id',$request->frm_user)
        ->where('trip_id',$request->trip_id)
        ->where('split', '!=', 'split')
        ->sum('contro_amount');

        $fuser_split_total_contro = UserContro::where('user_id',$request->frm_user)
        ->where('trip_id',$request->trip_id)
        ->where('split', 'split')
        ->sum('contro_amount');

        $frm_user_total_contro = $frm_user_total_contro -  $fuser_split_total_contro;

        $frm_user_contro_data = UserData::where('id',$request->frm_user)->where('trip_id',$request->trip_id)->first();

        $frm_user_contro_data->total_contro = $frm_user_total_contro;
        $frm_user_contro_data->save();


        $to_user_total_contro = UserContro::where('user_id',$request->to_user)
        ->where('trip_id',$request->trip_id)
        ->where('split', '!=', 'split')
        ->sum('contro_amount');

        $tuser_split_total_contro = UserContro::where('user_id',$request->to_user)
        ->where('trip_id',$request->trip_id)
        ->where('split', 'split')
        ->sum('contro_amount');

        $to_user_total_contro = $to_user_total_contro -  $tuser_split_total_contro;

        $to_user_contro_data = UserData::where('id',$request->to_user)->where('trip_id',$request->trip_id)->first();

        $to_user_contro_data->total_contro = $to_user_total_contro ;

        $to_user_contro_data->save();

        return response()->json(['message' => 'Form submitted successfully']);

    }

    public function user_trip_request(Request $request){
        $user = \Auth::user();
        $rules = [
            'trip_uno' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' =>'Trip Number is required'], 400);
        }
        $trip_data = TripData::where('trip_uno',$request->trip_uno)->where('is_delete',0)->first();
        
        if($trip_data){
            $is_present = UserData::where('trip_id' , $trip_data->id)->where('uname' , $user->uname)->first();
         
            if($is_present && $is_present->request == 'A'){
                return response()->json(['errors' =>'You are already added'], 400);
            }elseif($is_present && $is_present->request == 'P'){
                return response()->json(['errors' =>'Request Not Accept Yet'], 400); 
            }
            $trip_creator_name = User::where('id' , $trip_data->created_by)->pluck('name')->first();
            return response()->json(
                ['data' => view('Expanse.user_request_model',['trip_data_all' => $trip_data , 'trip_creator_name' => $trip_creator_name])->render()]);
        }
        return response()->json(['errors' =>'No Trip Found'], 400);
        
    } 

    public function acceptAll(Request $request){
        if($request->id == 0){
            UserData::whereIn('id', $request->user_ids)
                    ->update(['request' => 'A']);
        return response()->json(['message' => "Request accepted successfully"]);
        }

        UserData::where('id', $request->id)
                    ->update(['request' => 'A']);
        
        return response()->json(['message' => "Request accepted successfully"]);
        
    }
}
