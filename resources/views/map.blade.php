<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locator Map</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
    <div class="mb-2 flex flex-wrap justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="hover:bg-gray-100 text-blue-500 py-2 px-4 ">Go to Dashboard</a>

        </div>
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
        { name: "San Dionisio Barangay Hall", coordinates: [14.486140351006505, 120.99163465550478] },
        { name: "San Isidro Barangay Hall", coordinates: [14.46936606882816, 121.01122898628086] },
    { name: "San Martin de Porres Barangay Hall", coordinates: [14.494507111069916, 121.04229919384156] },
    { name: "San Antonio Barangay Hall", coordinates: [14.469541966154063, 121.02412864564593] },
    { name: "Santo Niño Barangay Hall", coordinates: [14.503053599085195, 120.99735806852621] },
    { name: "Sun Valley Barangay Hall", coordinates: [14.488351663675717, 121.0370207427992] },
    { name: "Tambo Barangay Hall", coordinates: [14.515357554444432, 120.99318789366357] },
    { name: "Vitalez Barangay Hall", coordinates: [14.508294939725296, 121.00615304712613] },
    { name: "Don Galo Barangay Hall", coordinates: [14.505417788679468, 120.99118538201954] },
    { name: "Merville Barangay Hall", coordinates: [14.500212960950453, 121.02633460208392] },
    { name: "Moonwalk Barangay Hall", coordinates: [14.495372020627217, 121.01074943733265] },
    { name: "Marcelo Green Village Barangay Hall", coordinates: [14.47647155448698, 121.04008086546241] },
    { name: "BF Homes Barangay Hall", coordinates: [14.446077762006897, 121.02727803459011] },

        
        // Add more barangay halls for Parañaque as needed
        { name: "Bagumbayan Barangay Hall", coordinates: [14.474246015393044, 121.059194598432] },
        { name: "Bambang Barangay Hall", coordinates: [14.52594804597349, 121.07297053111895] },
        { name: "Calzada Barangay Hall", coordinates: [14.533819710716877, 121.07996011577862] },
        { name: "Central Bicutan Barangay Hall", coordinates: [14.493137289324427, 121.0541246662207] },
        { name: "Central Signal Village Barangay Hall", coordinates: [14.511594715049993, 121.05653263599561] },
        { name: "Fort Bonifacio Barangay Hall", coordinates: [14.526257243286665, 121.02676274732188] },
        { name: "Hagonoy Barangay Hall", coordinates: [14.514546147547202, 121.06040718076763] },
        { name: "Ibayo-Tipas Barangay Hall", coordinates: [14.542124479475271, 121.08461441470406] },
        { name: "Katuparan Barangay Hall", coordinates: [14.521744324253872, 121.05839653539337] },
        { name: "Ligid-Tipas Barangay Hall", coordinates: [14.543105809759323, 121.0800680877149] },
        { name: "Lower Bicutan Barangay Hall", coordinates: [14.489770676360623, 121.06238595957377] },
        { name: "Maharlika Village Barangay Hall", coordinates: [14.499563707313598, 121.05315458495025] },
        { name: "Napindan Barangay Hall", coordinates: [14.541915041709414, 121.09595085887972] },
        { name: "New Lower Bicutan Barangay Hall", coordinates: [14.50617996839134, 121.0654730784144] },
        { name: "North Daang Hari Barangay Hall", coordinates: [14.486929897331429, 121.04799903951044] },
        { name: "North Signal Village Barangay Hall", coordinates: [14.515862668454709, 121.05554727828344] },
        { name: "Palingon Barangay Hall", coordinates: [14.538827251033425, 121.07999099715546] },
        { name: "Pinagsama Barangay Hall", coordinates: [14.523900337659201, 121.0556388374284] },
        { name: "San Miguel Barangay Hall", coordinates: [14.560790423635092, 121.04937558904383] },
        { name: "Santa Ana Barangay Hall", coordinates: [14.547747120979707, 121.07164219561713] },
        { name: "South Daang Hari Barangay Hall", coordinates: [14.472433244551697, 121.04859117429278] },
        { name: "South Signal Village Barangay Hall", coordinates: [14.507676050100171, 121.0532722772929] },
        { name: "Tanyag Barangay Hall", coordinates: [14.47884587837071, 121.0494138335467] },
        { name: "Tuktukan Barangay Hall", coordinates: [14.528938285904168, 121.07160047553386] },
        { name: "Upper Bicutan Barangay Hall", coordinates: [14.498044980952873, 121.05007530305548] },
        { name: "Ususan Barangay Hall", coordinates: [14.536704808936241, 121.06857762987603] },
        { name: "Wawa Barangay Hall", coordinates: [14.523510108703178, 121.07520438393692] },
        { name: "Western Bicutan Barangay Hall", coordinates: [14.509909045782466, 121.03808731311645] },

        // Add more barangay halls for Taguig as needed

        { name: "Alabang Barangay Hall", coordinates: [14.421088886374685, 121.04414120129854] },
        { name: "Bayanan Barangay Hall", coordinates: [14.413352858198134, 121.05211587870588] },
        { name: "Cupang Barangay Hall", coordinates: [14.439959994061104, 121.05047131382794] },
        { name: "New Alabang Barangay Hall", coordinates: [14.422538709057255, 121.04460156629385] },
        { name: "Poblacion Barangay Hall", coordinates: [14.397137356246867, 121.0492184698046] },
        { name: "Putatan Barangay Hall", coordinates: [14.39720673477013, 121.04841768200652] },
        { name: "Sucat Barangay Hall", coordinates: [14.458037011071513, 121.05389792773003] },
        { name: "Tunasan Barangay Hall", coordinates: [14.379459516707438, 121.04836952721334] },

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
            addBarangaysToDropdown(['Baclaran', 'Don Bosco', 'La Huerta', 'San Dionisio', 'San Isidro', 'San Martin de Porres', 'San Antonio', 'Santo Niño', 'Sun Valley', 'Tambo', 'Vitalez', 'Don Galo', 'Merville', 'Moonwalk', 'Marcelo Green Village', 'BF Homes']);
        } else if (selectedCity === 'Taguig') {
            addBarangaysToDropdown(['Bagumbayan', 'Bambang', 'Calzada', 'Central Bicutan', 'Central Signal Village', 'Fort Bonifacio', 'Hagonoy', 'Ibayo-Tipas', 'Katuparan', 'Ligid-Tipas', 'Lower Bicutan', 'Maharlika Village', 'Napindan', 'New Lower Bicutan', 'North Daang Hari','North Signal Village','Palingon','Pinagsama','San Miguel','Santa Ana','South Daang Hari','South Signal Village','Tanyag','Tuktukan','Upper Bicutan','Ususan','Wawa','Western Bicutan']);
        } else if (selectedCity === 'Muntinlupa') {
            addBarangaysToDropdown(['Alabang', 'Bayanan', 'Cupang', 'New Alabang Village', 'Poblacion', 'Putatan', 'Sucat', 'Tunasan']);
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
            var selectedSchools = muntinlupaSchools; // Schools for Muntinlupa
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
            resetMap();
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
