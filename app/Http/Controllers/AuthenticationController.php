<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\TripData;
use App\Models\UserData;
use TCPDF;

class AuthenticationController extends Controller
{
    //Login page 
    public function login(){
       
        return view('Authentication.login');
    }

    //User  register page
    public function register(){
        return view('Authentication.register');
    }

    //User Log in 
    public function login_user(Request $request){
        $request->validate([
            'uname' => 'required',
            'password' => 'required'
        ]);
        // $last =  Session::get('last_loggedin');
        // Session::put('mobile_no' ,  $request->mobile_no);
        // $user = User::where('mobile_no' ,$request->mobile_no)->first();
        // if(count($user) > 0){
        //     if(($last ==  $user->last_loggedin && !is_null($user->last_loggedin))
        //     or is_null($user->last_loggedin)){
        //         if(\Auth::attempt($request->only('mobile_no','password'))){
        //             Session::put('last_loggedin' , time());
        //             $user->last_loggedin = Session::get('last_loggedin');
        //             $suer->save();
        //             return view('User.home');        
        //         }
        //         return redirect('/')->withError('Invalid Credential');
        //     }
        //     return redirect('/')->withError('Only one user at a time'); 
        // }{
        //     return redirect('/')->withError('No user Found');  
        // }

        
        if(\Auth::attempt($request->only('uname','password'))){
            $user = \Auth::user();
            Session::put('user_name' , $user->name);
            Session::put('is_admin' , $user->is_admin);
            
            return redirect('/home');        
        }
        return redirect('/')->withError('Invalid Credential');
    }

    //Save user data while register
    public function save_register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
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
            'user_name' => 'required|unique:users,uname|max:255', 
            'confirmed_password' => 'required|same:password',
            //'otp' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $users = new User();
        $users->name = $request->name;
        $users->uname = $request->user_name;
        $users->password = \Hash::make($request->password);
        $users->is_active = 1;
        $users->save();
        
        return response()->json(['message' => 'User Created Successfully', 'redirect' => '/']);
        // if(\Auth::attempt($request->only('mobile_no','password'))){
        //     return view('welcome');
        // }
        return redirect('register')->withError('Error');
    }
    public function logout() {
        // $user = new User();
       
        // $user = User::where('mobile_no' ,  Session::get('mobile_no'))->first();
        // $user->last_loggedin = null;
        // $user->save();
        \Auth::logout();
        session()->flush();
        return redirect('/'); 
    }

    public function home(){
        $user = \Auth::user();
        $trip_id_arr = UserData::where('uname', $user->uname)->where('request' , 'A')->pluck('trip_id')->toArray();
        $trip_data = TripData::whereIn('id', $trip_id_arr)
                    ->where('is_delete', 0)
                    ->take(5)
                    ->get([ 'id' ,'trip_name', 'final_expanse' ]); // Specify both columns you want
        // Extract both columns into separate arrays
        $trip_names = $trip_data->pluck('trip_name')->toArray();
        $final_expanse_values = $trip_data->pluck('final_expanse')->toArray();  
        $values = $final_expanse_values;  // Dynamic data for the chart (values)
        $labels =  $trip_names;  // Labels for the chart
        if(count($values) == 0){
            $values = ['100'];  // Dynamic data for the chart (values)
            $labels = ['Lets Start your trip'];  
        }
        $trip_id = $trip_data->pluck('id')->toArray();
        $user_exp = UserData::where('uname', $user->uname)->whereIn('trip_id' , $trip_id)->where('request' , 'A')->pluck('total_balance')->toArray();
        //print_r($trip_id);print_r($user_exp); die;

        // Return the view and pass dynamic data to the view
        return view('User.home', compact('values', 'labels') , ['labels1' =>  $trip_names , 'dataset1' => $final_expanse_values , 'dataset2' => $user_exp]);
    }

   
}

    

// Validate CAPTCHA
/*$recaptchaSecretKey = "YOUR_SECRET_KEY";
$recaptchaResponse = $_POST['g-recaptcha-response'];

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecretKey}&response={$recaptchaResponse}");
$responseKeys = json_decode($response, true);

if(intval($responseKeys["success"]) !== 1) {
    echo "CAPTCHA verification failed.";
} else {
    // Continue with your login process
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Your login validation code here...

    echo "Login successful.";
}*/

