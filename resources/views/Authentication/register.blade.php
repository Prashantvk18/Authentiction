@include('Authentication.header')

     <div class="container ">
        <div class="row justify-content-center mt-20">
            <div class="col-sm-4"> 
                <div class="card mt-5 p-3" >
                    <h3 class="text-center mb-4 text-primary">Create User</h3>
                    @if (Session::has('error'))
                        <p class="text-danger">{{ Session::get('error') }}</p>
                    @endif
                    <span id="success_msg" class="text-success"></span>
                    <form  id="taskForm">
                        <div class="form-group">
                            <label for="name">User Name:</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"  autocomplete="off">
                            <span id="error-name" class="text-danger"></span>
                        </div>
                        
                        <div class="form-group">
                            <label for="user_name">Create Unique Name</label>
                            <input type="user_name" id="user_name" name="user_name" class="form-control" value="{{ old('user_name') }}">
                            <span id="error-user_name" class="text-danger"></span>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" class="form-control">
                            <span id="error-password" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="confirmed_password">Confirm Password:</label>
                            <input type="text" name="confirmed_password" class="form-control">
                            <span id="error-confirmed_password" class="text-danger"></span>
                        </div>
                        <br>
                        <!---<div id="recaptcha_container"></div>
                        <br>
                        <div>
                            <span id="error_otp" style="color:red;display:none">
                        </div>
                        <a style="color:blue;" onClick="send_otp()"><i>Send_OTP</i> </a><br>
                        <div class="form-group">
                            <label for="otp">Enter OTP:</label>
                            <input type="text" id="otp" name="otp" class="form-control">
                            <span id="error-otp" class="text-danger"></span>
                            
                        </div>--->
                        <br>
                       

                        <div class="form-group">
                            <button  id= "myButton" class="btn btn-primary btn-block">Create User</button>
                        </div>
                        <div class="form-group text-center" style="float-inline-end">
                            <a href="/" class="text-info">Already have account!!</a>
                        </div>
                        <p class="text-center mt-4 text-muted small">
                            &copy; 2025 Developed by Virat Kohli
                        </p>  
                    </form>
                    <div><img id = "image"></div>
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
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<!-- Include other Firebase modules if needed -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    
   // Your Firebase configuration
   const firebaseConfig = {
    //Here you have to insert your firbase config
    
  apiKey: "AIzaSyD0VTTXerQfhPdmNnrObQaO0tk6BhUNH4w",
  authDomain: "otpverification-796e2.firebaseapp.com",
  databaseURL: "https://otpverification-796e2-default-rtdb.firebaseio.com",
  projectId: "otpverification-796e2",
  storageBucket: "otpverification-796e2.appspot.com",
  messagingSenderId: "474050765523",
  appId: "1:474050765523:web:a9ce987cbeb36125202a26",
  measurementId: "G-98DT0551V9"
};
   
   // Initialize Firebase
   firebase.initializeApp(firebaseConfig);

$(document).ready(function() {
		render();
      
	});
   

	function render() {
		window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha_container');
		recaptchaVerifier.render();
	}
    /*
    function send_otp() {
            
			var number = "+91"+$("#user_name").val();
            console.log(number);
			firebase.auth().signInWithPhoneNumber(number , window.recaptchaVerifier).then(function (confirmationResult){
				window.confirmationResult = confirmationResult;
                console.log(confirmationResult);
				// $('#sent_otp').text("OTP send successfully");
				// $("#send_otp").show();
				alert("OTP Send");
			}).catch(function(error){
				$('#error_otp').text(error.message);
				$("#error_otp").show();
			});

		
		}*/

  


        // function verify() {
        //         var code = $("#verification").val();
        //         coderesult.confirm(code).then(function (result) {
        //             var user = result.user;
        //             console.log(user);
        //             $("#successOtpAuth").text("Auth is successful");
        //             $("#successOtpAuth").show();
        //         }).catch(function (error) {
        //             $("#error").text(error.message);
        //             $("#error").show();
        //         });
        //     }
           
        $('#myButton').click(function(event) {
                event.preventDefault();
            var code =$("#otp").val();
            var success = 0;
            var formData = $('#taskForm').serialize();
            $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'post',
                        url:"{{ url('register') }}",
                        data:formData,
                        success: function(response) {
                            console.log(response.message);
                            $("#taskForm").css('display', 'none');
                            document.getElementById("success_msg").innerHTML = response.message;
                            //$("#image").attr('src' , 'image/welcome.png');
                            setTimeout(function() {
                                // Code to execute after the "pause"
                                window.location.href = response.redirect;
                            }, 3000);
                           
                   
                            // Handle success (e.g., update UI, display message)
                        },
                        error: function(error) {
                        console.log(error);
                            Object.keys(error.responseJSON.errors).forEach(field => {
                                console.log(field);
                                const errorMessage = error.responseJSON.errors[field][0];
                                console.log(errorMessage);
                                document.getElementById('error-' + field).innerHTML = errorMessage;
                        });
                            
                        // alert(error.message);
                            //alert(error->message);
                        // Handle error (e.g., display error message)
                        }
                    });

            /*if(code.length){
                if (typeof  confirmationResult == 'undefined'){
                    $('#error_otp').html('The OTP has not been generated');
                    $("#error_otp").show();
                    return false;
                }
                confirmationResult.confirm(code).then(function(result){
                    console.log("YES");
                    var user = result.user;
                    var formData = $('#taskForm').serialize();
                    console.log(formData);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'post',
                        url:"{{ url('register') }}",
                        data:formData,
                        success: function(response) {
                            console.log(response.message);
                            $("#taskForm").css('display', 'none');
                            document.getElementById("success_msg").innerHTML = response.message;
                            //$("#image").attr('src' , 'image/welcome.png');
                            setTimeout(function() {
                                // Code to execute after the "pause"
                                window.location.href = response.redirect;
                            }, 3000);
                           
                   
                            // Handle success (e.g., update UI, display message)
                        },
                        error: function(error) {
                        console.log(error);
                            Object.keys(error.responseJSON.errors).forEach(field => {
                                console.log(field);
                                const errorMessage = error.responseJSON.errors[field][0];
                                console.log(errorMessage);
                                document.getElementById('error-' + field).innerHTML = errorMessage;
                        });
                            
                        // alert(error.message);
                            //alert(error->message);
                        // Handle error (e.g., display error message)
                        }
                    });

            }).catch(function(error){
                $('#error_otp').text(error.message);
				$("#error_otp").show();
            });
            }*/
           

            });


	</script>
@include('Authentication.footer')
