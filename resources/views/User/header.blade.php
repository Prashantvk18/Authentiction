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

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<div class="content">
<nav class="navbar navbar-expand-lg navbar-dark  shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fs-3 fw-bold" href="/profile_view">Hello {{ Str::words(Session::get('user_name'),2, '...')}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="background-color: #30536a;"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ticketview">Add Ticket</a>
                </li>

                <!-- Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Module
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/csv_view">Create CSV</a></li>
                        <li><a class="dropdown-item" href="/vapt_index">VAPT</a></li>
                        @if(Session::get('is_admin') == 1 or Session::get('is_admin') == 2 )
                        <li><a class="dropdown-item" href="/blood">Blood</a></li>
                        @endif
                        @if(Session::get('is_admin') == 1 or Session::get('is_admin') == 3 )
                        <li><a class="dropdown-item" href="/ticket_tracker">TicketTracker</a></li>
                        @endif
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

<!-- Additional Styles -->
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


