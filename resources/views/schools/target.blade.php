<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Target School</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
     
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            padding: 2rem;
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-semibold text-center mb-6 shadow-lg p-7">Add Target School</h1>

    <form method="POST" class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
        @csrf
        <div class="mb-6">
            <label for="option-name" class="block mb-2 text-lg">School Name:</label>
            <input type="text" name="name" id="option-name" placeholder="Enter School Name" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500">
        </div>

        <div class="mb-6">
            <label for="school-type" class="block mb-2 text-lg">Choose School Type:</label>
            <select name="school-type" id="school-type" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                <option value="public">Public</option>
                <option value="private">Private</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Add Target School</button>
    </form>
</div>

</body>
</html>
