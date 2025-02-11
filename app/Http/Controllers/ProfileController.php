<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function profile_view(){
        $user = Auth::user(); // Get the currently authenticated user
        $user_data = new User();
        return view('Profile.profile_view',['user' => $user , 'user_data' => $user_data->all()]);
    }

    public function profile_save(Request $request){

        $rules = [
            'name' => 'required|string|max:255',
        ];
        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();
        return response()->json(['message' => 'Form submitted successfully']);
    }

    public function change_pwd(Request $request){

        $user = Auth::user();
        if($request->uname != ''){
           $user = User::where('uname' , $request->uname)->first();
           if(!$user){
                return response()->json(['errors' => 'User does not exit' , 'status' => '1'] , 400);
           }
           $user->is_admin = isset($request->is_admin) ? 2 : 0 ;
           $user->is_active = isset($request->is_active) ? 1 : 0 ;
        }

        if($request->password != ''){
            $request->validate([
                'password' => [
                    'required', // Password is required
                    'string', // It should be a string
                    'min:8', // Minimum length of 8 characters
                    'max:255', // Maximum length of 255 characters
                    'regex:/[A-Z]/', // At least one uppercase letter
                    'regex:/[a-z]/', // At least one lowercase letter
                    'regex:/[0-9]/', // At least one number
                    'regex:/[@$!%*?&]/', // At least one special character
                ],
            ]);
                if(!isset($request->uname)){
                $request->validate([
                    'old_password' => 'required'
                ]);
                if(!Hash::check($request->old_password, $user->password)) {
                    return response()->json(['errors' => 'Old password is incorrect.' , 'status' => '2'] , 400);
                }
            }
            $user->password = Hash::make($request->password);

        }

        // Check if the current password matches
        
 
        // Update the password
        

        $user->save();
    
        return  response()->json(['success' => 'Password updated Successfully.'] , 200);;
    
    }
}
