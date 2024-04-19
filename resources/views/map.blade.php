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
            margin-bottom: 20px;
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
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="mt-5 mb-4">Locator Map</h1>
    <!-- Dropdown for city selection -->
    <select id="cityDropdown" class="form-select mb-3">
        <option value="0">Select City</option>
        <option value="Parañaque">Parañaque</option>
        <option value="Taguig">Taguig</option>
        <option value="Muntinlupa">Muntinlupa</option>
    </select>
    <!-- Dropdown for barangay selection -->
    <select id="barangayDropdown" class="form-select mb-3">
        <option value="0">Select Barangay</option>
        <!-- Options will be added dynamically based on city selection -->
    </select>
    <!-- Map container -->
    <div id="map"></div>
    <div id="address"></div>
    <button onclick="getCurrentLocation()" class="btn btn-primary mt-3">Show My Location</button>
</div>

<!-- Leaflet library -->
<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    var map;
    var highlightedLayer;
    var barangayHalls = [
        // Barangay hall coordinates for Parañaque and Taguig
        { name: "Baclaran Barangay Hall", coordinates: [14.512048954227579, 121.00547330128374] },
        { name: "Don Bosco Barangay Hall", coordinates: [14.482341504862227, 121.03751305719334] },
        { name: "La Huerta Barangay Hall", coordinates: [14.500708570342768, 120.99126755919006] },
        // Add more barangay halls for Parañaque as needed

        { name: "Bagumbayan Barangay Hall", coordinates: [14.474246015393044, 121.059194598432] },
        { name: "Barangay Hall 2 Taguig", coordinates: [14.5292, 121.0726] },
        { name: "Barangay Hall 3 Taguig", coordinates: [14.5258, 121.0833] },
        // Add more barangay halls for Taguig as needed

        { name: "Alabang Barangay Hall", coordinates: [14.4075, 121.0458] },
        { name: "Barangay Hall 2 Muntinlupa", coordinates: [14.5292, 121.0726] },
        { name: "Barangay Hall 3 Muntinlupa", coordinates: [14.5258, 121.0833] },
        // Add more barangay halls for Muntinlupa as needed
    ];

    var parañaqueSchools = [
        // Schools in Parañaque
        { name: "Don Bosco High School Parañaque", coordinates: [14.479765875103071, 121.02097555208802] },
        { name: "Asian Institute of Computer Studies Bicutan", coordinates: [14.485366128561008, 121.04071023670782] },
        // Add more schools for Parañaque as needed
    ];

    var taguigSchools = [
        // Schools in Taguig
      
        // Add more schools for Taguig as needed
    ];

    var muntinlupaSchools = [
        // Schools in Muntinlupa
    ];
    function getCurrentLocation() {
       // Geolocation code
       resetMap();
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Center the map on the user's current position
            map.setView([latitude, longitude], 13);

            // Create a custom marker icon for the user's location
            var humanIcon = L.icon({
                iconUrl: '{{ asset('image/location.png') }}', // Path to the human marker icon using asset helper
                iconSize: [40, 40], // Size of the icon
                iconAnchor: [20, 40], // Anchor point of the icon
                popupAnchor: [0, -40] // Popup anchor point
            });

            // Add a marker to the map at the user's current position with the custom icon
            L.marker([latitude, longitude], { icon: humanIcon }).addTo(map)
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

    // City dropdown change event
    document.getElementById('cityDropdown').addEventListener('change', function() {
        var selectedCity = this.value;
        var barangayDropdown = document.getElementById('barangayDropdown');
        // Clear existing options
        barangayDropdown.innerHTML = '<option value="0">Select Barangay</option>';
        // Add options based on selected city
        if (selectedCity === 'Parañaque') {
            addBarangaysToDropdown(['Baclaran', 'Don Bosco', 'La Huerta', 'San Dionisio', 'San Isidro', 'San Martin de Porres', 'San Antonio', 'San Juan', 'San Miguel', 'Santo Niño', 'Sun Valley', 'Tambo', 'Vitalez', 'Don Galo', 'Merville', 'Moonwalk', 'Santa Rita', 'Marcelo Green Village', 'BF Homes']);
        } else if (selectedCity === 'Taguig') {
            addBarangaysToDropdown(['Bagumbayan', 'Barangay 2', 'Barangay 3', 'Barangay 4', 'Barangay 5', 'Barangay 6', 'Barangay 7', 'Barangay 8', 'Barangay 9', 'Barangay 10', 'Barangay 11', 'Barangay 12', 'Barangay 13', 'Barangay 14', 'Barangay 15']);
        } else if (selectedCity === 'Muntinlupa') {
            addBarangaysToDropdown(['Alabang', 'Barangay 2', 'Barangay 3', 'Barangay 4', 'Barangay 5', 'Barangay 6', 'Barangay 7', 'Barangay 8', 'Barangay 9', 'Barangay 10', 'Barangay 11', 'Barangay 12', 'Barangay 13', 'Barangay 14', 'Barangay 15']);
        }
    });

    // Function to add barangays to dropdown
    function addBarangaysToDropdown(barangays) {
        var barangayDropdown = document.getElementById('barangayDropdown');
        barangays.forEach(function(barangay) {
            var option = document.createElement('option');
            option.text = barangay;
            option.value = barangay;
            barangayDropdown.add(option);
        });
    }

    // Barangay dropdown change event
    document.getElementById('barangayDropdown').addEventListener('change', function() {
        var selectedBarangay = this.value;
        var selectedCity = document.getElementById('cityDropdown').value;
        // Update map view based on selected barangay and city
        if (selectedCity === 'Parañaque') {
            // Handle Parañaque barangays
            var selectedSchools = parañaqueSchools; // Schools for Parañaque
            highlightBarangay(selectedBarangay);
            addSchoolMarkers(selectedSchools);
        } else if (selectedCity === 'Taguig') {
            // Handle Taguig barangays
            var selectedSchools = taguigSchools; // Schools for Taguig
            highlightBarangay(selectedBarangay);
            addSchoolMarkers(selectedSchools);
        }
        else if (selectedCity === 'Muntinlupa') {
            // Handle Taguig barangays
            var selectedSchools = muntinlupaSchools; // Schools for Taguig
            highlightBarangay(selectedBarangay);
            addSchoolMarkers(selectedSchools);
        }
    });

    // Initialize the map using Leaflet.js (OpenStreetMap)
    map = L.map('map').setView([14.5186, 121.0195], 12); // Default center coordinates for Parañaque

    // Add a tile layer using Leaflet.js (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Function to highlight a barangay on the map
    function highlightBarangay(barangayName) {
        var selectedBarangayHall = barangayHalls.find(hall => hall.name.includes(barangayName));
        if (selectedBarangayHall) {
            L.marker(selectedBarangayHall.coordinates).addTo(map)
                .bindPopup(selectedBarangayHall.name)
                .openPopup();
        }
    }

    // Reset map function
    function resetMap() {
        map.eachLayer(function (layer) {
            if (layer instanceof L.Marker) {
                map.removeLayer(layer);
            }
        });
    }

    // Add markers for schools
    function addSchoolMarkers(schoolsArray) {
        schoolsArray.forEach(function(school) {
        // Create a custom red marker icon
        var redIcon = L.icon({
            iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            tooltipAnchor: [16, -28],
            shadowSize: [41, 41]
        });

        // Add marker to the map using the custom red icon
        L.marker(school.coordinates, { icon: redIcon }).addTo(map)
            .bindPopup(school.name);
    });
    }

</script>

</body>
</html>
