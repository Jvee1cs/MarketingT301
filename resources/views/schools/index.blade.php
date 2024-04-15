<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School List</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-4 md:p-8">
        <h1 class="text-3xl md:text-4xl font-semibold mb-4 md:mb-8 text-blue-900">School List</h1>
        <div class="mb-4 flex flex-wrap justify-between items-center">
            <a href="{{ route('schools.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Create New school</a>
            <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Go to Dashboard</a>
            <button type="button" id="exportButton" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Export Selected Data</button>
            <button id="deleteSelected" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Delete Selected</button>
            <form action="{{ route('schools.index') }}" method="GET" id="schoolsearchForm" class="flex items-center">
                @csrf
                <input type="text" name="search" placeholder="Search..." class="input-search border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-md px-4 py-2 mr-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Search</button>
            </form>
        </div>

         <form action="{{ route('schools.export') }}" method="POST" id="schoolForm">
            @csrf
            <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                <thead class="min-w-full bg-white rounded-lg overflow-hidden">
                    <tr>
                        <th class="py-3 px-6 text-left">
                            <label for="selectAll" class="inline-block">
                                <input type="checkbox" id="selectAll">
                                <span class="ml-2">Select All</span>
                            </label>
                        </th>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Address</th>
                        <th class="py-3 px-6 text-left">City</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-left">Updated At</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($schools as $school)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <input type="checkbox" name="selected_schools[]" value="{{ $school->id }}">
                            </td>
                            <td class="py-3 px-6 text-left">{{ $school->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $school->name }}</td>
                            <td class="py-3 px-6 text-left">{{ $school->address }}</td>
                            <td class="py-3 px-6 text-left">{{ $school->city }}</td>
                            <td class="py-3 px-6 text-left">{{ $school->created_at }}</td>
                            <td class="py-3 px-6 text-left">{{ $school->updated_at }}</td>
                            <td class="py-3 px-6 text-left">
                                <a href="#" class="text-blue-500 hover:text-blue-700 mr-2 view-details" data-id="{{ $school->id }}">View</a>
                                <a href="#" class="text-blue-500 hover:text-blue-700 mr-2 edit-details" data-id="{{ $school->id }}">Edit</a>
                                <button class="text-red-500 hover:text-red-700 delete-school" data-id="{{ $school->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </form>
         <!-- Pagination links -->
         <div class="mt-4">
            {{ $schools->links() }}
        </div>
        </div>

<!-- school Details Modal -->
<div id="schoolDetailsModal" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white p-8 rounded shadow-lg">
            <h2 class="text-2xl font-semibold mb-4 text-gray-900">school Details</h2>
            <div id="schoolDetailsContent"></div>
            <button id="closeModal" class="mt-4 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Close</button>
        </div>
    </div>
</div>
<script src="{{ asset('js/school/school.js') }}"></script>


</body>
</html>
