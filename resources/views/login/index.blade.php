<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketing Login Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md overflow-hidden">
        <div class="flex justify-center items-center py-4">
            <img src="https://aics.edu.ph/wp-content/uploads/2018/10/logo_small.png" alt="Logo" class="h-24"> <!-- Increased height to h-24 -->
        </div>
        <div class="p-8">
            <h1 class="text-2xl font-medium mb-8 text-center font-serif text-blue-900 font-medium" style="font-family: 'Roboto', sans-serif;">Marketing Login Panel</h1> <!-- Added font-medium and font-serif classes -->
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc list-inside text-red-500">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Display session flash messages -->
            @if(session('message'))
                <div class="mb-4 text-red-500">{{ session('message') }}</div>
            @endif

            <form method="post" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-blue-800 font-medium text-sm">Username:</label>
                    <input type="text" id="username" name="username" placeholder="" class="form-input mt-1 block w-full rounded-md border border-gray-300 focus:ring focus:ring-blue-200 px-3 py-1 text-lg"> <!-- Adjusted padding and font size -->
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-blue-800 font-medium text-sm">Password:</label>
                    <input type="password" id="password" name="password" placeholder="" class="form-input mt-1 block w-full rounded-md border border-gray-300 focus:ring focus:ring-blue-200 px-3 py-1 text-lg"> <!-- Adjusted padding and font size -->
                </div>
                <button type="submit" class="font-medium text-sm w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300">LOGIN</button>
            </form>
            
        </div>
    </div>
</body>
</html>
