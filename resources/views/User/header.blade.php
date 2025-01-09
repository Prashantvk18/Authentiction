<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}">
    </script><script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!---https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css   below--->
    <link rel="stylesheet" href="{{ asset('Extra/bootstrap.min.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
   <!---<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  below--->
   <script src="{{ asset('Extra/bootstrap.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!---<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">--->
    <!---<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--->
    <!---<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>--->
    <link href="{{ asset('Extra/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('Extra/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        .hidden {
            display: none;
        }
        @media (max-width: 768px) {
        .table th, .table td {
            padding: 8px;
        }
    }
    </style>
   
</head>
<body> 
    
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

