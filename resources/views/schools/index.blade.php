<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Records</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>

        h1.text-shadow {
            text-shadow: 4px 4px 6px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8 shadow-lg">
        <h1 class="text-3xl font-semibold mb-6 text-blue-900 text-shadow">School Records</h1>
        <div class="flex justify-between mb-8">
            <a href="{{ route('schools.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">Add New School</a>
            <a href="{{ route('admin.dashboard') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">Go to Dashboard</a>
        </div>
        <div class="overflow-x-auto">
            <table class="table-auto min-w-full bg-white rounded-lg overflow-hidden">
                <thead class="bg-gray-200 text-gray-600 uppercase text-xs leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Address</th>
                        <th class="py-3 px-6 text-left">City</th>
                        <th class="py-3 px-6 text-left">Country</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($schools as $school)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $school->id }}</td>
                        <td class="py-3 px-6 text-left">{{ $school->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $school->address }}</td>
                        <td class="py-3 px-6 text-left">{{ $school->city }}</td>
                        <td class="py-3 px-6 text-left">{{ $school->country }}</td>
                        <td class="py-3 px-6 text-left">
                            <a href="{{ route('schools.show', $school->id) }}" class="text-blue-500 hover:text-blue-700 mr-2 transition duration-300 ease-in-out">View</a>
                            <a href="{{ route('schools.edit', $school->id) }}" class="text-blue-500 hover:text-blue-700 mr-2 transition duration-300 ease-in-out">Edit</a>
                            <form action="{{ route('schools.destroy', $school->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition duration-300 ease-in-out">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
