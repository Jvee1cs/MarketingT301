<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Management</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 font-sans"> 
    <div class="container mx-auto px-4 md:px-6 py-8"> <!-- Use smaller padding for mobile -->
        
        <!-- Header Section -->
        <header class="flex flex-col md:flex-row justify-between items-center mb-8"> <!-- Adjust layout based on screen size -->
            <div class="text-center md:text-left"> <!-- Centered for mobile -->
                <h1 class="text-3xl md:text-4xl font-bold text-blue-900">Form Management</h1> <!-- Smaller title for mobile -->
                <p class="text-gray-600">Manage cities, courses, and strands.</p>
            </div>
            
         
            <nav>
                <ul class="flex space-x-6"> 
                    <li>
                        <a href="{{ route('normform.cities') }}" class="hover:text-blue-700 text-blue-600 {{ request()->routeIs('normform.cities') ? 'font-bold underline' : '' }}">
                            Cities
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('normform.course') }}" class="hover:text-blue-700 text-blue-600 {{ request()->routeIs('normform.course') ? 'font-bold underline' : '' }}">
                            Courses
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('normform.strand') }}" class="hover:text-blue-700 text-blue-600 {{ request()->routeIs('normform.strand') ? 'font-bold underline' : '' }}">
                            Strands
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
        <div class="flex flex-wrap gap-4 items-center mb-6"> <!-- Flex and gap for responsiveness -->
            <a href="{{ route('schools.city') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                Add New City
            </a>
            <a href="{{ route('students.strand') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                Add New Strand
            </a>
            <a href="{{ route('students.course') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">
                Add New Course
            </a>
            <a href="{{ route('admin.dashboard') }}" class="text-blue-500 hover:text-blue-900 font-semibold  py-2 px-4 rounded-lg">
                Go to Dashboard
            </a>
        </div>
     
         <div class="bg-white shadow-lg rounded-lg p-6"> 
            @if(request()->routeIs('normform.cities'))
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">City List</h2>
                @include('normform.cities', ['cities' => $cities]) 
            
            @elseif(request()->routeIs('normform.course'))
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">Course List</h2>
                @include('normform.course', ['courses' => $course])
            
            @elseif(request()->routeIs('normform.strand'))
                <h2 class="text-2xl font-semibold text-blue-900 mb-4">Strand List</h2>
                @include('normform.strand', ['strands' => $strand])
            
            @endif
        </div>
 
    </div>
</body>
</html>
