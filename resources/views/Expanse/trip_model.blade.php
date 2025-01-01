<form id="trip_data">
    @if($edit > 0)
        <input value="{{$edit}}" style="display:none" name="edit">
    @endif
    <div class="form-group">
        <label for="Trip_name">Trip Name :</label>
        <input type="text" name="Trip_name" id="trip_Name" class="form-control" 
        value="@if($edit > 0) {{$trip_data_all->trip_name}} @endif">
        <span class="text-danger" id="error_trip_Name"></span>
    </div>
    
    <div class="row">
        <div class="form-group col-md-6"> 
            <label for="start_date">Start Date:</labeL>    
            <input type="date" name="start_date" class="form-control" placeholder="start Date:" value="@if($edit > 0){{$trip_data_all->start_date}}@endif">
        </div>
        <div class="form-group col-md-6">      
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" class="form-control" placeholder="end Date:" value="@if($edit > 0){{$trip_data_all->End_date}}@endif">
        </div>
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
        $("#trip_Name").html('');
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: 'POST',
            url : "{{url('trip_save')}}",
            data : data,

            success: function (response) {
                location.reload();
            },
            error : function (response) {
                console.log(response);
                var error  = response.responseJSON.errors.Trip_name[0];
                $("#error_trip_Name").html(error);
            }
        });

    }
</script>