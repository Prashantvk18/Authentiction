@include('User.header')


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm"> <!-- Modal size adjusted for mobile -->
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

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container">
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="get_formdata()">Add Trip</button>
    <br><br>
    <!-- Table wrapped in a responsive div -->
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th style="width:150px;">Trip Name</th>
                    <th>Trip No.</th>
                    <th>Total Expanse</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $srno = 0 ?>
                @foreach($trip_data as $data)
                    @if($data->is_delete == '0')
                        <tr>
                            <td>{{$trip_data->firstItem() + $srno }}</td>
                            <td>{{$data->trip_name}}</td>
                            <td>{{$data->trip_uno}}</td>
                            <td>{{$data->final_expanse}}</td>
                            <td>{{$data->start_date}}</td>
                            <td>{{$data->End_date}}</td>
                            <td>
                                <form action="{{ route('expanse_view', ['id' => $data->id, 'created_by' => $data->created_by]) }}" method="get" class="d-inline-block mr-2">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-block btn-sm"><i class="fa fa-eye"></i><i class="fa fa-shopping-cart"></i></button>
                                </form>

                                <form action="{{ route('user_view', ['id' => $data->id, 'created_by' => $data->created_by]) }}" method="get" class="d-inline-block mr-2">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-block btn-sm"><i class="fa fa-eye"></i><i class="fa fa-user"></i></button>
                                </form>

                                @if(in_array($data->id, $admin_trip_id_arr) || $data->created_by == $user_id)
                                    <button type="button" class="btn btn-primary btn-sm d-inline-block mr-2" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->id}},0,0);"> <i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger  btn-sm d-inline-block mr-2" onclick="delete_formdata({{$data->id}});"><i class="fa fa-trash"></i></button>
                                @endif
                            </td>
                        </tr>
                        <?php $srno++ ?>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function get_formdata(edit=0,view=0,deletes=0) {       
        event.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: "get",
            url: "{{ route('trip_model') }}",
            data:{
                edit: edit,
                view: view,    
            },
            success: function (response) {
                $("#form_data").html(response.data);
            },
            error: function (response){
                console.log(response.responseJSON.error);
                $("#form_data").html(response.responseJSON.error);
            }
        });
    }

    function delete_formdata(id=0) {
        var result = confirm('Are you sure you want to delete this Trip?');
        event.preventDefault();
        if(result){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                type: 'POST',
                url : "{{url('trip_delete')}}",
                data: { delete: id },
                success: function (response) {
                    location.reload();
                },
                error : function (response) {
                    $("#error_part").html(response.responseJSON.error)
                }
            });
        } else {
            return false;
        }
    }
</script>

@include('User.footer')
