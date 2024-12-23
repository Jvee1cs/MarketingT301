<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
</head>
<style>
    /* Add this CSS to your existing stylesheet or create a new one */
    .sidebar {
        transition: transform 0.3s ease;
        z-index: 10;
        width: 180px; /* Ensure sidebar is above the button */
    }
    .sidebar-hidden {
        transform: translateX(-100%);
    }
    .toggle-sidebar {
        z-index: 20; /* Ensure button is above the sidebar */
        transition: all 0.3s ease; /* Add transition for smoother animation */
    }

</style>
<script>
    // Add this JavaScript code to your existing script or create a new file and link it
$(document).ready(function() {
    // Function to toggle sidebar visibility
    $('.toggle-sidebar').click(function() {
        $('.sidebar').toggleClass('sidebar-hidden');
        $('.sidebar-toggle-text').toggleClass('hidden');
        $('.sidebar-toggle-alt-text').toggleClass('hidden');
        $('.toggle-sidebar').toggleClass('text-white text-blue-900');
    });
});
</script>
<body class="bg-gray-100">
    <!-- Sidebar Section -->
    <button class="toggle-sidebar text-blue-900 p-1 fixed top-4 left-4 ">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M20 6H4M20 12H4m16 6H4"></path>
        </svg>
    </button>

    <aside class="bg-blue-900 text-gray-200 h-screen w-40 fixed left-0 top-0 shadow-md sidebar sidebar-hidden">
        <div class="py-14 px-2 flex flex-col items-center">
            <img src="https://aics.edu.ph/wp-content/uploads/2018/10/logo_small.png" width="80" height="80"
                alt="Logo">
            <h1 class="text-white text-lg font-semibold mt-2">Marketing</h1>
        </div>
        <ul class="mt-1 text-white">
            <li><a href="#" class="block py-2 px-4 hover:bg-blue-800">Dashboard</a></li>
            <li><a href="{{ route('profile') }}" class="block py-2 px-4 hover:bg-blue-800">Profile</a></li>
            <li><a href="{{ route('notifications.index') }}" class="block py-2 px-4 hover:bg-blue-800">Notification</a>
            <li><a href="{{ route('submission.statistics') }}" class="block py-2 px-4 hover:bg-blue-800">Statistics</a>
            <li><a href="{{ route('normform.cities') }}" class="block py-2 px-4 hover:bg-blue-800">Manage Form</a></li>
            <li><a href="{{ route('map.show') }}" class="block py-2 px-4 hover:bg-blue-800">Map</a>
            <li><a href="{{ route('HELP') }}" class="block py-2 px-4 hover:bg-blue-800">Help & Support</a>
            </li>
        </ul>
        <div class="mt-auto py-4 px-4">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="block py-2 px-4 bg-blue-900 hover:bg-blue-800 text-white rounded-md text-sm font-semibold text-center">Logout</a>
        </div>
    </aside>
    <!-- Main Content Section -->

    <main class="flex-1 p-10">

        <div class="container mx-auto px-6 py-4">
            @if ($errors->any())
            <div class="mb-4">
                <ul class="list-disc text-center list-inside text-red-500">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Display session flash messages -->
            @if(session('message'))
            <div class="mb-4 text-center text-red-500">{{ session('message') }}</div>
            @endif

            <h1 class="text-3xl font-semibold mb-4 text-center text-blue-900">Marketing Dashboard</h1>
            <p class="text-sm font-medium text-center mb-8 text-gray-600">here, you can manage your student records,
                school records, and user records.</p>
        </div>

        <div class="flex flex-col md:flex-row md:justify-center mt-10 gap-10 ">
            <!-- Student Record Card -->
            <div class="card bg-white rounded-lg shadow-md p-6 w-full md:w-72">
                <h2 class="text-xl font-semibold mb-4 text-blue-900 text-center">Student Record</h2>
                <p class="text-gray-600 mb-6 text-gray-100 text-center">View Student records.</p>
                <a href="{{ route('students.records') }}"
                    class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block text-center mb-4">Go
                    to Student Records</a>
                <a href="{{ route('manage.links') }}"
                    class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block text-center mb-4">Generate
                    Form Link</a>
                    <a href="{{ route('students.course') }}"
                    class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block text-center mb-4">
                    Add New Course</a>
                    <a href="{{ route('students.strand') }}"
                    class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block text-center mb-4">
                    Add New Strand</a>

            </div>
            <!-- School Record Card -->
            <div class="card bg-white rounded-lg shadow-md p-6 w-full md:w-72">
                <h2 class="text-xl font-semibold mb-4 text-blue-900 text-center">School Record</h2>
                <p class="text-gray-600 mb-6 text-gray-100 text-center">View School records.</p>
                <a href="{{ route('school.records') }}"
                    class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block text-center mb-4">Go
                    to School Records</a>
                <a href="{{ route('schools.create') }}"
                    class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block text-center mb-4">Add
                    Target School</a>
                    <a href="{{ route('schools.city') }}"
                    class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block text-center mb-4">
                    Add Target Cities</a>
            </div>
            <!-- User Record Card -->
            <div class="card bg-white rounded-lg shadow-md p-6 w-full md:w-72">
                <h2 class="text-xl font-semibold mb-4 text-blue-900 text-center">User Record</h2>
                <p class="text-gray-600 mb-6 text-gray-100 text-center">View user records.</p>
                <a href="{{ route('user.records') }}"
                    class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block text-center block mb-4">Go
                    to User Records</a>
                <a href="{{ route('users.create') }}"
                    class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block text-center mb-4">Add
                    Login Record</a>

            </div>
        </div>

        <!-- Notification Section -->
        <div class="notification-container text-blue-800 rounded-md fixed top-10 right-5 overflow-auto">
            @if(auth()->check())
            @foreach(auth()->user()->unreadNotifications as $notification)
            <div class="notification mt-2 bg-blue-200 border border-blue-300 py-2 px-2">
                <span class="mr-2">{{ $notification->data['message'] }}</span>
                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST"
                    class="inline">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="text-sm text-blue-500 hover:text-blue-700 focus:outline-none">Mark as Read</button>
                </form>
                <a href="{{ route('notifications.index', $notification->id) }}"
                    class="text-sm text-blue-500 hover:text-blue-700 ml-2">View</a>
                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                    class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="text-sm text-red-500 hover:text-red-700 ml-2 focus:outline-none">Delete</button>
                </form>
            </div>
            @endforeach
            @endif
        </div>
        <!-- Toggle Notifications Button -->
<button class="toggle-notifications text-blue-500 font-bold py-2 px-4 rounded
    absolute top-4 right-4">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 17v1a3 3 0 006 0v-1m2-3V9a5 5 0 00-5-5V3a3 3 0 00-6 0v1a5 5 0 00-5 5v5a5 5 0 005 5h10a5 5 0 005-5z">
        </path>
        @if(auth()->check() && auth()->user()->unreadNotifications->isNotEmpty())
            <circle cx="17" cy="9" r="3" fill="red"></circle>
        @endif
    </svg>
</button>
    </main>
    <script>


        // Function to toggle notification visibility
        $('.toggle-notifications').click(function () {
            $('.notification-container').toggleClass('hidden');
        });
    </script>
</body>
</html>
