<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Link</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col justify-center items-center">

    <div class="container mx-auto px-4 py-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold text-center mb-6">Generate Unique Link</h1>
        
        <p class="text-lg text-center mb-4">Click the button below to generate a unique link for creating students:</p>
        <form action="{{ route('generate.link') }}" method="GET" class="flex justify-center">
            @csrf
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-3 rounded-lg">Generate Link</button>
        </form>

        @if(isset($qrCode))
            <div class="mt-6 flex justify-center">
                <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code" class="w-64 h-64">
            </div>
        @endif

        @if(session('message'))
            <div class="mt-6 text-red-500 text-center">{{ session('message') }}</div>
        @endif

        @isset($link)
            <div class="mt-6">
                <p class="text-lg text-center">Full Link:</p>
                <a href="{{ route('aics.create.unique', $link->unique_identifier) }}" class="block text-blue-500 text-center underline">{{ route('aics.create.unique', $link->unique_identifier) }}</a>
            </div>
        @endisset
    </div>
    <div class="mt-4 flex flex-wrap justify-between items-center">
            <a href="{{ route('manage.links') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Back</a>

        </div>
</body>
</html>
