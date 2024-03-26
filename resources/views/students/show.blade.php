<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold mb-6 text-blue-900">{{ $student->stud_first_name }} {{ $student->stud_last_name }}</h1>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-lg font-bold mb-2">First Name:</p>
                <p class="text-gray-700">{{ $student->stud_first_name }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Last Name:</p>
                <p class="text-gray-700">{{ $student->stud_last_name }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Middle Name:</p>
                <p class="text-gray-700">{{ $student->stud_middle_name }}</p>
            </div>
            <!-- Add more student details as needed -->
        </div>
    </div>
</body>
</html>
