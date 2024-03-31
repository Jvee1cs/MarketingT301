<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-semibold mb-6 text-blue-900">User List</h1>
        <div class="mb-4">
            <a href="{{ route('users.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mr-2">Create New User</a>
            <a href="{{ route('admin.dashboard') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Go to Dashboard</a>
            <button type="button" id="exportButton" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded ml-2">Export Selected Data</button>
        </div>
        <form action="{{ route('users.export') }}" method="POST" id="userForm">
            @csrf
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <tr>
                        <th class="py-3 px-6 text-left">
                            <label for="selectAll" class="inline-block">
                                <input type="checkbox" id="selectAll">
                                <span class="ml-2">Select All</span>
                            </label>
                        </th>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-left">Updated At</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <input type="checkbox" name="selected_users[]" value="{{ $user->id }}">
                            </td>
                            <td class="py-3 px-6 text-left">{{ $user->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->name }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->created_at }}</td>
                            <td class="py-3 px-6 text-left">{{ $user->updated_at }}</td>
                            <td class="py-3 px-6 text-left">
                                <a href="#" class="text-blue-500 hover:text-blue-700 mr-2 view-details" data-id="{{ $user->id }}">View</a>
                                <a href="#" class="text-blue-500 hover:text-blue-700 mr-2 edit-details" data-id="{{ $user->id }}">Edit</a>
                                <button class="text-red-500 hover:text-red-700 delete-user" data-id="{{ $user->id }}">Delete</button>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>

    <!-- User Details Modal -->
    <div id="userDetailsModal" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 hidden">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white p-8 rounded shadow-lg">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900">User Details</h2>
                <div id="userDetailsContent"></div>
                <button id="closeModal" class="mt-4 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Close</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('selectAll').addEventListener('change', function() {
            var checkboxes = document.getElementsByName('selected_users[]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = document.getElementById('selectAll').checked;
            });
        });
        document.querySelectorAll('tbody tr').forEach(function(row) {
            row.addEventListener('click', function(event) {
                if (event.target.tagName !== 'A') {
                    var checkbox = row.querySelector('input[type="checkbox"]');
                    checkbox.checked = !checkbox.checked;
                }
            });
        });
        document.querySelectorAll('.view-details').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var userId = link.getAttribute('data-id');
                fetch('/users/' + userId)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('userDetailsContent').innerHTML = data;
                        document.getElementById('userDetailsModal').classList.remove('hidden');
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        document.querySelectorAll('.edit-details').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var userId = link.getAttribute('data-id');
                fetch('/users/' + userId + '/edit')
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('userDetailsContent').innerHTML = data;
                        document.getElementById('userDetailsModal').classList.remove('hidden');
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('userDetailsModal').classList.add('hidden');
        });

        document.getElementById('exportButton').addEventListener('click', function() {
            document.getElementById('userForm').submit();
        });
        document.querySelectorAll('.delete-user').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        var userId = button.getAttribute('data-id');
        if (confirm('Are you sure you want to delete this user?')) {
            fetch('/users/' + userId, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (response.ok) {
                    // Reload the page or update the user list
                    location.reload();
                } else {
                    console.error('Error:', response.statusText);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
});
    </script>
</body>
</html>
