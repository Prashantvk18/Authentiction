<!DOCTYPE html>
<html>
<head>
    <title>Live Location Tracking</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Your Location is Being Updated Every 20 Minutes</h2>

    <script>
      

        function sendLocation(lat, lng) {
            fetch('/update-location', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    latitude: lat,
                    longitude: lng,
                   
                })
            }).then(response => response.json())
              .then(data => console.log("Location sent:", data));
        }

        function getAndSendLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        sendLocation(position.coords.latitude, position.coords.longitude);
                    },
                    (error) => {
                        console.error("Error getting location", error);
                    }
                );
            } else {
                alert("Geolocation is not supported.");
            }
            setTimeout(getAndSendLocation, 30000);
        }

        // Send immediately on page load
        getAndSendLocation();

        // Repeat every 20 minutes (1200000 ms)
      
       // setTimeout(getAndSendLocation, 30000);
       // setInterval(getAndSendLocation, 30000);
    </script>
</body>
</html>
