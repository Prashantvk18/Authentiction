
<style>
        /* Basic styling for the body */
       

        /* Container for the form */
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        /* Styling the form title */
        .form-container h2 {
            text-align: center;
            color: #333;
        }

        /* Styling the label */
        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        /* Styling the select dropdown */
        select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            color: #333;
            background-color: #fff;
            appearance: none;
            outline: none;
            box-sizing: border-box;
        }

        /* Adding a custom arrow for the dropdown */
        select::-ms-expand {
            display: none;
        }

        .dropdown-container {
            position: relative;
        }

        .dropdown-container:after {
            content: '\2193'; /* Down arrow */
            font-size: 18px;
            color: #888;
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
        }

        /* Hover effect for the select */
        select:hover {
            border-color: #888;
        }

        /* Styling the submit button */
        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
<form id="trip_split_data">
    @csrf
    @if($edit > 0)
        <input value="{{$edit}}" style="display:none" name="edit">
    @endif
    @if($trip_id > 0)
        <input value="{{$trip_id}}" style="display:none" name="trip_id">
    @endif
    <div class="form-group">
        <label for="frm_user_name">From user :</label>
        <select id="frm_user" name="frm_user">
            @foreach($user_data as $data)
            <option value="{{$data->id}}">{{$data->user_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="to_user_name">To user :</label>
        <select id="to_user" name="to_user">
            @foreach($user_data as $data)
            <option value="{{$data->id}}">{{$data->user_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group"> 
        <label for="amount">Amount</labeL>    
        <input type="number" id="amount" name="amount" class="form-control" placeholder="Amount">
        <span id="error_user_amount" style="color:red"></span>
    </div>
    <div class="from-group">
        <button class="form-control btn-success mt-5" onclick="update_submit();">Submit</button>
    </div>
    
</form>

<script>
    function update_submit() {
        var data =  $("#trip_split_data").serialize();
        $("#amount").html('');
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: 'POST',
            url : "{{url('user_split_save')}}",
            data : data,

            success: function (response) {
                location.reload();
            },
            error : function (response) {
                console.log(response);
                var error  = response.responseJSON.errors.amount[0];
                $("#error_user_amount").html(error);
            }
        });

    }
</script>