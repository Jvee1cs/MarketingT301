<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New School</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="flex justify-center items-center min-h-screen px-4">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-lg mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-blue-900">Add New School</h1>
                <a href="{{ route('admin.dashboard') }}" onclick="history.back()"
                    class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md font-semibold hover:bg-gray-300 transition duration-200 ease-in-out">
                    Back to Dashboard
                </a>
            </div>

            <form action="{{ route('schools.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Name:</label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700 font-semibold mb-2">Address:</label>
                    <input type="text" id="address" name="address" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
                </div>

                <div class="mb-4">
                    <label for="city" class="block text-gray-700 font-semibold mb-2">City:</label>
                    <input type="text" id="city" name="city" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
                </div>

                <div class="mb-4">
                <label for="principal" class="block text-gray-700 font-semibold mb-2">Principal:</label>
                <input type="text" id="principal" name="principal" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
            </div>
            <div class="mb-4">
                <label for="email_address" class="block text-sm font-medium text-gray-700">Email Address *</label>
                <input type="email" id="email_address" name="email_address" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
            </div>
                <div class="mb-4">
                    <label for="contact" class="block text-gray-700 font-semibold mb-2">Contact:</label>
                    <input type="text" id="contact" name="contact" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-md font-semibold hover:bg-blue-600 transition duration-200 ease-in-out">
                    Add School
                </button>
            </form>
        </div>
    </div>

</body>

</html>
