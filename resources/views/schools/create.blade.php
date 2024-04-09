<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New School</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            width: 100%;
        }
        h1 {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1); /* Modern-style shadow */
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center">
    <div class="bg-white max-w-md mx-auto rounded-md shadow-md p-6">
        <div class="flex justify-center mb-6">
            <img src="https://aics.edu.ph/wp-content/uploads/2018/10/logo_small.png" alt="AICS" class="w-32">
        </div>
        <h1 class="text-3xl font-semibold mb-6 text-blue-900">Add New Target School</h1>
        <form action="{{ route('schools.store') }}" method="POST">
            @csrf
            <div class="mb-4 w-30">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                <input type="text" id="name" name="name" required
                    class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-bold mb-2">Address:</label>
                <input type="text" id="address" name="address" required
                    class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label for="city" class="block text-gray-700 font-bold mb-2">Contact:</label>
                <input type="text" id="city" name="city" required
                    class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label for="city" class="block text-gray-700 font-bold mb-2">City:</label>
                <input type="text" id="city" name="city" required
                    class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-400">
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Add School</button>
        </form>
    </div>
</body>
</html>
