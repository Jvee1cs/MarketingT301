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
<body class="bg-gray-100">
    <!-- Header Section -->
    <header class="bg-gray-100 text-white py-4">
    <div class="container mx-auto flex justify-between items-center px-4">
        <div class="flex items-center">
                <img src="https://aics.edu.ph/wp-content/uploads/2018/10/logo_small.png" width="60" height="60" class="mr-2" alt="Asian Institute of Computer Studies">
                <h1 class="text-blue-900 block font-medium text-lg">Dashboard</h1>
            </div>
            <div class="logout">
                <a href="{{ route('admin.logout') }}" class="button button-logout bg-gray-100 hover:bg-gray-200 px-4 text-blue-900 py-2 rounded-md block font-medium text-sm">LOGOUT</a>
            </div>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="container mx-auto py-8 px-4 md:px-0">
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
