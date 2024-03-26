<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold mb-6 text-blue-900">Student Records</h1>
        <a href="{{ route('students.create') }}" class="inline-block mb-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Add New Student</a>
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">First Name</th>
                    <th class="py-3 px-6 text-left">Last Name</th>
                    <th class="py-3 px-6 text-left">Middle Name</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($students as $student)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left whitespace-nowrap">{{ $student->id }}</td>
                    <td class="py-3 px-6 text-left">{{ $student->stud_first_name }}</td>
                    <td class="py-3 px-6 text-left">{{ $student->stud_last_name }}</td>
                    <td class="py-3 px-6 text-left">{{ $student->stud_middle_name }}</td>
                    <td class="py-3 px-6 text-left">
                        <a href="{{ route('students.show', $student->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">View</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
