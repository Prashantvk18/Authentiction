
@if($view == 0)
    <form id="contro_data">
        @if($edit > 0)
            <input value="{{$edit}}" style="display:none" name="edit">
            <input value="{{$trip_id}}" style="display:none" name="trip_id">
        @endif
        <div class="form-group">
            <label for="amount">Amount :</label>
            <input type="number" name="amount" id="amount" class="form-control" 
            value="">
            <span class="text-danger" id="error_amount"></span>
        </div>
        <div class="form-group"> 
            <label for="product">Product</labeL>    
            <input type="text" name="product" class="form-control" placeholder="product" value="">
        </div>
                    <div class="from-group">
                            <button class="form-control btn-success mt-5" onclick="update_submit();">Submit</button>
                    </div>

    </form>

    <script>
        function update_submit() {
            console.log("HII");
            var data =  $("#contro_data").serialize();
            $("#amount").html('');
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                type: 'POST',
                url : "{{url('user_contro_save')}}",
                data : data,

                success: function (response) {
                    location.reload();
                },
                error : function (response) {
                    console.log(response);
                    var error  = response.responseJSON.errors.amount[0];
                    $("#error_amount").html(error);
                }
            });

        }
    </script>
@else
    <div class="container">
        
    <table class="table" style="width:40%">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Contro Name</th>
                    <th>Contro amount</th>
                    @if($is_admin == 1)
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            <?php $srno = 1?>
                @foreach($user_contro as $data)
                    <tr>
                        <td>{{$srno }}</td>
                        <td>{{$data->contro_name}} 
                            @if($data->to_user > 0) 
                                @if($data->split == 'contro')
                                    <span>to </span>
                                @else
                                    <span>from </span>
                                @endif
                            {{ $user_data[$data->to_user] }}
                            @endif
                        </td>
                        <td>{{$data->contro_amount}}</td>
                        @if($is_admin == 1)
                            @if($data->to_user > 0 && $data->split == 'split') 
                            <td></td>
                            @else
                            <td>
                            <button type="button" class="btn btn-danger d-inline-block mr-2" data-toggle="modal" data-target="#myModal" onclick="delete_formdata({{$data->id}},{{$edit}},{{$trip_id}});"><i class="fa fa-trash"></i></button>
                            </td>
                                @endif
                        @endif

                    </tr>
                    <?php $srno++ ?>
                @endforeach
            </tbody>
        </table>
        <form action="{{url('export_user_contro_pdf')}}" method = "get" class="d-inline-block mr-2">
            <input type="hidden" value="{{$edit}}" name="uid">
            <input value="{{$trip_id}}" style="display:none" name="tid">
            <button type="submit" class="btn btn-success" vaue="1" >Generate Pdf</button>   
        </form>
    </div>
<script>
        function delete_formdata(id=0,uid=0,trip_id=0) {
            console.log("HII");
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                type: 'POST',
                url : "{{url('user_contro_delete')}}",
                data:{

                    delete:id,
                    uid:uid,
                    trip_id:trip_id
                },

                success: function (response) {
                  //  location.reload();
                },
                error : function (response) {
                }
            });

        }
    </script>
@endif