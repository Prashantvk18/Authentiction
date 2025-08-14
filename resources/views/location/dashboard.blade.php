@include('User.header')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f9f9f9;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
            text-transform: uppercase;
        }
        tr:hover {
            background-color: #f1f7ff;
        }
        .copy-btn {
            cursor: pointer;
            margin-left: 8px;
            color: #007bff;
            transition: color 0.3s;
        }
        .copy-btn:hover {
            color: #0056b3;
        }

        /* Responsive styles */
        @media (max-width: 600px) {
            table, thead, tbody, th, td, tr { 
                display: block; 
            }
            thead tr {
                /* Hide header row */
                display: none;
            }
            tr {
                margin-bottom: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 15px;
                background: white;
                box-shadow: 0 1px 4px rgba(0,0,0,0.1);
            }
            td {
                /* Full width */
                border: none;
                padding-left: 50%;
                text-align: left;
                position: relative;
                font-size: 14px;
                line-height: 1.4em;
            }
            td::before {
                /* Labels before data */
                content: attr(data-label);
                position: absolute;
                left: 15px;
                top: 15px;
                font-weight: bold;
                color: #333;
                white-space: nowrap;
            }
            .copy-btn {
                margin-left: 0;
                float: right;
                margin-top: 3px;
            }
        }
    </style>

<button onclick="window.history.back();" class="btn btn-outline-primary">← Go Back</button>
<h2>Friends' Latest Locations</h2>
<a href="https://gps-coordinates.org/coordinate-converter.php" target="_blank">At this link you can get exact location </a>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Last Updated</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($locations as $loc)
        <tr>
            <td data-label="User ID">{{ $loc->name }}</td>
            <td data-label="Latitude">
                <span id="text-to-copy_lat_{{ $loc->user_id }}">{{ $loc->latitude }}</span>
                <i class="fa fa-copy copy-btn" title="Copy Latitude" onclick="copyText('lat_{{ $loc->user_id }}')"></i>
            </td>
            <td data-label="Longitude">
                <span id="text-to-copy_lon_{{ $loc->user_id }}">{{ $loc->longitude }}</span>
                <i class="fa fa-copy copy-btn" title="Copy Longitude" onclick="copyText('lon_{{ $loc->user_id }}')"></i>
            </td>
            <td data-label="Last Updated">
                {{ \Carbon\Carbon::parse($loc->updated_at)->diffForHumans() }}
            </td>

            <td data-label="Address" id="address_{{ $loc->user_id }}">
            <!-- Address will appear here -->
            <button onclick="reverseGeocode({{ $loc->latitude }}, {{ $loc->longitude }}, {{ $loc->user_id }})">Show Address</button>
        </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>

function reverseGeocode(lat, lon, userId) {
    const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            console.log('Address:', data.display_name);
            // Update the address cell for this user
            document.getElementById('address_' + userId).innerText = data.display_name;
        })
        .catch(error => {
            console.error('Reverse geocoding error:', error);
            document.getElementById('address_' + userId).innerText = "Error fetching address";
        });
}


function copyText(typeAndId) {
    let id = "text-to-copy_" + typeAndId;
    let textElement = document.getElementById(id);
    if (!textElement) {
        alert("Element not found!");
        return;
    }
    let text = textElement.innerText;
    navigator.clipboard.writeText(text).then(() => {
        alert('Copied: ' + text);
    }).catch(() => {
        alert('Failed to copy');
    });
}
</script>
@include('User.footer')
