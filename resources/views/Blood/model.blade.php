<?php
$blood_grp_arr = ['','A+','O+','B+','AB+','A-','O-','B-','AB-'];
$gender = ['M' => 'Male' , 'F' => 'Female' , 'O' => 'Other'];
?>
<form id="donar_data">
@csrf
@if($edit > 0)
    <input value="{{$edit}}" style="display:none" name="edit">
    @endif
    <div class="form-group">
        <label for="donar_name">Name:</label>
        <input id="donar_name" type="text" name="donar_name" class="form-control"
        value="@if($edit > 0) {{$blood_data->Donar_name}} @endif">
        <span class="text-danger error" id="error_donar_name"></span>
    </div>
    
    <div class="form-group">
        <label for="mobile_no">Mobile No:</label>
        <input id="mobile_no" type="text" name="mobile_no" class="form-control"
        value="@if($edit > 0) {{$blood_data->mobile_no}} @endif">
        <span class="text-danger error" id="error_mobile_no"></span>
    </div>
    
    <div class="form-group">
    @if($gainer > 0 )
        <input value="{{$gainer}}" style="display:none" name="submission">
        <label for="hospital">Hospital:</label>
        <textarea id="hospital" name="hospital" class="form-control"
        >@if($edit > 0) {{$blood_data->hospital}} @endif</textarea>
    @else
        <label for="donar_address">Address:</label>
        <textarea id="donar_address" name="donar_address" class="form-control"
        >@if($edit > 0) {{$blood_data->address}} @endif</textarea>
    @endif
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="dob"> @if($gainer > 0 )Date: @else DOB: @endif</label>
            <input id="dob" type="date" name="dob" class="form-control"
            value="@if($edit > 0){{$blood_data->DOB}}@endif">
            @if($gainer == 0 ) <p id="ageResult">Your ag`e will be displayed here.</p> @endif
        </div>
        <div class="col-md-6">
            <label for="gender">Gender:</label>
            <select name="gender" id="gender" class="form-control" >
                @foreach($gender as $key=>$value)
                    <option value="{{$key}}" @if($edit > 0 && $blood_data->gender == $key) selected @endif >{{$value}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">
        @if($gainer > 0 ) 
            <label for="product">Product:</label>
            <input id="product" type="text" name="product" class="form-control"
            value="@if($edit > 0) {{$blood_data->product}} @endif">
        @else 
            <label for="weight">Weight:</label>
            <input id="weight" type="text" name="weight" class="form-control"
            value="@if($edit > 0) {{$blood_data->weight}} @endif">
        @endif
        </div>
        <div class="col-md-6">
            <label for="blood_grp">Blood Group:</label>
            <select name="blood_grp" id="blood_grp" class="form-control">
                @foreach($blood_grp_arr as $grp)
                    <option value="{{$grp}}" @if( $edit > 0 &&  $blood_data->blood_grp == $grp) selected @endif>{{$grp}}</option>
                @endforeach
            </select>
            <span class="text-danger error" id="error_blood_grp"></span>
        </div>
        
    </div>
    <br>
    
    <div class="form-group">
        @if($gainer > 0 ) 
            <label for="reference">Reference</label>
            <input id="reference" type="text" name="reference" class="form-control"
            value="@if($edit > 0) {{$blood_data->reference}} @endif">
        @else
            <label for="occupation">Occupation:</label>
            <input id="occupation" type="text" name="occupation" class="form-control"
            value="@if($edit > 0) {{$blood_data->occupation}} @endif">
        @endif
    </div>
    @if($gainer == 0 )
    <div class="row">
        <div class="col-md-6">
            <input type="checkbox" name="recieved" id='success' @if($edit > 0 &&  $blood_data->is_success == 'S') checked @endif>
            <label for="recieved" >Donation Successful!</label>
        </div>
        <div class="col-md-6">
            <input type="checkbox" @if($edit > 0 && $blood_data->is_success == 'R') checked @endif name="reject" id="reject">
            <label for="reject">Donation Unsuccessful!</label>
        </div>
    </div>
    <br>
    <div class="form-group" @if($edit > 0 && $blood_data->is_success == 'R') id='rdisplay' @else id="display" @endif>
        <label for="reason">Reason:</label>
        <input type="text" name="reason" class="form-control"
        value="@if($edit > 0) {{$blood_data->reason}} @endif">
    </div>
    @endif
    @if($view == 0 && $is_admin == 1)
        <div class="from-group">
            <button class="form-control btn-success mt-5"  @if($gainer == 0) id="submit_data" @endif onclick="submit_donor();">Submit</button>
        </div>
    @endif

</form>
<script>
     $(document).ready(function(){
        calculate_age();
        $("#display").hide();
        $("#reject").on('click' , function(){
        if($("#reject").prop('checked')){
            $("#display").css('display' , '');
            $("#rdisplay").css('display' , '');
            $("#success").prop('checked' , false);
        }else{
            $("#display").css('display' , 'none');
            $("#rdisplay").css('display' , 'none'); 
             
        }
        });

        $("#success").on('click' , function(){
            $("#reject").prop('checked' , false);
            $("#display").css('display' , 'none');
            $("#rdisplay").css('display' , 'none');
        });

        $('#dob').on('change', function() {
            calculate_age();
        });
        function calculate_age(){
            
                const birthdate = new Date($("#dob").val());
                const today = new Date();
                let age = today.getFullYear() - birthdate.getFullYear();
                const monthDifference = today.getMonth() - birthdate.getMonth();
                // Adjust age if birthdate's month and day have not yet occurred this year
                if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthdate.getDate())) {
                    age--;
                }
                if(age >= 18 ){
                    $('#ageResult').text(`You are ${age} years old.`).css('color','green');
                    $("#submit_data").prop('disabled' , false);

                }else{
                    $('#ageResult').text(`You are ${age} years old.`).css('color','red');
                    $("#submit_data").prop('disabled' , true);
                    
                }
                return true;
        }
        
     });

    function submit_donor(){
        var form_data = $("#donar_data").serialize();
        $(".error").css('display' , 'none');
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type:'POST',
            url:"{{url('save_blood')}}",
            data: form_data,
            success: function (response) {
                location.reload();
            },
            error : function (response) {
                Object.keys(response.responseJSON.errors).forEach(
                    field=>{
                        //console.log(response.responseJSON.errors[field][0]);
                        //console.log(field);return false;    
                        const errorMessage = response.responseJSON.errors[field][0];
                        $("#error_"+field).css('display' , '').html(errorMessage);
                    }
                );
             }

        })
    }
</script>