<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles can be added here */
        .unread {
            background-color: #FFFDD0; /* Soft yellow background for unread messages */
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 md:p-8">
        <div class="flex items-center mb-4 md:mb-8">
            <a href="#" onclick="history.go(-1)" class="text-blue-500 hover:text-blue-700 focus:outline-none mr-4">
                <svg class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back
            </a>
            <h1 class="text-3xl md:text-4xl font-semibold text-blue-900">Notification Center</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="py-3 px-6 text-left">Message</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($notifications as $notification)
                        <tr class="border-b border-gray-200 hover:bg-yellow-100 {{ $notification->read_at ? '' : 'unread' }}">
                            <td class="py-3 px-6 text-left">{{ $notification->data['message'] }}</td>
                            <td class="py-3 px-6 text-left">{{ $notification->created_at->format('M d, Y H:i:s') }}</td>
                            <td class="py-3 px-6 text-left">
                                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-blue-500 hover:text-blue-700 focus:outline-none">Mark as Read</button>
                                </form>
                                <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination links -->
        <div class="mt-4">
            {{ $notifications->links() }}
        </div>
    </div>
</body>
</html>
