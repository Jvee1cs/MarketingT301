<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-md shadow-md">
        <h1 class="text-2xl font-semibold mb-4 text-blue-900">Notification Settings</h1>
        
        <!-- Display current notification settings -->
        <div class="mb-4">
            <h2 class="text-lg font-semibold mb-2">Current Notification Threshold</h2>
            
                <p class="text-gray-700">No notification settings found.</p>
        </div>
        
        <!-- Form to update notification settings -->
        <form id="thresholdForm">
            <div class="mb-4">
                <label for="threshold" class="block text-sm font-medium text-gray-700">Notification Threshold (days)</label>
                <input type="number" id="threshold" name="threshold" value="{{ $notification->threshold_days ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            
            <button type="button" id="updateThreshold" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md">Update Threshold</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#updateThreshold').on('click', function() {
                var threshold = $('#threshold').val();
                $.ajax({
                    url: '{{ route("notifications.update") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        threshold: threshold
                    },
                    success: function(response) {
                        console.log(response);
                        // Handle success, maybe show a success message
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Log any errors for debugging
                    }
                });
            });
        });
    </script>
</body>
</html>
