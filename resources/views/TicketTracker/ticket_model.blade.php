
<form id="ticket_tracker_data">
    @csrf

    <div class="form-group">
        <label for="subject">Subject:</label>
        <input type="text" name="subject" id="subject" class="form-control" 
        value="">
        <span class="text-danger" id="error_subject"></span>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textArea type="text" name="description" id="description" class="form-control" 
        ></textArea>
        <span class="text-danger" id="error_description"></span>
    </div>
    <div class="form-group">
        <label for="assignto">Assign To:</label>
        <select name="assignto" id="assignto" class="form-control" >
            @foreach($assign_to as $data => $value)
            <option value="{{$data}}">{{$value}}</option>
            @endforeach
        </select>
        <span class="text-danger" id="error_user_name"></span>
    </div>


    <div class="from-group">
            <button class="form-control btn-success mt-5 btn-sm" onclick="update_submit();">Submit</button>
    </div>
   
</form>

<script>
    function update_submit() {
        var data =  $("#ticket_tracker_data").serialize();
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: 'POST',
            url : "{{url('ticket_save')}}",
            data : data,

            success: function (response) {
                location.reload();
            },
            error : function (response) {
                console.log(response);
               
            }
        });

    }
</script>