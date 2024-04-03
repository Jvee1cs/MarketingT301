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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                <p class="text-lg font-bold mb-2">First Name:</p>
                <p class="text-gray-700">{{ $student->stud_first_name }}</p>
            </div>
            <div class="col-span-1 md:col-span-1 lg:col-span-1">
                <p class="text-lg font-bold mb-2">Last Name:</p>
                <p class="text-gray-700">{{ $student->stud_last_name }}</p>
            </div>
            <div class="col-span-1">
                <p class="text-lg font-bold mb-2">Middle Name:</p>
                <p class="text-gray-700">{{ $student->stud_middle_name }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Address:</p>
                <p class="text-gray-700">{{ $student->address }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">City:</p>
                <p class="text-gray-700">{{ $student->city }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Grade Level:</p>
                <p class="text-gray-700">{{ $student->grade_level }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Strand:</p>
                <p class="text-gray-700">{{ $student->strand }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Course:</p>
                <p class="text-gray-700">{{ $student->course }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">School Name:</p>
                <p class="text-gray-700">{{ $student->school_name }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Guardian Name:</p>
                <p class="text-gray-700">{{ $student->g_name }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Guardian Relationship:</p>
                <p class="text-gray-700">{{ $student->g_relationship }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Email Address:</p>
                <p class="text-gray-700">{{ $student->email_address }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Facebook Account:</p>
                <p class="text-gray-700">{{ $student->fbaccount }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Phone:</p>
                <p class="text-gray-700">{{ $student->phone }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Guardian Phone:</p>
                <p class="text-gray-700">{{ $student->g_phone }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Created At:</p>
                <p class="text-gray-700">{{ $student->created_at }}</p>
            </div>
            <div>
                <p class="text-lg font-bold mb-2">Updated At:</p>
                <p class="text-gray-700">{{ $student->updated_at }}</p>
            </div>
        </div>
    </div>
</body>
</html>
