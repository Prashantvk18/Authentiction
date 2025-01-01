       
       
        <form id="ticket_data">
            <input value="{{$edit}}" style="display:none" name="edit">
            <div class="form-group">
                <label for="ticket_no">Ticket No.</label>
                <input type="text" name="ticket_no" id="ticket_no" class="form-control" 
                value="@if($edit > 0) {{$t_data->ticket_no}} @endif">
            </div>
            <span class="text-danger" id="error_ticket_no"></span>
            <div class="form-group">
                <label for="sub">Ticket Subject</label>
                <input  type='text' name="sub" id="sub"  class="form-control" 
                value="@if($edit > 0) {{$t_data->ticket_sub}} @endif">
            </div>
            <div class="form-group">
                <label for="descrip">Ticket Description</label>
                <textarea name="descrip" id="descrip"  class="form-control">@if($edit > 0) {{$t_data->ticket_description}} @endif</textarea>
            </div>
            <div class="form-group">   
                <div class="row">
                    <div class="col">
                    <input type="text" name="recieve" class="form-control" placeholder="Recieve From:" value="@if($edit > 0){{$t_data->receive_from}}@endif">
                    </div>
                    <div class="col">
                    <input type="text" name="forword" class="form-control" placeholder="Forword To:" value="@if($edit > 0){{$t_data->forword_to}}@endif">
                    </div>
                </div>
            </div>
            <div class="form-group"> 
                <label for="recieve_date">Start Date:</labeL>    
                <input type="date" name="recieve_date" class="form-control" placeholder="Recieve Date:" value="@if($edit > 0){{$t_data->start_date}}@endif">
            </div>
            <div>      
                <label for="forword_date">End Date:</label>
                <input type="date" name="forword_date" class="form-control" placeholder="Forword Date:" value="@if($edit > 0){{$t_data->End_date}}@endif">
            </div>
            @if($view == 0)
            <div class="from-group">
                <button class="form-control btn-success mt-5" onclick="ticket_submit()">Submit</button>
            </div>
            @endif
        </form>
      
<script>

    function ticket_submit(){
        var formdata = $("#ticket_data").serialize();
        $("#error_ticket_no").html('');
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: 'POST',
            url: "{{url('ticketsave')}}",
            data: formdata,
           
            success: function (response) {
                location.reload();
            },
            error : function (response) {
                var error  = response.responseJSON.errors.ticket_no[0];
                $("#error_ticket_no").html(error);
            }
        });
        console.log(formdata);
    }
</script>
