@include('User.header')

<div class="cointainer">

  <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onclick="get_formdata()">Add Ticket</button>

<form action="{{ url('ticketview')}}" method='get'>
    @csrf
    <div class="container" style=" float: inline-end;">
        <input type="hidden" value='1' name='check_default'>
        <input  type="text" name="search_id" placeholder="Search by ticket no" id="search_id" value="{{ $search_id !=''? $search_id : '' }}">
        @error('search_id')
        <span class="text-danger">{{$message}}</span>
        @enderror
        <button type="submit" class = "btn btn-info btn-sm">Search</button>
    </div>
</form>
</br>
@php 
    if($count > 0){
       echo "<h5 style='color:olivedrab; margin-left:10%; text-style:bold'><b>Count : $count</b></h5>";
    }else{
        echo "<span style='color:red; margin-left:10%; text-style:bold'>No Data Found</span>";
    }
@endphp

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

</div>
<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Ticket Id</th>
                <th style="width:450px;">Subject</th>
                <th>Recieve From</th>
                <th>Forword To</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $data)
            <tr @if(isset($data->forword_to)) style="background-color:#B6F3B9" @endif>
                <td>{{$data->ticket_no}}</td>
                <td>{{$data->ticket_sub}}</td>
                <td>{{$data->receive_from}}</td>
                <td>{{$data->forword_to}}</td>
                <td>{{$data->start_date}}</td>
                <td>{{$data->End_date}}</td>
                <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->id}},0,0)">Edit</button>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->id}},1,0)">View</button>
               <!--- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->id}},0,1)">Delete</button>--->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    </div>
    {{ $datas->links() }}

<script>
    function get_formdata(edit=0,view=0,deletes=0) {

        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: "get",
            url: "{{ route('add_ticket')}}",
            data:{
                edit:edit,
                view:view,    
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



