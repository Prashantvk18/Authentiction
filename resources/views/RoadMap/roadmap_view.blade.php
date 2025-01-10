@include('User.header')
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md"> <!-- Modal size adjusted for mobile -->
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
<!---/Modal-->
<div class="alert alert-success" style="display:none" id="msg_div">
    <p id="msg_success" ></p>
</div>
<div class="container">
@if($admin == 1)
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="get_formdata(0,0,0,{{$trip_id}})">Add Road Map</button>
    <br>
@endif
    <h3><b> Road map for {{$trip_name}} trip </b></h3>
    <br><br>
    <div class="table-responsive">
        <table class="table table-hover" id="table_data">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>From place</th>
                    <th>To place</th>
                    <th>By transport</th>
                    <th>Time Taken</th>
                    <th style="width:350px">Detail</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $srno = 1;
                      $total_expanse = 0;
                ?>
                @foreach($roadmap_data as $data)
                <?php $total_expanse = $total_expanse + $data->expanse_amount; ?>
                    <tr>
                        <td>{{ $srno }}</td>
                        <td>{{$data->from_place}}</td>
                        <td>{{$data->to_place}}</td>
                        <td>{{$data->by_transport}}</td>
                        <td>{{$data->time_taken}}</td>
                        <td> {{ Str::words($data->descrip, 10, '...') }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->id}},1,0,{{$trip_id}});"><i class="fa fa-eye"></i></button>
                            @if($admin == 1)
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->id}},0,0,{{$trip_id}});"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-danger  btn-sm d-inline-block mr-2" onclick="delete_formdata({{$data->id}});"><i class="fa fa-trash"></i></button>
                           @endif
                        </td>
                    </tr>
                    <?php $srno++ ?>
                @endforeach
            </tbody>
        </table>
        @if($admin == 1)
            <button type="button" class="btn btn-success" onclick="submit_roadmap({{$trip_id}},0);"><i>Submit</i></button>
            <button type="button" class="btn btn-danger" onclick="submit_roadmap({{$trip_id}},1);"><i>Remove</i></button>
           
        @endif
        <br>
    </div>
</div>

<script>
        function get_formdata(edit=0,view=0,deletes=0,trip_id = 0) {      
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: "get",
            url: "{{ route('roadmap_model')}}",
            data:{
                edit: edit,
                view: view,  
                delete: deletes,
                trip_id: trip_id
            },
            success: function (response) {
                $("#form_data").html(response.data);
            },
            error: function (response){
                $("#form_data").html(response.responseJSON.error);
                console.log(response);
            }
        });
    }
    function delete_formdata(id=0) {
        var result = confirm('Are you sure you want to delete this map?');
        event.preventDefault();
        if(result){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                type: 'POST',
                url : "{{url('roadmap_delete')}}",
                data: { delete: id },
                success: function (response) {
                    location.reload();
                },
                error : function (response) {
                    location.reload();
                }
            });
        } else {
            return false;
        }
    }

    function submit_roadmap(id=0,rid=0){
           $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type:"post",
            url:"{{route('submit_roadmap')}}",
            data:{
                trip_id : id,
                rid : rid
            },
            success: function (response) {
              // location.reload();
              $('#msg_div').show(); 
              $("#msg_success").html(response.message);
            },
            error : function (response){
                
            }
           })
        }
</script>
@include('User.footer')