<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locator Map</title>
    <!-- Leaflet CSS -->
    <link href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        #address {
            font-size: 1.1rem;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="mt-5 mb-4">Locator Map</h1>
    <!-- Map container -->
    <div id="map"></div>
    <div id="address"></div>
    <button onclick="getCurrentLocation()" class="btn btn-primary mt-3">Show My Location</button>
</div>

<!-- Leaflet library -->
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    var map;

    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                // Center the map on the user's current position
                map.setView([latitude, longitude], 13);

                // Add a marker to the map at the user's current position
                L.marker([latitude, longitude]).addTo(map)
                    .bindPopup('You are here!')
                    .openPopup();

                // Get the full address using reverse geocoding
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
                    .then(response => response.json())
                    .then(data => {
                        var address = data.display_name;
                        document.getElementById('address').innerText = 'Address: ' + address;
                    })
                    .catch(error => {
                        console.error('Error fetching address:', error);
                    });
            }, function() {
                // Handle errors when accessing geolocation
                alert('Error: The Geolocation service failed.');
            });
        } else {
            // Browser doesn't support Geolocation
            alert('Error: Your browser does not support Geolocation.');
        }
    }

    // Initialize the map using Leaflet.js (OpenStreetMap)
    map = L.map('map').setView([0, 0], 2);

    // Add a tile layer using Leaflet.js (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
</script>

</body>
</html>
