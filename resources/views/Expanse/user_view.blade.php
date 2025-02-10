@include('User.header')
<style>
    /* Style the container for tabs */
    .tabs {
      display: flex;
      cursor: pointer;
    }

    /* Style the tab buttons */
    .tab-button {
      padding: 10px 20px;
      background-color: #f1f1f1;
      border: 1px solid #ccc;
      margin-right: 5px;
      text-align: center;
    }

    /* Style the active tab */
    .active-tab {
      background-color: #3d98b1;
      color: white;
      font-weight: bold;
    }

    /* Style the tab content */
    .tab-content {
      display: none;
      padding: 20px;
      border-top: 1px solid #ccc;
    }

    /* Show the content of the active tab */
    .active-content {
      display: block;
    }
  </style>
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
<h4><strong>{{$trip_name->trip_name}}</strong></h4>
    

    <div class="tabs">
        <div class="tab-button active-tab" onclick="showTab(0)">Present User</div>
        @if($is_admin == 1)
        <div class="tab-button" onclick="showTab(1)">User's Request ({{count($user_pend_data)}})</div>
        @endif
    </div>

  <div class="tab-content active-content">
  <div class="table-responsive">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th style="width:150px;">User Name</th>
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
                        <td>{{$data->total_contro}}</td>
                        <td>{{$data->total_balance}}</td>
                        <?php
                        $balance = $data->total_balance- $data->total_contro;
                        ?>
                        <td @if(round($balance) > 0 ) style="color:red" @else style="color:green" @endif>{{$balance}}</td>
                        <td>
                            <button title="View Contro" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->id}},1,{{$data->trip_id}});"><i class="fa fa-eye"><i class="fa fa-wallet"></i></i></button>
                            @if($is_admin == 1)
                                <button title="Edit User" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" onclick="get_formdata1({{$data->id}},0,{{$data->trip_id}});"><i class="fa fa-edit"></i><i class="fa fa-user"></i></button>
                                <button title="Add Contro" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" onclick="get_formdata({{$data->id}},0,{{$data->trip_id}});"><i class="fa fa-plus"></i><i class="fa fa-wallet"></i></button>
                            @endif
                            <form action="{{url('export_user_expanse_pdf')}}" method = "get" class="d-inline-block mr-2">
                                <input type="hidden" value="{{$data->trip_id}}" name="tid">
                                <input type="hidden" value="{{$data->id}}" name="uid">
                                <button type="submit" name="Expanse PDF" class="btn btn-success btn-sm" vaue="1" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>   
                            </form>
                        </td>
                    </tr>
                    <?php $srno++ ?>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td style="color:red">Total :</td>
                    <td style="color:green">{{ round($total_contro) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ≈</td>
                    <td style="color:red">{{ round($total_expanse) }}</td>
                    <td></td>
                    <td></td>
            </tfoot>
        </table>
        @if($is_admin == 1)
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="get_split_formdata(0,0,{{$trip_id}})">Split Contro</button>
    @endif
        <form action="{{url('export_user_pdf')}}" method = "get" class="d-inline-block mr-2">
            <input value="{{$trip_id}}" style="display:none" name="tid">
            <button type="submit" class="btn btn-success btn-sm" vaue="1" >Generate Pdf</button>   
        </form>
    </div>
  </div>
  @if($is_admin == 1)
  <div class="tab-content">

  <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>  <input type="checkbox" id="select-all" class="select-all-checkbox" onclick="toggleSelectAll()"> Select All
                    </th>
                    <th>User Name</th>
                    <th>Request Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $srno = 1;
                      $total_contro = 0;
                      $total_expanse = 0;
                ?>
                @foreach($user_pend_data as $data)
                    <tr>
                        <td>
                        <input type="checkbox" name="selected_users[]" value="{{ $data->id }}" id="user_{{$data->id}}" class="user-checkbox">  
                        {{ $srno }}</td>
                        <td>{{$data->user_name}}</td>
                        <td>{{$data->add_date}}</td>
                        <td>
                            @if($is_admin == 1)
                                <button title="Accept User" type="button" class="btn btn-danger btn-sm"  onclick="acceptAll({{$data->id}});"><i class="fa fa-edit"></i><i class="fa fa-user"></i></button>
                            @endif
                        </td>
                    </tr>
                    <?php $srno++ ?>
                @endforeach
            </tbody>
        </table>
        @if($is_admin == 1)
            <input value="{{$trip_id}}" style="display:none" name="tid">
            <button type="submit" class="btn btn-success btn-sm" vaue="1" onclick = "acceptAll()" >Accept All</button> 
        @endif  
  </div>
</div>
@endif

    
</div>
<script>
        $(document).ready(function() {
        // Handle "Select All" checkbox click
        $('#select-all').click(function() {
            // Get the "Select All" checkbox state
            var isChecked = $(this).prop('checked');
            // Set the state of all checkboxes accordingly
            $('.user-checkbox').prop('checked', isChecked);
        });

        // Optional: Deselect the "Select All" checkbox if any individual checkbox is unchecked
        $('.user-checkbox').click(function() {
            // If all checkboxes are checked, check the "Select All" checkbox
            var allChecked = $('.user-checkbox').length === $('.user-checkbox:checked').length;
            $('#select-all').prop('checked', allChecked);
        });
    });
    function toggleSelectAll() {
      const checkboxes = $('.user-checkbox');
      const selectAllCheckbox = $('#select-all');
      checkboxes.prop('checked', selectAllCheckbox.prop('checked'));
  }

    function showTab(tabIndex) {
      // Get all tab buttons and content divs
      const tabButtons = document.querySelectorAll('.tab-button');
      const tabContents = document.querySelectorAll('.tab-content');

      // Remove active classes from all buttons and content
      tabButtons.forEach(button => button.classList.remove('active-tab'));
      tabContents.forEach(content => content.classList.remove('active-content'));

      // Add active class to the clicked button and corresponding content
      tabButtons[tabIndex].classList.add('active-tab');
      tabContents[tabIndex].classList.add('active-content');
    }
        function get_formdata1(edit=0,view=0,trip_id=0) {   
        event.preventDefault();    
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
                    $("#form_data").html(response.responseJSON.error)
                }
            });
            }


            function get_formdata(edit=0,view=0,trip_id=0) {  
                event.preventDefault();     
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
                        $("#form_data").html(response.responseJSON.error)
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
                        $("#form_data").html(response.responseJSON.error)
                    }
                });
            }



    function acceptAll(id=0) {
        const selectedUserIds = [];
        if(id == 0){
            const selectedCheckboxes = $('.user-checkbox:checked');
            if (selectedCheckboxes.length === 0) {
                alert("Please select at least one user.");
                return;
            }
            // Collect the selected user IDs
            
            selectedCheckboxes.each(function() {
                selectedUserIds.push($(this).val());
            });
        }
      // Send selected users to the server to update their status (via AJAX)
      $.ajax({
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
          url: "{{ url('acceptAll') }}",
          type: 'POST',
          data: {
              user_ids: selectedUserIds,
              id : id  // Set status as 'accepted'
          },
          success: function(response) {
            location.reload();
                $('#msg_div').show(); 
                $("#msg_success").html(response.message);
          },
          error: function(error) {
              console.error(error);
              alert('An error occurred.');
          }
      });
  }


</script>
@include('User.footer')