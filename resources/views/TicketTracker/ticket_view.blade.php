@include('User.header')
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #fafafa;
        }

        input[type="text"], input[type="date"], select {
            margin-bottom: 10px;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        .inline-fields {
            display: flex;
            justify-content: space-between;
        }

        .inline-fields .form-group {
            flex: 1;
            margin-right: 10px;
        }

        .inline-fields .form-group:last-child {
            margin-right: 0;
        }

        .submit-btn {
            background-color: #007bff;
            color: #fff;
            padding: 12px 30px;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: 100%;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }

         /* Pipeline structure */
         .log-pipeline {
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .log-step {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .log-step:last-child {
            margin-bottom: 0;
        }

        .log-step .log-circle {
            width: 30px;
            height: 30px;
            background-color: #007bff;
            color: #fff;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            margin-right: 15px;
        }

        .log-step .log-details {
            flex: 1;
        }

        .log-step .log-details .log-time {
            font-size: 12px;
            color: #777;
            margin-bottom: 5px;
        }

        .log-step .log-details .log-message {
            font-size: 14px;
            color: #333;
        }

    </style>

<div class="container">
        <h2>Ticket Assignment Form</h2>
        
        <form id="log_data">
            <input type="hidden" name="tid" value="{{$ticket_data->id}}">
            @csrf
            <!-- Subject Field -->
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required placeholder="Enter subject"
                value="{{$ticket_data->subject}}" disabled>
            </div>

            <!-- Description Field -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required placeholder="Enter description">{{$ticket_data->description}}</textarea>
            </div>

            <!-- Assign By and Assign On Fields on the same line -->
            <div class="inline-fields">
                <div class="form-group">
                    <label for="assign_by">Assign By</label>
                    <input type="text" id="assign_by" name="assign_by" required placeholder="Enter assigned by" value="{{$assign_by[$ticket_data->assign_by]}}">
                </div>
                <div class="form-group">
                    <label for="assign_on">Assign On</label>
                    <input type="date" id="assign_on" name="assign_on" value="{{$ticket_data->assign_date}}">
                </div>
            </div>

            <!-- Status Field -->
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="">Select Status</option>
                    <option value="P">Pending</option>
                    <option value="D">Done</option>
                    <option value="C">Closed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="assign_by">Assign To</label>
                <select name="assignto" id="assignto" class="form-control" >
                    @foreach($assign_by as $data => $value)
                    <option value="{{$data}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Log Field -->
            <div class="form-group">
                <label for="log">Log</label>
                <textarea id="log" name="log" required placeholder="Enter any logs or comments"></textarea>
            </div>

            <!-- Submit Button -->
            <button class="submit-btn" onclick="log_submit();">Submit</button>
        </form>
        <div class="log-pipeline">
            <h3>Previous Logs</h3>
            <?php $srno = 1;
                ?>
            <!-- Log Step 1 -->
            @foreach($ticket_log_data as $data)
                <div class="log-step">
                    <div class="log-circle">{{$srno}}</div>
                    <div class="log-details">
                        <div class="log-time">Assign by {{$assign_by[$data->assign_by]}} to {{$assign_by[$data->assign_to]}} on {{$data->assign_date}}</div>
                        <div class="log-message">{{$data->log}}</div>
                    </div>
                </div>
                <?php $srno++ ?>
            @endforeach


            <!-- Log Step 3 -->
            
        </div>
    </div>
<script>
    function log_submit() {
        var data =  $("#log_data").serialize();
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: 'POST',
            url : "{{url('log_data_save')}}",
            data : data,

            success: function (response) {
                location.reload();
            },
            error : function (response) {
              
            }
        });

    }
</script>
@include('User.footer')