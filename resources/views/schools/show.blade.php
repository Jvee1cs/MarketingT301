<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $school->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold mb-6 text-blue-900">{{ $school->name }}</h1>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-lg font-bold mb-2">ID:</p>
                <p class="text-gray-700">{{ $school->id }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Name:</p>
                <p class="text-gray-700">{{ $school->name }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Address:</p>
                <p class="text-gray-700">{{ $school->address }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">City:</p>
                <p class="text-gray-700">{{ $school->city }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Country:</p>
                <p class="text-gray-700">{{ $school->country }}</p>
            </div>
        </div>
    </div>
</body>
</html>
