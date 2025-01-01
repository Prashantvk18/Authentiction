<!-- <h3>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Client Name&emsp;&emsp;&emsp;&emsp;</h3> -->
     <?php 
        $array = ['backup' => 'backup', 'query'=>'All Query' , 'patch'=>'All Lucee Patch' , 'jQuery'=> 'jQuery patch', 'run'=>'Run CL/CF' ,'rtol'=>'Railo to Lucee' , 'backyr_f'=>'Backyr update f' ,'backyr_d'=>'Backyr update d' , 'dpreport'=>'DP Reports' , 'techesign'=>'Tech-esign input'  , 'psqtrue'=>'PSQ True' , 'focapszip'=>'Focaps Zip','MaxLength_Client'=>'MaxLength_Client', 'comment'=>'SessinoRotate()','createoth' => 'Create Oth' ,'MTest' => 'Login Test'];

        $web_array = ['wbackup' => 'backup','web_query'=>'All Query' , 'web_patch'=>'All Lucee Patch' , 'web_jQuery'=> 'jQuery patch', 'web_run'=>'Run CL/CF','web_rtol'=>'Railo to Lucee' , 'webclient_backyr'=>'Backyr update c' ,'weblogin_backyr'=>'Backyr update l' , 'webgrp_backyr'=>'Backyr update g' ,'Weblogin_Liverisk'=>'WebloginLiverisk' , '2Fa' => '2Fa' , 'comment'=>'SessinoRotate()', 'web_createoth' => 'Create Oth' ,'WTest' => 'Login Test' ,'MaxLength_Client'=>'MaxLength_Client'
        ];

        $rms_array = ['rms_query'=>'All Query' , 'rms_patch'=>'All Lucee Patch' , 'rms_run'=>'Run CL/CF','rms_rtol'=>'Railo to Lucee' , 'comment'=>'SessinoRotate()', 'RMSTest' => 'Login Test'
    ];

        $checked_data = [];
        if($edit > 0){
            $checked_data = explode(',' ,$vapt_data->updatation_data);
        }
     ?>  
   
<form id="update_data">
    @if($edit > 0)
        <input value="{{$edit}}" style="display:none" name="edit">
    @endif
    
    <div class="form-group">
        <label for="ticket_no">Ticket No :</label>
        <input type="text" name="ticket_no" id="ticket_no" class="form-control" 
        value="@if($edit > 0) {{$vapt_data->ticket_no}} @endif">
    </div>
    <span class="text-danger" id="error_client_name"></span>
    <div class="form-group">
        <label for="client_name">Client Name :</label>
        <input type="text" name="client_name" id="client_name" class="form-control" 
        value="@if($edit > 0) {{$vapt_data->Client_name}} @endif">
    </div>
    <!----Start end date --->
    <div class="row">
        <div class="form-group col-md-6"> 
            <label for="recieve_date">Start Date:</labeL>    
            <input type="date" name="recieve_date" class="form-control" placeholder="Recieve Date:" value="@if($edit > 0){{$vapt_data->start_date}}@endif">
        </div>
        <div class="form-group col-md-6">      
            <label for="forword_date">End Date:</label>
            <input type="date" name="forword_date" class="form-control" placeholder="Forword Date:" value="@if($edit > 0){{$vapt_data->End_date}}@endif">
        </div>
    </div>
    <!------ Main web RMS IP ----->
    <div class="row">
        <div class="form-group col-md-4"> 
            <label for="main_ip">Main IP:</labeL>    
            <input type="text" name="main_ip" class="form-control" placeholder="Main IP Address" value="@if($edit > 0){{$vapt_data->main_ip}}@endif">
        </div>
        <div class="form-group col-md-4">      
            <label for="web_ip">Web IP:</label>
            <input type="text" name="web_ip" class="form-control" placeholder="Web IP Address" value="@if($edit > 0){{$vapt_data->web_ip}}@endif">
        </div>
        <div class="form-group col-md-4">      
            <label for="rms_ip">RMS IP:</label>
            <input type="text" name="rms_ip" class="form-control" placeholder="RMS IP Address" value="@if($edit > 0){{$vapt_data->rms_ip}}@endif">
        </div>
    </div>
    <!-----------------------Description-------------------------------->
    <div class="form-group">      
            <label for="description">Description:</label>
            <textarea type="text" name="description" class="form-control" placeholder="Forword Date:"> @if($edit > 0){{$vapt_data->description}}@endif</textarea>
    </div>
    
    <!----------- TABS --------->
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Main</a></li>
        <li><a data-toggle="tab" href="#menu1">Web</a></li>
        <li><a data-toggle="tab" href="#menu2">Live RMS</a></li>
    </ul>
    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <div class="row">
                @foreach($array as $key=>$value)
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="{{$key}}" id="{{$key}}"  type="checkbox" @if(in_array($key,$checked_data)) checked @endif>
                        <label for="{{$key}}">{{$value}}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div id="menu1" class="tab-pane fade">
            <div class="row">
                @foreach($web_array as $key=>$value)
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="{{$key}}" id="{{$key}}"  type="checkbox" @if(in_array($key,$checked_data)) checked @endif>
                        <label for="{{$key}}">{{$value}}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div id="menu2" class="tab-pane fade">
            <div class="row">
                @foreach($rms_array as $key=>$value)
                <div class="col-md-4">
                    <div class="form-group">
                        <input name="{{$key}}" id="{{$key}}"  type="checkbox" @if(in_array($key,$checked_data)) checked @endif>
                        <label for="{{$key}}">{{$value}}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @if($view == 0)
                <div class="from-group">
                    <button class="form-control btn-success mt-5" onclick="update_submit();">Submit</button>
                </div>
         @endif
    </div>
    <!------------TABS END ---------->
    <!-- <div class="row">
        @foreach($array as $key=>$value)
        <div class="col-md-4">
            <div class="form-group">
                <input name="{{$key}}" id="{{$key}}"  type="checkbox" @if(in_array($key,$checked_data)) checked @endif>
                <label for="{{$key}}">{{$value}}</label>
            </div>
        </div>
        @endforeach
        @if($view == 0)
        <div class="from-group">
            <button class="form-control btn-success mt-5" onclick="update_submit();">Submit</button>
        </div>
        @endif
    </div>   -->
</form>

<script>
    function update_submit() {
        var data =  $("#update_data").serialize();
        $("#error_client_name").html('');
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: 'POST',
            url : "{{url('vapt_save')}}",
            data : data,

            success: function (response) {
                location.reload();
            },
            error : function (response) {
                var error  = response.responseJSON.errors.ticket_no[0];
                $("#error_client_name").html(error);
            }
        });

    }
</script>