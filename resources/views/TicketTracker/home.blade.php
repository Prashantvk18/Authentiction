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
    <div class="tabs">
        <div class="tab-button active-tab" onclick="showTab(0)">Task</div>
        <div class="tab-button" onclick="showTab(1)">Assigned</div>
        <div class="tab-button" onclick="showTab(2)">completed</div>
    </div>

  <div class="tab-content active-content">
  <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Ticket No</th>
                    <th>Subject</th>
                    <th>Assigned By</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $srno = 1;
                ?>
                @foreach($ticket_data as $ticket_data)
                @if($ticket_data->status == 'P')
                    <tr>
                        <td>{{$srno }}</td>
                        <td>{{$ticket_data->id}}</td>
                        <td>{{$ticket_data->subject}}</td>
                        <td>{{$assign_by[$ticket_data->assign_by]}}</td>
                        <td>@if($ticket_data->status == 'P') Pending @elseif($ticket_data->status == 'D') Done @elseif($ticket_data->status == 'C') Closed @endif </td>
                        
                        <td>
                        <form action="{{ route('ticket_view', ['id' => $ticket_data->id]) }}" method="get" class="d-inline-block mr-2">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-block btn-sm"><i class="fa fa-eye"></i><i class="fa fa-user"></i></button>
                                </form>
                           
                        </td>  
                    </tr>
                    <?php $srno++ ?>
                    @endif
               @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick = "create_ticket(0,0,0)">Create Ticket</button>
    </div>
  </div>
    <div class="tab-content">
        <div class="table-responsive">
            <table class="table table-hover">
            <?php $srno = 1;
                ?>
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th style="width:150px;">Ticket No</th>
                        <th>Subject</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assigned_ticket as $assigned_ticket)
                    <tr>
                    <td>{{$srno }}</td>
                    <td>{{$assigned_ticket->id}}</td>
                    <td>{{$assigned_ticket->subject}}</td>
                    <td>{{$assign_by[$assigned_ticket->assign_to]}}</td>
                    <td>@if($assigned_ticket->status == 'P') Pending @elseif($assigned_ticket->status == 'D') Done @elseif($assigned_ticket->status == 'C') Closed @endif </td>
                    <td>
                            <button title="View Contro" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" ><i class="fa fa-eye"><i class="fa fa-wallet"></i></i></button>
                           
                        </td>  
                    </tr>
                    
                    <?php $srno++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-content">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <?php $srno = 1;
                ?>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Ticket No</th>
                        <th>Subject</th>
                        <th>Assigned By</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ticket_data1 as $ticket_data)
                        @if($ticket_data->status == 'D')
                            <tr>
                                <td>{{$srno }}</td>
                                <td>{{$ticket_data->id}}</td>
                                <td>{{$ticket_data->subject}}</td>
                                <td>{{$assign_by[$ticket_data->assign_by]}}</td>
                                <td>Done </td>
                                <td>
                                    <button title="View Contro" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" ><i class="fa fa-eye"><i class="fa fa-wallet"></i></i></button>
                                
                                </td>  
                            </tr>
                            <?php $srno++ ?>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
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
        function create_ticket(edit=0,view=0,ticket_id=0) {   
        event.preventDefault();    
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                type: "get",
                url: "{{ url('create_ticket_model')}}",
                data:{
                    edit:edit,
                    view:view,
                    ticket_id:ticket_id
                },
                success: function (response) {
                    $("#form_data").html(response.data);
                },
                error : function (response){
                    $("#form_data").html(response.responseJSON.error)
                }
            });
            }


</script>
@include('User.footer')