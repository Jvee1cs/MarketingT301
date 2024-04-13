<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-800 p-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex-shrink-0 flex items-center">
                <img src="https://aics.edu.ph/wp-content/uploads/2018/10/logo_small.png" alt="Image" class="h-8">
                <span class="text-white ml-2">Asian Institute in Computer Studies</span>
            </div>
            <div class="hidden md:block">
                <span class="text-white">{{ Auth::user()->name }}</span>
                <span class="text-white mx-4">|</span>
                <a href="#" class="text-white hover:text-gray-200">Edit Profile</a>
            </div>
        </div>
    </nav>
    <div class="max-w-3xl mx-auto mt-8 bg-white p-8 shadow-md rounded-md">
        <div class="bg-blue-800 rounded-t-md">
            <h2 class="text-white text-xl font-semibold p-4">Profile Information</h2>
        </div>
        <div class="mt-6 overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">ROLE</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ Auth::user()->role }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Name:</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Email:</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Created At:</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ Auth::user()->created_at->format('F j, Y, g:i a') }}</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Updated At:</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ Auth::user()->updated_at->format('F j, Y, g:i a') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Back Button -->
        <a href="{{ route('admin.dashboard') }}" class="mt-8 inline-block px-4 py-2 bg-blue-800 text-white font-semibold rounded hover:bg-blue-600">Back</a>
    </div>
</body>
</html>
