@include('Authentication.header')
<div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-sm-4"> 
                <div class="card mt-5 p-3">
                    <h3>Login Page</h3>
                    @if (Session::has('error'))
                        <p class="text-danger">{{Session::get('error')}}</p>
                    @endif
                    <form action="{{ url('/')}}" method = 'post'>
                        @csrf
                        <div class="form-group mt-2">
                            <label for="mobile_no">Mobile No:</label>
                            <input type="text" name="mobile_no" class="form-control" value="{{old('mobile_no')}}">
                            @error('mobile_no')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <label for="name">Password:</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <!---<div class="form-group mt-2">
                            <div class="g-recaptcha" data-sitekey="6Lfno6gpAAAAABjV2lSqrBno7ig-LqhE9xakBtQ6"></div><br>
                        </div>--->
                        <div class="form-group mt-3">
                            <button class="form-control btn btn-success">Log In</button>
                        </div>
                    </form>
                </div>
                <a href="/register">Create an account</a>
                <a href="/register" class="ml-3">Forgot Password</a>
                <br>
               &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Developed By Virat Kohli 2025
            </div>
        </div>
    </div>
@include('Authentication.footer')
<!---6Lfno6gpAAAAAJE5hI6UPLo-5GcR0Q6vYnyG54Zn secret key



<?php
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
?> --->