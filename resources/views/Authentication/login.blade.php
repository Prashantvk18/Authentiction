@include('Authentication.header')
<div class="container">
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded p-4">
                <h3 class="text-center mb-4 text-primary">Login</h3>
                @if (Session::has('error'))
                    <div class="alert alert-danger text-center">
                        {{ Session::get('error') }}
                    </div>
                @endif
                <form action="{{ url('/') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="mobile_no" class="font-weight-bold">Mobile No:</label>
                        <input type="text" name="mobile_no" class="form-control" value="{{ old('mobile_no') }}">
                        @error('mobile_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="font-weight-bold">Password:</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Google reCAPTCHA (optional) -->
                    <!-- 
                    <div class="form-group mt-3">
                        <div class="g-recaptcha" data-sitekey="your-site-key-here"></div>
                    </div> 
                    -->

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Log In</button>
                    </div>
                </form>

                <div class="d-flex justify-content-between mt-3">
                    <a href="/register" class="text-info">Create an account</a>
                    <a href="/forgot-password" class="text-info">Forgot Password?</a>
                </div>

                <p class="text-center mt-4 text-muted small">
                    &copy; 2025 Developed by Virat Kohli
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
        background-color: #fff;
        border-radius: 10px;
    }
    .card-header, .card-body {
        padding: 1.5rem;
    }
    .card-title {
        font-size: 1.5rem;
        color: #007bff;
    }
    .btn {
        padding: 10px;
        font-size: 1rem;
    }
    .btn-block {
        width: 100%;
    }
    .form-control {
        border-radius: 5px;
        border: 1px solid #ced4da;
        box-shadow: none;
    }
    .form-control:focus {
        border-color: #007bff;
    }
    .alert-danger {
        margin-top: 20px;
        font-size: 0.9rem;
    }
    .text-info {
        font-size: 0.9rem;
    }
</style>

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