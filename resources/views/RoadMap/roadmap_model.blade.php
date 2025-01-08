
<form id="map_data">
    @csrf
    @if($edit > 0)
        <input value="{{$edit}}" style="display:none" name="edit">
    @endif
    @if($trip_id > 0)
        <input value="{{$trip_id}}" style="display:none" name="trip_id">
    @endif
    <div class="form-group"> 
        <label for="start_date">Date:</labeL>    
        <input type="date" name="start_date" class="form-control" placeholder="start Date:" value="@if($edit > 0){{$user_data->date}}@endif">
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="frm_name">From:</label>
            <input type="text" name="frm_name" id="frm_name" class="form-control" 
            value="@if($edit > 0) {{$user_data->frm_name}} @endif">
            <span class="text-danger" id="error_frm_name"></span>
        </div>
        <div class="form-group col-md-6">
            <label for="to_name">To:</label>
            <input type="text" name="to_name" id="to_name" class="form-control" 
            value="@if($edit > 0) {{$user_data->to_name}} @endif">
            <span class="text-danger" id="error_to_name"></span>
        </div>
    </div>
   
    <div class="form-group">
        <label for="by">By:</label>
        <input type="text" name="by" id="by" class="form-control" 
        value="@if($edit > 0) {{$user_data->by}} @endif">
        <span class="text-danger" id="error_by"></span>
    </div>
    <div class="form-group">
        <label for="descrip">Description</label>
        <textarea name="descrip" id="descrip"  class="form-control">@if($edit > 0) {{$user_data->description}} @endif</textarea>
    </div>
    
    @if($view == 0)
				<div class="from-group">
						<button class="form-control btn-success mt-5" onclick="update_submit();">Submit</button>
				</div>
    @endif
</form>

<script>
    function update_submit() {
        var data =  $("#map_data").serialize();
        $("#frm_name").html('');
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
                var error  = response.responseJSON.errors.frm_name[0];
                $("#error_frm_name").html(error);
            }
        });

    }
</script>