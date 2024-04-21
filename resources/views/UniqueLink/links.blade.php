<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Links</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 md:p-8">
        <h1 class="text-3xl md:text-4xl font-semibold mb-4 md:mb-8 text-blue-900">Manage Links</h1>
        <div class="mb-4 flex flex-wrap justify-between items-center">
            <a href="{{ route('aics.gen') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Generate New Link</a>
            <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Go to Dashboard</a>

        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                <thead>
                    <tr>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Unique Identifier</th>
                        <th class="py-3 px-6 text-left">Expires At</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-left">Updated At</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($links as $link)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $link->id }}</td>
                            <td class="py-3 px-6">{{ $link->unique_identifier }}</td>
                            <td class="py-3 px-6">{{ $link->expires_at }}</td>
                            <td class="py-3 px-6 {{ $link->is_active ? 'text-green-500' : 'text-red-500' }}">{{ $link->is_active ? 'Active' : 'Inactive' }}</td>
                            <td class="py-3 px-6">{{ $link->created_at }}</td>
                            <td class="py-3 px-6">{{ $link->updated_at }}</td>
                            <td class="py-3 px-6 flex items-center space-x-4">
                                <form action="{{ route('toggle.activation', $link->unique_identifier) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 py-1 px-4 rounded">{{ $link->is_active ? 'Deactivate' : 'Activate' }}</button>
                                </form>
                                <button class="text-blue-500 hover:text-blue-700 edit-expiration">Edit Expiration</button>
                                <form action="{{ route('links.delete', $link->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                </form>
                                <form action="{{ route('links.edit.expiration', $link->unique_identifier) }}" method="POST" class="edit-form hidden">
                                    @csrf
                                    <div class="flex items-center">
                                        <input type="datetime-local" name="expires_at" value="{{ date('Y-m-d\TH:i', strtotime($link->expires_at)) }}" class="mr-2 border border-gray-300 rounded px-4 py-2 focus:outline-none focus:border-blue-500">
                                        <button type="submit" class="text-blue-500 hover:text-blue-700">Save</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // JavaScript to toggle the visibility of the edit form
        document.querySelectorAll('.edit-expiration').forEach(button => {
            button.addEventListener('click', () => {
                const editForm = button.parentElement.querySelector('.edit-form');
                if (editForm) {
                    editForm.classList.toggle('hidden');
                }
            });
        });
    </script>
</body>
</html>
