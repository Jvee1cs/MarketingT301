<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-3xl mx-auto mt-8 bg-white p-8 shadow-md rounded-md">
        <h2 class="text-2xl font-semibold mb-4">Edit Profile</h2>

        <!-- Display any validation errors -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name:</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full p-2 border rounded">
            </div>
            <div class="mb-4">
                <label for="username" class="block text-gray-700">Username:</label>
                <input type="text" name="username" id="username" value="{{ $user->username }}" class="w-full p-2 border rounded">
            </div>
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full p-2 border rounded">
            </div>
            <div class="flex justify-between">
                <a href="{{ route('profile') }}" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded">Save Changes</button>
            </div>
        </form>
    </div>
</body>
</html>