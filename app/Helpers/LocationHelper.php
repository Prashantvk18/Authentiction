<?php

if (!function_exists('getAddressFromCoordinates')) {
    function getAddressFromCoordinates($latitude, $longitude)
    {
        $apiKey = 'YOUR_GOOGLE_API_KEY';
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$latitude},{$longitude}&key={$apiKey}";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (!empty($data['results'][0])) {
            return $data['results'][0]['formatted_address'];
        }

        return 'Unknown Location';
    }
}
