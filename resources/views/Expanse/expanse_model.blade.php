<form id="expanse_data">
    @if($edit > 0)
        <input value="{{$edit}}" style="display:none" name="edit">
    @endif
    @if($trip_id > 0)
        <input value="{{$trip_id}}" style="display:none" name="trip_id">
    @endif
    <div class="form-group">
        <label for="expanse_name">Expanse Name :</label>
        <input type="text" name="expanse_name" id="expanse_name" class="form-control" 
        value="@if($edit > 0) {{$expanse_data->expanse_name}} @endif" required>
    </div>
    
    <div class="row">
        <div class="form-group col-md-6">      
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" id ="price" placeholder="Expanse Price" value="@if($edit > 0){{$expanse_data->expanse_amount}}@endif">
            <span class="text-danger" id="error_expanse_price"></span>
        </div>
        <div class="form-group col-md-6"> 
            <label for="start_date">Date:</labeL>    
            <input type="date" name="start_date" class="form-control" placeholder="start Date:" value="@if($edit > 0){{$expanse_data->date}}@endif">
        </div>
    </div> 
    <div class="form-group">
        <label for="desc">Note :</label>
        <input type="text" name="desc" id="desc" class="form-control" 
        value="@if($edit > 0) {{$expanse_data->desc}} @endif">
    </div> 
    <div class="row">
        <div class="form-group col-md-3">
            <label for="include_all">Include All</label>
            <input type="checkbox" name="include_all" id="include_all" @if($edit > 0) @if($expanse_data->include_all == 1) checked @endif @endif>
        </div>
        <div class="form-group col-md-3">
            <label for="exclude">Exclude</label>
            <input type="checkbox" name="exclude" id="exclude" @if(!empty($exp_user_array)) checked @endif>
        </div>
    </div>
    
    <div id="exclude-options" style=" @if(empty($exp_user_array)) display: none; @endif">
        @foreach($user_data as $data)
            <label><input type="checkbox" name="{{$data->id}}" id="{{$data->id}}" 
            @if (in_array($data->id,$exp_user_array)) checked @endif>{{$data->user_name}}</label><br>
        @endforeach
    </div>
    @if($view == 0)
        <div class="from-group">
            <button class="form-control btn-success mt-5" onclick="update_submit();">Submit</button>
        </div>
    @endif
</form>

<script>
    $(document).ready(function() {
        // When "Include All" checkbox is clicked
        $('#include_all').on('change', function() {
            if ($(this).prop('checked')) {
                $('#exclude').prop('checked', false); // Uncheck the "Exclude" checkbox
                $('#exclude-options').hide();  // Hide the 10 checkboxes
        }
        });

        // When "Exclude" checkbox is clicked
        $('#exclude').on('change', function() {
            if ($(this).prop('checked')) {
                $('#include_all').prop('checked', false); // Uncheck the "Include All" checkbox
                $('#exclude-options').show();  // Show the 10 checkboxes
        } else {
            $('#exclude-options').hide();  // Hide the 10 checkboxes
        }
        });
    });

    function update_submit() {
        var data =  $("#expanse_data").serialize();
        $("#price").html('');
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: 'POST',
            url : "{{url('expanse_save')}}",
            data : data,

            success: function (response) {
               location.reload();
            },
            error : function (response) {
                console.log(response);
                var error  = response.responseJSON.errors.price[0];
                $("#error_expanse_price").html(error);
            }
        });
    }
</script>