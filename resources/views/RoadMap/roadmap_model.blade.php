
<form id="map_data">
    @csrf
    @if($edit > 0)
        <input value="{{$edit}}" style="display:none" name="edit">
    @endif
    @if($trip_id > 0)
        <input value="{{$trip_id}}" style="display:none" name="trip_id">
    @endif
    <div class="row">
    <div class="form-group"> 
        <label for="time_taken">Time Taken:</labeL>    
        <input type="text" name="time_taken" class="form-control" placeholder="eg.5 hrs , 2 days , 1.30 hrs" value="@if($edit > 0){{$roadmap_data->time_taken}}@endif">
        <span class="text-danger" id="error_time_taken"></span>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label for="from_place">From:</label>
            <input type="text" name="from_place" id="from_place" placeholder="Thane" class="form-control" 
            value="@if($edit > 0) {{$roadmap_data->from_place}} @endif">
            <span class="text-danger" id="error_from_place"></span>
        </div>
        <div class="form-group col-md-6">
            <label for="to_place">To:</label>
            <input type="text" name="to_place" id="to_place" placeholder = "Malvan" class="form-control" 
            value="@if($edit > 0) {{$roadmap_data->to_place}} @endif">
            <span class="text-danger" id="error_to_place"></span>
        </div>
    </div>
   
    <div class="form-group">
        <label for="by_transport">By:</label>
        <input type="text" name="by_transport" id="by_transport" placeholder="Train" class="form-control" 
        value="@if($edit > 0) {{$roadmap_data->by_transport}} @endif">
        <span class="text-danger" id="error_by_transport"></span>
    </div>
    <div class="form-group">
        <label for="descrip">Description</label>
        <textarea name="descrip" id="descrip"  class="form-control" placeholder="eg. train,bus time and price , auto price , best place ,best hotel, hotel mobile no, etc">@if($edit > 0) {{$roadmap_data->descrip}} @endif</textarea>
        <span class="text-danger" id="error_descrip"></span>
    </div>
    
    @if($view == 0)
				<div class="from-group">
						<button class="form-control btn-success mt-5 btn-sm" onclick="update_submit();">Submit</button>
				</div>
    @endif
</form>

<script>
    function update_submit() {
        var data =  $("#map_data").serialize();
        $("#from_place").html('');
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: 'POST',
            url : "{{url('roadmap_save')}}",
            data : data,

            success: function (response) {
                location.reload();
            },
            error : function (error) {
                console.log(error);
              //  var error  = response.responseJSON.errors.from_place[0];
               /// $("#error_from_place").html(error);
                Object.keys(error.responseJSON.errors).forEach(field => {
                    console.log(field);
                    const errorMessage = error.responseJSON.errors[field][0];
                    console.log(errorMessage);
                    document.getElementById('error_' + field).innerHTML = errorMessage;
            });
            }
        });

    }
</script>