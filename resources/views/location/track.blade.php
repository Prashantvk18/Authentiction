<!DOCTYPE html>
<html>
<head>
    <title>Live Location Tracking</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <input type="hidden" id="user_id" value = "{{$id}}">
    <h2>Your Location is Being Updated. Developed by Pranay Jain</h2>
    <div id="location-status" style="margin-top: 20px; font-weight: bold;"></div>
    <script>
      

        function sendLocation(lat, lng , userId) {
            fetch('/update-location', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    latitude: lat,
                    longitude: lng,
                    userId: userId
                   
                })
            }).then(response => response.json())
            .then(data => {
        console.log("Location sent:", data);
        // Display the status message on the page
        document.getElementById('location-status').innerText = "Status: " + (data.status || "Unknown response");
    })
    .catch(error => {
        console.error("Error sending location:", error);
        document.getElementById('location-status').innerText = "Error sending location";
    });
        }

        function getAndSendLocation() {
           var userId = document.getElementById("user_id").value;
         
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        sendLocation(position.coords.latitude, position.coords.longitude , userId);
                    },
                    (error) => {
                        console.error("Error getting location", error);
                    }
                );
            } else {
                alert("Geolocation is not supported.");
            }
//setTimeout(getAndSendLocation, 30000);
        }

        // Send immediately on page load
        getAndSendLocation();

        // Repeat every 20 minutes (1200000 ms)
      
       // setTimeout(getAndSendLocation, 30000);
       // setInterval(getAndSendLocation, 30000);
    </script>
</body>
</html>