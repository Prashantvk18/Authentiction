@include('User.header')


<div class="container">
<div id="successMessage" class="alert alert-success" style="display: none;">
    Profile saved successfully!
</div>
    <h3><b>User Profile</b></h3>
    <div class="card">
        <div class="card-header">
            Profile Information
        </div>
        <div class="card-body">
            <form id="profile_save">
                @csrf
                <div class="form-group">
                    <label for="uname">Unique Name</label>
                    <input type="text" name="uname" class="form-control" value="{{ $user->uname }}" disabled>
                </div>
                <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                    <span id="error_name" style="color:red"></span>
                </div>
                <button type="submit" class="btn btn-primary" onclick="profile_save();">Save Changes</button>
            </form>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            Change Password
        </div>
        <div class="card-body">
            <form id="change_pwd">
                @csrf
                @if(Session::get('is_admin') == 1)
                <div class="form-group">
                    <label for="uname">User List</label>
                    <select id="user_list" name="option" class="form-control" onchange ="add_user()">
                        @foreach($user_data as $data)
                        <option id="{{$data->uname}}" style="color: @if($data->is_admin == 1 && $data->is_active == 1) Green @elseif($data->is_admin == 0 && $data->is_active == 1) Blue @else Red @endif">{{$data->uname}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="uname">Unique Name</label>
                    <input type="text" id="u_name" name="uname" class="form-control" value="">
                    <span id="error_user" style="color:red"></span>
                </div>
                @endif
                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="text" name="old_password" class="form-control" value="" required>
                    <span id="error_old_pass" style="color:red"></span>
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" class="form-control" value="" required>
                    <span id="error_pass" style="color:red"></span>
                </div>
                @if(Session::get('is_admin') == 1)
                <div class="form-group"> 
                    <label for="is_admin">Admin</labeL>    
                    <input type="checkbox" name="is_admin">

                    <label for="is_active">Active</labeL>    
                    <input type="checkbox" name="is_active">
                </div>
                
                @endif
                <button type="submit" class="btn btn-primary" onclick="change_pwd();">Change Password</button>
            </form>
        </div>
    </div>

</div>
<script>
    function add_user(){
        const selectedOption = $("#user_list").val();
        $("#u_name").val(selectedOption);
    }
     function profile_save(){
        console.log('tes');
         var data = $("#profile_save").serialize();
         console.log('data');
         event.preventDefault();
         $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: 'POST',
            url : "{{url('profile_save')}}",
            data : data,

            success: function (response) {
                $('#successMessage').show().delay(3000).fadeOut();
                $('#profile_save')[0].reset();  // This clears the form fields
                $('html, body').animate({
                    scrollTop: 20
                }, 'fast');  
            },
            error : function (response) {
                console.log(response);
                var error  = response.responseJSON.errors.name[0];
                $("#error_name").html(error);
            }
         })
    }

    function change_pwd(){
         var data = $("#change_pwd").serialize();
         console.log('data');
         event.preventDefault();
         $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: 'POST',
            url : "{{url('change_pwd')}}",
            data : data,

            success: function (response) {
                $('#successMessage').show().delay(3000).fadeOut();
                $('#change_pwd')[0].reset();  // This clears the form fields
                $('html, body').animate({
                    scrollTop: 20
                }, 'fast'); 
            },
            error : function (response) {
                console.log(response);
                if( response.responseJSON.status == '1'){
                    var error  = response.responseJSON.errors;
                    $("#error_user").html(error);
                }else{
                    var error  = response.responseJSON.errors.old_password;
                    var error1  = response.responseJSON.errors.password;
                    if(error == undefined){
                        var error  =  response.responseJSON.errors
                    }
                    $("#error_old_pass").html(error);
                    $("#error_pass").html(error1);
                }
            }
         })
    }
</script>

@include('User.footer')