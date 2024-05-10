<!-- resources/views/normform/partials/course-list.blade.php -->
<div class="overflow-x-auto bg-white rounded-lg">
    <table class="min-w-full table-auto border-separate" style="border-spacing: 0">
        <thead class="font-semibold text-blue-900 bg-gray-100">
            <tr>
                <th class="py-3 px-6 text-left">ID</th>
                <th class="py-3 px-6 text-left">Course</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr class="border-b hover:bg-gray-100">
                <td class="py-3 px-6">{{ $course->id }}</td>
                <td class="py-3 px-6">{{ $course->course }}</td>
                <td class="py-3 px-6 text-center">
                    <form action="{{ route('normform.destroyCourse', $course->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
