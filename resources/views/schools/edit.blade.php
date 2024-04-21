<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit School</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold mb-6 text-blue-900">Edit School</h1>
        <form action="{{ route('schools.update', $school->id) }}" method="POST" class="max-w-md">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                <input type="text" id="name" name="name" value="{{ $school->name }}" required
                    class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label for="principal" class="block text-gray-700 font-bold mb-2">Principal:</label>
                <input type="text" id="aprincipal" name="principal" value="{{ $school->principal }}" required
                    class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-bold mb-2">Address:</label>
                <input type="text" id="address" name="address" value="{{ $school->address }}" required
                    class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label for="city" class="block text-gray-700 font-bold mb-2">City:</label>
                <input type="text" id="city" name="city" value="{{ $school->city }}" required
                    class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label for="country" class="block text-gray-700 font-bold mb-2">Contact:</label>
                <input type="text" id="contact" name="contact" value="{{ $school->contact}}" required
                    class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-400">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">Update School</button>
        </form>
    </div>
</body>
</html>
