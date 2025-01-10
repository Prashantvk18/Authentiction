<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('Extra/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('Extra/select2.min.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <!---https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css   below--->
    <link rel="stylesheet" href="{{ asset('Extra/bootstrap.min.css') }}">
    <!---<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  below--->
    <script src="{{ asset('Extra/bootstrap.min.js') }}"></script>
    <!---<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        .hidden {
            display: none;
        }
        .filter {
            padding : 3px;
        }
    </style>
</head>
<body> 
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
    <?php
    $fil_opt = ['Donar_name' => 'Name:' , 'mobile_no' => 'Mobile No:' , 'address' => 'Address' , 'gender' => 'Gender' , 'is_success' => 'Status' ,'blood_grp' => 'Blood Group'];
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/ticketview">Add Ticket</a>
                    </li>
                    <!-- <li>
                        <a class="nav-link" href="/csv_view">Create CSV</a>
                    </li>
                    <li>
                        <a class="nav-link" href="/vapt_index">VAPT</a>
                    </li>
                    <li>
                        <a class="nav-link" href="/blood">Blood</a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="/csv_view">Create CSV</a></li>
                            <li><a class="dropdown-item" href="/vapt_index">VAPT</a></li>
                            <li><a class="dropdown-item" href="/blood">Blood</a></li>
                        </ul>
                    </li> 
            
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Log Out</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-8">
                <form action="{{url('blood')}}" method='get'>
                @csrf
                    <div class="col-md-2 col-sm-2 filter">
                        <div class="form-group">
                            <select id="typeSelect" name="filter_name" class="form-control">
                                @foreach($fil_opt as $key=>$value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <div class="col-md-2 col-sm-2 filter">
                        <div class="form-group">
                            <div id="dynamicFieldContainer">
                                <input type="text" name="filter_value" class="form-control" id="dynamicTextField" placeholder="Enter text here"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 filter">
                        <div class="form-group" style="margin-top: -25px;">
                                <label for="frm_date">From Date:</label>
                                <input type="date" name="frm_date" class="form-control" id="frm_date" placeholder="From Date" />
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 filter">
                        <div class="form-group" style="margin-top: -25px;">
                                <label for="to_date">To Date:</label>
                                <input type="date" name="to_date"class="form-control" id="to_date" placeholder="To Date" />
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-1 filter"  >
                        <input type="checkbox" name="gainer_view"  >
                        <label for="gainer_view">Gainer View</label>
                    </div>
                    <div class="col-md-1 col-sm-1 filter"  style="width: 62px;">
                        <button type="submit" class="btn btn-info" value='1' name='check_default'>Filter</button>
                    </div>
                    <div class="col-md-1 col-sm-1 filter"  style="width: 68px;">
                        <a href="/blood" class="btn btn-warning">Reset</a>
                    </div>
                    
                </form>
            </div>
            
            
            <div class="col-md-1 col-sm-2 filter">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="add_donor()">+ Add Donar</button>
                
            </div>
            <div class="col-md-1 col-sm-2 filter" style="width: 62px;">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="add_donor(0,0,0,1)">+ Add Gainer</button>
            </div>
            <!-- <div class="col-md-1 col-sm-2">
                <a onClick = 'export_pdf();' class="btn btn-success">Export to PDF</a>
            </div> -->
        </div>
        <p><span style="color:blue">Total Record :{{$count['data_total_count']}} &nbsp;</span>
        @if($is_gainer == 0)<span style="color:green"> Success:{{$count['success_count']}}&nbsp;&nbsp;</span>  <span style="color:red"> Reject : {{$count['reject_count']}}&nbsp;&nbsp;</span>
        <span style="color:purple"> Pending : {{$count['pending_count']}} </span>@endif</p>
        <table id="blood_data_table" class="table table-hover">
            <thead>
                <tr>
                <th>Sr. No</th>
                    <th>@if($is_gainer == 0)Donar Name @else Patient Name @endif</th>
                    <th>Mobile No.</th>
                    <th>Gender</th>
                    <th>Blood Group</th>
                    <th>Date</th>
                    <th>@if($is_gainer == 0)Status @else Hospital @endif</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $srno = 0?>
                
                @foreach( $blood_data as $data)
                <tr>
                <td>{{$blood_data->firstItem() + $srno }}</td>
                <td>{{$data->Donar_name}}</td>
                <td>{{$data->mobile_no}}</td>
                <td>{{$data->gender}}</td>
                <td>{{$data->blood_grp}}</td>
                <td>{{$data->created_at->format('d-m-Y')}}</td>
                @if($is_gainer == 1)
                <td>{{$data->hospital}}</td>
                @else
                <td
                style = "color  : 
                @if($data->is_success == 'S') green @elseif($data->is_success == 'R') red @else purple @endif"
                >@if($data->is_success == 'S') Success @elseif($data->is_success == 'R') Reject @else Pending @endif </td>
                @endif
                <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" onclick="add_donor({{$data->id}},1,0,@if($is_gainer == 1) 1 @else 0 @endif);">View</button>
                    @if($is_admin == 1)
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="add_donor({{$data->id}},0,0,@if($is_gainer == 1) 1 @else 0 @endif);">Edit</button>
                    <button type="button" class="btn btn-danger"  onclick="add_donor(0,0,{{$data->id}},0);">Delete</button>
                    @endif
                </td>
                <tr>
                <?php $srno++ ?>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-4">
                {{$blood_data->links()}}
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-2"></div>
            <div class="col-md-2">
                    <form action="{{url('blood')}}" method='get'>
                    @if($is_admin == 1)
                            @if(($is_gainer) == 1 )
                                <input type="text" class="hidden" value="1" name = "gainer_view" >
                            @endif
                            <button type="submit" name="export_pdf" value="1" class="btn btn-success">Export to PDF</button>
                        
                    @endif
                    </form>
            </div>  
        </div>
    </div>
    <style>
  footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px;
    position: relative;
    bottom: 0;
    width: 100%;
    font-family: Arial, sans-serif;
}

.footer-content {
    max-width: 600px; /* Ensures content does not stretch too wide on large screens */
    margin: 0 auto;
}

.footer-content a {
    color: #FFD700; /* Gold color for the email link */
    text-decoration: none;
}

.footer-content a:hover {
    text-decoration: underline;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    footer {
        padding: 15px; /* Slightly reduced padding on smaller screens */
    }

    .footer-content {
        padding: 10px;
        font-size: 14px; /* Slightly smaller font on smaller devices */
    }
}

</style>
<br>
<footer>
    <div class="footer-content">
        <p>Developed by <strong>Your Name</strong></p>
        <p>Contact: <a href="mailto:your-email@gmail.com">your-email@gmail.com</a></p>
    </div>
</footer>

</body>
</html>

</body>
</html>
<script>
    $(document).ready(function(){
        $("#typeSelect").on('change' , function(){
            
            var selectedvalue = $(this).val();
            var $container =$('#dynamicFieldContainer');

            $container.empty();

            if(selectedvalue === 'blood_grp'){
                
                var $selected = $('<select id="dynamicDropdown" class="form-control" multiple name="filter_value[]">' +
                                    '<option value="A+">A+</option>' +
                                    '<option value="B+">B+</option>' +
                                    '<option value="O+">O+</option>' +
                                    '<option value="AB-">AB-</option>' +
                                    '<option value="AB+">AB+</option>' +
                                    '<option value="O-">O-</option>' +
                                    '<option value="B-">B-</option>' +
                                    '<option value="A-">A-</option>' +
                                    '</select>');
                $container.append($selected);
                var $input = $("#dynamicDropdown");
                $input.select2();
            }else if (selectedvalue == 'is_success'){
                var $gen_selected = $('<select id="dynamicDropdown" name="filter_value" class="form-control">' +
                                    '<option value="S">Success</option>' +
                                    '<option value="R">Reject</option>' +
                                    '<option value="N">Pending</option>' +
                                    '</select>');
                $container.append($gen_selected);
            }else if (selectedvalue == 'gender'){
                var $gen_selected = $('<select id="dynamicDropdown" name="filter_value" class="form-control">' +
                                    '<option value="M">Male</option>' +
                                    '<option value="F">Female</option>' +
                                    '<option value="O">Other</option>' +
                                    '</select>');
                $container.append($gen_selected);
            }else  {
                    var $input = $('<input type="text" class="form-control" id="dynamicTextField" name="filter_value" placeholder="Enter text here"/>');
                    $container.append($input);
                }
                $container.toggleClass('hidden', $container.children().length === 0);
        });
    });

    function add_donor(edit=0 , view = 0 , del = 0 , gainer = 0) {
        if(del>0){
            var confirmation = confirm("Are you sure you want to delete this item?");
        }
        if (!confirmation && del > 0) {
            return false;
        } 
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: "get",
            url:"{{url('blood_modal')}}",
            data:{
                edit : edit,
                view : view,
                del  : del,
                gainer : gainer
            },
            success:function( result){
                if(del > 0){
                    location.reload();
                }
                $("#form_data").html(result.data);
            },
            error:function (result){

            }
        })
    }

    function table(edit=0 , view = 0 , del = 0) {
        if(del>0){
            var confirmation = confirm("Are you sure you want to delete this item?");
        }
        if (!confirmation && del > 0) {
            return false;
        } 
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: "get",
            url:"{{url('blood_modal')}}",
            data:{
                edit : edit,
                view : view,
                del  : del,
            },
            success:function( result){
                if(del > 0){
                    location.reload();
                }
                $("#form_data").html(result.data);
            },
            error:function (result){

            }
        })
    }


   

</script>

