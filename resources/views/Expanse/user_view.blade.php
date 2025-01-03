@include('User.header')
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body" id="form_data">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!---/Modal--->

<div class="container">
    @if($is_admin == 1)
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="get_formdata1(0,0,{{$trip_id}})">Add User</button>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="get_split_formdata(0,0,{{$trip_id}})">Split Contro</button>
        <br><br>
    @endif
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th style="width:150px;">User Name</th>
                    <th>Mobile No.</th>
                    <th>Total Contro</th>
                    <th>Total Expanse</th>
                    <th>Balance</th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $srno = 0;
                      $total_contro = 0;
                      $total_expanse = 0;
                ?>
                @foreach($user_data as $data)
                <?php $total_contro = $total_contro + $data->total_contro; ?>
                <?php $total_expanse = $total_expanse + $data->total_balance; ?>
                    <tr>
                        <td>{{$user_data->firstItem() + $srno }}</td>
                        <td>{{$data->user_name}}</td>
                        <td>{{$data->mobile_no}}</td>
                        <td>{{round($data->total_contro)}}</td>
                        <td>{{round($data->total_balance)}}</td>
                        <?php
                        $balance = round($data->total_balance) - round($data->total_contro)
                        ?>
                        <td @if(round($balance) > 0 ) style="color:red" @else style="color:green" @endif>{{round($balance)}}</td>
                        <td>
                            <button title="View Contro" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->id}},1,{{$data->trip_id}});"><i class="fa fa-eye"><i class="fa fa-wallet"></i></i></button>
                            @if($is_admin == 1)
                                <button title="Edit User" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" onclick="get_formdata1({{$data->id}},0,{{$data->trip_id}});"><i class="fa fa-edit"></i><i class="fa fa-user"></i></button>
                                <button title="Add Contro" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->id}},0,{{$data->trip_id}});"><i class="fa fa-plus"></i><i class="fa fa-wallet"></i></button>
                            @endif
                            <form action="{{url('export_user_expanse_pdf')}}" method = "get" class="d-inline-block mr-2">
                                <input type="hidden" value="{{$data->trip_id}}" name="tid">
                                <input type="hidden" value="{{$data->id}}" name="uid">
                                <button type="submit" name="Expanse PDF" class="btn btn-success" vaue="1" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>   
                            </form>
                        </td>
                    </tr>
                    <?php $srno++ ?>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="color:red">Total :</td>
                    <td style="color:green">{{ round($total_contro) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ≈</td>
                    <td style="color:red">{{ round($total_expanse) }}</td>
                    <td></td>
                    <td></td>
            </tfoot>
        </table>
    </div>
</div>
<script>

    function get_formdata1(edit=0,view=0,trip_id=0) {       
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                type: "get",
                url: "{{ route('user_model')}}",
                data:{
                    edit:edit,
                    view:view,
                    trip_id:trip_id
                },
                success: function (response) {
                    $("#form_data").html(response.data);
                },
                error : function (response){
                    console.log(response);
                }
            });
            }

            function get_formdata(edit=0,view=0,trip_id=0) {       
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                    type: "get",
                    url: "{{ route('user_contro_model')}}",
                    data:{
                        edit:edit,
                        view:view,  
                        trip_id:trip_id  
                    },
                    success: function (response) {
                        $("#form_data").html(response.data);
                    },
                    error : function (response){
                        console.log(response);
                    }
                });
            }

            function get_split_formdata(edit=0,view=0,trip_id=0) {       
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                    type: "get",
                    url: "{{ route('user_split_model')}}",
                    data:{
                        edit:edit,
                        view:view,  
                        trip_id:trip_id  
                    },
                    success: function (response) {
                        $("#form_data").html(response.data);
                    },
                    error : function (response){
                        console.log(response);
                    }
                });
            }
</script>
@include('User.footer')