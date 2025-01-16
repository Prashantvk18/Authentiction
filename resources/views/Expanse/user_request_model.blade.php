<form id="trip_data">
    <H3 class="text-center" style="font-family: 'Times New Roman', Times, serif;">Request To add Me</H3>
    <!-- Trip Name Section -->
        <div class="form-group mt-5">
        <label for="start_date" class="font-weight-bold">Trip Name:</label> <span class="text-primary">{{$trip_data_all->trip_name}}</span>
            <span class="text-danger" id="error_trip_Name"></span>
        </div>
        
        <!-- Date Section -->
            <!-- Start Date -->
        <div class="row">
            <div class="form-group col-md-6">   
                <div class="form-group"> 
                    <label for="start_date" class="font-weight-bold">Start Date:</label>  
                    <h4>{{$trip_data_all->start_date}}</h4>  
                </div>
            </div>
                <!-- End Date -->
            <div class="form-group col-md-6"> 
                <div class="form-group">      
                    <label for="end_date" class="font-weight-bold">End Date:</label>
                    <h4>{{$trip_data_all->End_date}}</h4>  
                </div>

        </div>
        <div class="from-group text-center">
             <h4><strong>Trip Created By {{$trip_creator_name}}</strong></h4>
        </div>
        <div class="from-group">
            <button class="form-control btn-success" onclick="update_submit({{$trip_data_all->id}});">Add Me</button>
        </div>
     </div>
 
</form>

<script>
    function update_submit(id=0) {
        var data =  $("#trip_data").serialize();
        $("#trip_Name").html('');
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: 'POST',
            url : "{{url('user_save')}}",
            data :{
                trip_id :id
            },

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