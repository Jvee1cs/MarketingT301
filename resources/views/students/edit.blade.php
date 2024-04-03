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
        <form action="{{ route('students.update', $student->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @csrf
            @method('PUT')

            <!-- First Name -->
            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                <label for="stud_first_name" class="block text-sm font-medium text-gray-700">First Name:</label>
                <input type="text" id="stud_first_name" name="stud_first_name" value="{{ $student->stud_first_name }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Last Name -->
            <div class="col-span-1 md:col-span-1 lg:col-span-1">
                <label for="stud_last_name" class="block text-sm font-medium text-gray-700">Last Name:</label>
                <input type="text" id="stud_last_name" name="stud_last_name" value="{{ $student->stud_last_name }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Middle Name -->
            <div class="col-span-1">
                <label for="stud_middle_name" class="block text-sm font-medium text-gray-700">Middle Name:</label>
                <input type="text" id="stud_middle_name" name="stud_middle_name" value="{{ $student->stud_middle_name }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Add more input fields for other student details as needed -->
            
            <!-- Address -->
            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                <label for="address" class="block text-sm font-medium text-gray-700">Address:</label>
                <input type="text" id="address" name="address" value="{{ $student->address }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- City -->
            <div class="col-span-1 md:col-span-1 lg:col-span-1">
                <label for="city" class="block text-sm font-medium text-gray-700">City:</label>
                <input type="text" id="city" name="city" value="{{ $student->city }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Grade Level -->
            <div class="col-span-1">
                <label for="grade_level" class="block text-sm font-medium text-gray-700">Grade Level:</label>
                <input type="text" id="grade_level" name="grade_level" value="{{ $student->grade_level }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Strand -->
            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                <label for="strand" class="block text-sm font-medium text-gray-700">Strand:</label>
                <input type="text" id="strand" name="strand" value="{{ $student->strand }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Course -->
            <div class="col-span-1 md:col-span-1 lg:col-span-1">
                <label for="course" class="block text-sm font-medium text-gray-700">Course:</label>
                <input type="text" id="course" name="course" value="{{ $student->course }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- School Name -->
            <div class="col-span-1">
                <label for="school_name" class="block text-sm font-medium text-gray-700">School Name:</label>
                <input type="text" id="school_name" name="school_name" value="{{ $student->school_name }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Guardian Name -->
            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                <label for="g_name" class="block text-sm font-medium text-gray-700">Guardian Name:</label>
                <input type="text" id="g_name" name="g_name" value="{{ $student->g_name }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Guardian Relationship -->
            <div class="col-span-1 md:col-span-1 lg:col-span-1">
                <label for="g_relationship" class="block text-sm font-medium text-gray-700">Guardian Relationship:</label>
                <input type="text" id="g_relationship" name="g_relationship" value="{{ $student->g_relationship }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Email Address -->
            <div class="col-span-1">
                <label for="email_address" class="block text-sm font-medium text-gray-700">Email Address:</label>
                <input type="email" id="email_address" name="email_address" value="{{ $student->email_address }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Facebook Account -->
            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                <label for="fbaccount" class="block text-sm font-medium text-gray-700">Facebook Account:</label>
                <input type="text" id="fbaccount" name="fbaccount" value="{{ $student->fbaccount }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Phone -->
            <div class="col-span-1 md:col-span-1 lg:col-span-1">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone:</label>
                <input type="text" id="phone" name="phone" value="{{ $student->phone }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Guardian Phone -->
            <div class="col-span-1">
                <label for="g_phone" class="block text-sm font-medium text-gray-700">Guardian Phone:</label>
                <input type="text" id="g_phone" name="g_phone" value="{{ $student->g_phone }}" class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Created At -->
            <div class="col-span-1 md:col-span-1 lg:col-span-1">
                <label for="created_at" class="block text-sm font-medium text-gray-700">Created At:</label>
                <p class="text-gray-700">{{ $student->created_at }}</p>
            </div>
            <!-- Updated At -->
            <div class="col-span-1">
                <label for="updated_at" class="block text-sm font-medium text-gray-700">Updated At:</label>
                <p class="text-gray-700">{{ $student->updated_at }}</p>
            </div>
            <!-- Submit Button -->
            <div class="col-span-1">
                <button type="submit" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Update</button>
            </div>
        </form>
    </div>
</body>
</html>
