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
    <style>
    /* Navbar improvements */

   
    .navbar {
        background-color: #63a4ba !important;
        padding: 10px 0;
    }

    .navbar-brand {
        font-family: 'Arial', sans-serif;
        color: #fff !important;
        font-weight: 700;
    }

    .navbar-nav .nav-link {
        font-size: 1.1rem;
        color: #f8f9fa !important;
        padding: 8px 16px;
    }

    .navbar-nav .nav-link:hover {
        color: #ffcc00 !important;
        background-color: transparent;
        transition: all 0.3s ease;
    }

    .navbar-nav .nav-item.active .nav-link {
        color: #ffcc00 !important;
        font-weight: bold;
    }

    .dropdown-menu {
        background-color: #0056b3;
        border: none;
    }

    .dropdown-item {
        color: #f8f9fa !important;
    }

    .dropdown-item:hover {
        background-color: #004085;
        color: #ffcc00 !important;
    }

    .navbar-toggler {
        border: none;
    }

    .navbar-toggler-icon {
        background-color: #fff;
    }

    /* Custom styles for larger screens */
    @media (min-width: 992px) {
        .navbar-nav {
            align-items: center;
        }
    }
</style>
</head>
<body> 
  <!-- Modal -->
 <!-- Modal -->
<div id="myModal" class="modal fade" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Blood Donation Camp Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Dynamically Injected Form -->
      <div class="modal-body" id="form_data">
        <!-- Form will be loaded here via AJAX -->
      </div>

      <div class="modal-footer">
        <button type="submit" form="bloodForm" class="btn btn-danger">Submit</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                        <li><a class="dropdown-item" href="/main_page">Blood</a></li>
                        <li><a class="dropdown-item" href="/expanse">Expanse</a></li>
                        <li><a class="dropdown-item" href="/trip_roadmap">Road Map</a></li>
                    </ul>
                    </li> 
            
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Log Out</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
 <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="get_formdata(0,0,0,0)">Add Event
        </button>


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
    <footer>
    <div class="footer-content">
        <p>Developed by <strong>Your Name</strong></p>
        <p>Contact: <a href="mailto:your-email@gmail.com">your-email@gmail.com</a></p>
    </div>
</footer>
<script>
function get_formdata(edit=0,view=0,d_id=0,trip_id=0) {       
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                type: "get",
                url: "{{ route('event_model')}}",
                data:{
                    edit:edit,
                    view:view, 
                    delete:d_id, 
                    trip_id:trip_id  
                },
                success: function (response) {
                    console.log(response.data);
                    $("#form_data").html(response.data);
                },
                error : function (response){
                    $("#form_data").html(response.responseJSON.error)
                }
            });
        }
        </script>
</body>
</html>