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
        <div class="alert alert-success" style="display:none" id="msg_div">
            <p id="msg_success" ></p>
        </div>
    <div class="container">
        <h4><strong>{{$trip_name}}</strong></h4>
    @if($is_admin == '1')
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="get_formdata(0,0,0,{{$trip_id}})">Add Expanse
        </button>
    @endif
    <form action="{{url('export_pdf')}}" method = "get" class="d-inline-block mr-2">
        <input type="hidden" value="{{$trip_id}}" name="tid">
        <button type="submit" class="btn btn-success btn-sm" vaue="1" ><i>Generate Pdf</i></button>   
    </form>
    <form action="{{route('road_map_view' , ['id' => $trip_id ])}}" method="get" class="d-inline-block mr-2">
    @csrf
        <button type="submit" class="btn btn-danger btn-block btn-sm">
            <i class="fa fa-map">Add Road Map</i>
        </button>
    </form>
    <br><br>
    <div class="table-responsive">
        <table class="table table-hover" id="table_data">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th style="width:150px;">Expanse Name</th>
                    <th>Expanse Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $srno = 1;
                      $total_expanse = 0;
                ?>
                @foreach($expanse_data as $data)
                <?php $total_expanse = $total_expanse + $data->expanse_amount; ?>
                    <tr>
                        <td>{{ $srno }}</td>
                        <td>{{$data->expanse_name}}</td>
                        <td>{{$data->expanse_amount}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->id}},1,0,{{$trip_id}});"><i class="fa fa-eye"></i></button>
                            @if($is_admin == '1')
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->id}},0,0,{{$trip_id}});"><i class="fa fa-edit"></i></button>
                                <!---<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->id}},0,1,0);">Delete expanse</button>--->
                            @endif
                        </td>
                    </tr>
                    <?php $srno++ ?>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td style="color:red">Total Expanse :</td>
                    <td style="color:red">{{ $total_expanse }}</td>
                    <td></td>
            </tfoot>
        </table>
    
        <br>
    </div>
    @if($is_admin == '1')
        <button type="button" class="btn btn-warning btn-sm" onclick="calculate_contro({{$trip_id}})">Calculate Contro</button>
    @endif
</div>

<script>
    function get_formdata(edit=0,view=0,d_id=0,trip_id=0) {       
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                type: "get",
                url: "{{ route('expanse_model')}}",
                data:{
                    edit:edit,
                    view:view, 
                    delete:d_id, 
                    trip_id:trip_id  
                },
                success: function (response) {
                    $("#form_data").html(response.data);
                },
                error : function (response){
                    $("#form_data").html(response.responseJSON.error)
                }
            });
        }

        function calculate_contro(id=0){
           $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type:"post",
            url:"{{route('calculate_contro')}}",
            data:{
                trip_id : id
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
        
        function export_pdf(trip_id = 0){
            $.ajax({
                header:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type:"get",
            url:"{{route('export_pdf')}}",
            data:{
                trip_id :trip_id
            },
            success: function (response){

            },
            error: function (response){

            }
            });
        }
</script>
<!---table--->
@include('User.footer')