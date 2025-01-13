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

    

</style>
<div class="container">
        <!-- Chart container with the responsive class -->
        <div class="row">
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
                backgroundColor: ['red', 'blue', 'yellow'], // Colors for each segment
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


@include('User.footer')



