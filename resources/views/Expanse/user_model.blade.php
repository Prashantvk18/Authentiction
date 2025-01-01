
<form id="trip_data">
    @csrf
    @if($edit > 0)
        <input value="{{$edit}}" style="display:none" name="edit">
    @endif
    @if($trip_id > 0)
        <input value="{{$trip_id}}" style="display:none" name="trip_id">
    @endif
    <div class="form-group">
        <label for="user_name">User Name :</label>
        <input type="text" name="user_name" id="user_name" class="form-control" 
        value="@if($edit > 0) {{$user_data->user_name}} @endif">
        <span class="text-danger" id="error_user_name"></span>
    </div>
    <div class="form-group"> 
        <label for="mobile_no">Mobile no:</labeL>    
        <input type="text"  name="mobile_no" class="form-control" placeholder="Mobile no:" value="@if($edit > 0) {{$user_data->mobile_no}} @endif" maxlength="10">
    </div>
	<div class="form-group"> 
        <label for="can_edit">Admin</labeL>    
        <input type="checkbox" name="can_edit" @if($edit > 0 )@if($user_data->is_admin == 1) checked @endif @endif >
    </div>
    @if($view == 0)
				<div class="from-group">
						<button class="form-control btn-success mt-5" onclick="update_submit();">Submit</button>
				</div>
    @endif
</form>

<script>
    function update_submit() {
        var data =  $("#trip_data").serialize();
        $("#user_name").html('');
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: 'POST',
            url : "{{url('user_save')}}",
            data : data,

            success: function (response) {
                location.reload();
            },
            error : function (response) {
                console.log(response);
                var error  = response.responseJSON.errors.user_name[0];
                $("#error_user_name").html(error);
            }
        });

    }
</script>