@include('User.header')
<style>
        /* Ensure the chart container is responsive */
        .chart-container {
            position: relative;
            width: 100%;
            max-width: 600px; /* You can adjust this to fit your needs */
            margin: 0 auto; /* Center the chart */
            padding: 20px;
        }

        /* Make sure the canvas takes up the full container width */
        canvas {
            width: 100% !important;
            height: auto !important;
        }

        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}



input {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    outline: none;
}

input:focus {
    border-color: #007bff;
}

button {
    
    padding: 12px;
    font-size: 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}


</style>
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

<div class="container">
        <!-- Chart container with the responsive class -->
        <span id="error_trip_uno" style="color:red"></span>
        <input type="text" id="trip_uno" placeholder="Enter Trip Number...">
        <button type="button" class="btn btn-lg btn-primary d-inline-block mr-2" data-toggle="modal" data-target="#myModal" style="width:100%"id="submitBtn" onclick="get_formdata()">Find Your Trip</button>
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center mt-5" style="font-family: 'Times New Roman', Times, serif;">Comparing Your Expanse vs Trip Expanse</h2>
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>  
            <div class="col-md-6">
                <h2 class="text-center mt-5" style="font-family: 'Times New Roman', Times, serif;">Top 5 trip Expanses</h2>
                <div class="chart-container">
                    <canvas id="myPieChart"></canvas>
                </div>
            </div>
        </div>
</div>

    <script>
        // Dynamic values and labels passed from Laravel Blade (replace these with dynamic data from Laravel)
        const labels = @json($labels);  // Pass labels from the controller
        const values = @json($values); // Static values for testing

        // Data for the Pie Chart
        const data = {
            labels: labels,  // Dynamic Labels
            datasets: [{
                label: 'My Pie Chart',
                data: values,  // Dynamic Data (Values)
                backgroundColor: ['red', 'blue', 'yellow' ,'orange' ,'pink'], // Colors for each segment
                hoverOffset: 4
            }]
        };

        // Configuration for the Pie Chart with reduced size
        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,  // Make the chart responsive
                maintainAspectRatio: false, // Allow custom size of the chart
                plugins: {
                    legend: {
                        position: 'top', // Position of the legend (top, bottom, etc.)
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw; // Custom label for tooltips
                            }
                        }
                    }
                }
            },
        };

        // Render the Pie Chart on the canvas element with ID "myPieChart"
        const myPieChart = new Chart(
            document.getElementById('myPieChart'),
            config
        );
    </script>
      <script>
        // Sample data (you can fetch these from the server)
        const labels1 = @json($labels1);
        const dataset1 = @json($dataset1); // First dataset (e.g., Sales 2023)
        const dataset2 = @json($dataset2);    // Second dataset (e.g., Sales 2024)

        // Create a vertical bar chart
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',  // 'bar' creates a vertical bar chart
            data: {
                labels: labels1,
                datasets: [
                    {
                        label: 'Trip Expanse',  // Label for the first dataset
                        data: dataset1,      // Data for the first dataset
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Color for the first dataset
                        borderColor: 'rgba(75, 192, 192, 1)',      // Border color for the first dataset
                        borderWidth: 1
                    },
                    {
                        label: 'Your Expanse',  // Label for the second dataset
                        data: dataset2,      // Data for the second dataset
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',  // Color for the second dataset
                        borderColor: 'rgba(153, 102, 255, 1)',      // Border color for the second dataset
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true  // Ensure bars start from zero on the Y-axis
                    },
                    x: {
                        beginAtZero: true  // Ensure bars are positioned correctly along the X-axis
                    }
                }
            }
        });

        function get_formdata() {   
        var trip_uno = $("#trip_uno").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            type: "get",
            url: "{{ route('user_trip_request') }}",
            data:{
                trip_uno: trip_uno, 
            },
            success: function (response) {
                console.log(response.data);
                $("#form_data").html(response.data);
            },
            error: function (response){
                console.log(response.responseJSON.errors);
                $("#form_data").html(response.responseJSON.errors);
                $("#error_trip_uno").html(response.responseJSON.errors)
               
            }
        });
    }
    </script>




@include('User.footer')



