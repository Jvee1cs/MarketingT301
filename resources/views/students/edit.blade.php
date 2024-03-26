<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold mb-6 text-blue-900">Edit Student</h1>
        <form action="{{ route('students.update', $student->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="stud_first_name" class="block text-sm font-medium text-gray-700">First Name:</label>
                <input type="text" id="stud_first_name" name="stud_first_name" value="{{ $student->stud_first_name }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>

            <div>
                <label for="stud_last_name" class="block text-sm font-medium text-gray-700">Last Name:</label>
                <input type="text" id="stud_last_name" name="stud_last_name" value="{{ $student->stud_last_name }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>

            <div>
                <label for="stud_middle_name" class="block text-sm font-medium text-gray-700">Middle Name:</label>
                <input type="text" id="stud_middle_name" name="stud_middle_name" value="{{ $student->stud_middle_name }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>

            <!-- Add more input fields for other student details if needed -->

            <button type="submit" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Update</button>
        </form>
    </div>
</body>
</html>
