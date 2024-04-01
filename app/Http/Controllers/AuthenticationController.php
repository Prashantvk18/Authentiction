<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            'mobile_no' => 'required',
            'password' => 'required'
        ]);
        if(\Auth::attempt($request->only('mobile_no','password'))){
                return view('welcome');
        }
        return redirect('/')->withError('Invalid Credential');
    }

    //Save user data while register
    public function save_register(Request $request){
      
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required',
            'mobile_no' => 'required',
            'confirmed_password' => 'required|same:password',
            'otp' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $users = new User();
        $users->name = $request->name;
        $users->mobile_no = $request->mobile_no;
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
        \Auth::logout();
        session()->flush();
        return redirect('/'); 
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