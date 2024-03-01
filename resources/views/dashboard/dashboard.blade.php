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
        z-index: 10; /* Ensure sidebar is above the button */
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
    <button class="toggle-sidebar text-gray-100 p-1 fixed top-4 left-4">
    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 6H4M20 12H4m16 6H4"></path>
</svg>
    </button>
    <aside class="bg-blue-900 text-gray-200 h-screen w-40 fixed left-0 top-0 shadow-md sidebar">
        <div class="py-14 px-2 flex flex-col items-center">
            <img src="https://aics.edu.ph/wp-content/uploads/2018/10/logo_small.png" width="80" height="80" alt="Logo">
            <h1 class="text-white text-lg font-semibold mt-2">Marketing</h1>
        </div>
        <ul class="mt-1 text-white">
            <li><a href="#" class="block py-2 px-4 hover:bg-blue-800">Dashboard</a></li>
            <li><a href="#" class="block py-2 px-4 hover:bg-blue-800">Student Records</a></li>
            <li><a href="#" class="block py-2 px-4 hover:bg-blue-800">School Records</a></li>
            <li><a href="#" class="block py-2 px-4 hover:bg-blue-800">User Records</a></li>
        </ul>
        <div class="mt-auto py-4 px-4">
            <a href="#" class="block py-2 px-4 bg-blue-900 hover:bg-blue-800 text-white rounded-md text-sm font-semibold text-center">Logout</a>
        </div>
        
    </aside>
    <!-- Main Content Section -->
    <main class="container mx-auto py-40 px-4 md:px-0">
        <h1 class="text-3xl font-semibold mb-4 text-center text-blue-900">Welcome to your Dashboard</h1>
        <p class="text-sm font-medium text-center mb-8 text-gray-600">here, you can manage your student records, school records, and user records.</p>
        <div class="flex flex-col md:flex-row md:justify-center gap-8">
            <!-- Student Record Card -->
            <div class="card bg-white rounded-lg shadow-md p-6 w-full md:w-72">
                <h2 class="text-xl font-semibold mb-4 text-blue-900">Student Record</h2>
                <p class="text-gray-600 mb-6 text-gray-100">View and manage Student records.</p>
                <a href="{{ route('student.records') }}" class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block text-center">Go to Student Records</a>
            </div>
            <!-- School Record Card -->
            <div class="card bg-white rounded-lg shadow-md p-6 w-full md:w-72">
                <h2 class="text-xl font-semibold mb-4 text-blue-900">School Record</h2>
                <p class="text-gray-600 mb-6 text-gray-100">View and manage School records.</p>
                <a href="{{ route('school.records') }}" class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block text-center mb-4">Go to School Records</a>
                <form action="{{ route('school.add') }}" method="post">
                    @csrf
                    <button type="submit" class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block w-full">Add Target School</button>
                </form>
            </div>
            <!-- User Record Card -->
            <div class="card bg-white rounded-lg shadow-md p-6 w-full md:w-72">
                <h2 class="text-xl font-semibold mb-4 text-blue-900">User Record</h2>
                <p class="text-gray-600 mb-6 text-gray-100">View and manage user records.</p>
                <a href="{{ route('user.records') }}" class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block text-center block mb-4">Go to User Records</a>
                <form action="{{ route('user.add') }}" method="post">
                    @csrf
                    <button type="submit" class="button card-button bg-blue-500 hover:bg-blue-600 px-4 text-white py-2 rounded-md block w-full">Add Login Record</button>
                </form>
            </div>
        </div>

    </main>
</body>
</html>
