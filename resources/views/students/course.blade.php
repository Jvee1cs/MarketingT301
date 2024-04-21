<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="width=device-width, initial-scale=1.0">
    <title>Add New Strand</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="flex justify-center items-center h-screen">
        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-lg mx-4">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-blue-900">Add New Strand</h1>

                <a href="{{ route('admin.dashboard') }}" onclick="history.back()"
                    class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md font-semibold hover:bg-gray-300 transition duration-200 ease-in-out">Back to Dashboard</a>
            </div>

            <form action="{{ route('students.stored') }}" method="POST" class="space-y-4">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Course Name:</label>
                    <input type="text" id="course" name="course" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ease-in-out">
                </div>
                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded-md font-semibold hover:bg-blue-600 transition duration-200 ease-in-out">Add
                    New Course</button>
            </form>
        </div>
    </div>

</body>

</html>
