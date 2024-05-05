<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School List</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
<div class="container mx-auto p-4 md:p-8">
        <h1 class="text-3xl md:text-4xl font-semibold mb-4 md:mb-8 text-blue-900">School List</h1>
        <div class="mb-4 flex flex-wrap justify-between items-center">
            <a href="{{ route('schools.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Create New school</a>
            <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Go to Dashboard</a>
            <button type="button" id="exportButton" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Export Selected Data</button>
            <button id="deleteSelected" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Delete Selected</button>
            <button id="sendEmailButton" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-envelope"></i> Send Email
    </button>
            <form action="{{ route('schools.index') }}" method="GET" id="schoolsearchForm" class="flex items-center">
                @csrf
                <input type="text" name="search" placeholder="Search..." class="input-search border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-md px-4 py-2 mr-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Search</button>
            </form>
        </div>

         <form action="{{ route('schools.export') }}" method="POST" id="schoolForm">
            @csrf
            <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                <thead class="min-w-full bg-white rounded-lg overflow-hidden">
                    <tr>
                        <th class="py-3 px-6 text-left">
                            <label for="selectAll" class="inline-block">
                                <input type="checkbox" id="selectAll">
                                <span class="ml-2">Select All</span>
                            </label>
                        </th>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Address</th>
                        <th class="py-3 px-6 text-left">City</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-left">Updated At</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($schools as $school)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <input type="checkbox" name="selected_schools[]" value="{{ $school->id }}">
                            </td>
                            <td class="py-3 px-6 text-left">{{ $school->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $school->name }}</td>
                            <td class="py-3 px-6 text-left">{{ $school->address }}</td>
                            <td class="py-3 px-6 text-left">{{ $school->city }}</td>
                            <td class="py-3 px-6 text-left">{{ $school->email_address }}</td>
                            <td class="py-3 px-6 text-left">{{ $school->created_at }}</td>
                            <td class="py-3 px-6 text-left">{{ $school->updated_at }}</td>
                            <td class="py-3 px-6 text-left">
                                <a href="#" class="text-blue-500 hover:text-blue-700 mr-2 view-details" data-id="{{ $school->id }}">View</a>
                                <a href="#" class="text-blue-500 hover:text-blue-700 mr-2 edit-details" data-id="{{ $school->id }}">Edit</a>
                                <button class="text-red-500 hover:text-red-700 delete-school" data-id="{{ $school->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </form>
         <!-- Pagination links -->
         <div class="mt-4">
            {{ $schools->links() }}
        </div>
        </div>
<!-- SMS Message Modal -->
<div id="smsMessageModal" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white p-8 rounded shadow-lg">
            <h2 class="text-2xl font-semibold mb-4 text-gray-900">Enter SMS Message</h2>
            <textarea id="smsMessageInput" class="w-full h-32 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:border-blue-300" placeholder="Enter your SMS message..."></textarea>
            <div class="flex justify-end mt-4">
                <button id="cancelSMSMessage" class="mr-2 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Cancel</button>
                <button id="sendSMSMessage" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Send</button>
            </div>
        </div>
    </div>
</div>
<!-- school Details Modal -->
<div id="schoolDetailsModal" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 hidden">
    <div class="flex items-center justify-center h-full">
        <div class="bg-white p-8 rounded shadow-lg">
            <h2 class="text-2xl font-semibold mb-4 text-gray-900">School Details</h2>
            <div id="schoolDetailsContent"></div>
            <button id="closeModal" class="mt-4 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Close</button>
        </div>
    </div>
</div>
 <!-- Spinner (hidden by default) -->
 <div id="spinner" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
    <div class="text-white text-4xl">
        <i class="fas fa-spinner fa-spin"></i> Processing...
    </div>
</div>
<!-- Success Message Modal -->
<div id="successModal" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 hidden">
  <div class="flex items-center justify-center h-full">
    <div class="bg-white p-8 rounded shadow-lg text-center">
      <i class="fas fa-check-circle text-green-500 text-6xl"></i>
      <h2 class="text-2xl font-semibold text-gray-900 my-4">Operation Successful</h2>
      <p class="text-gray-700">Your emails have been sent successfully!</p>
      <button id="closeSuccessModal" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">OK</button>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/school/school.js') }}"></script>

<script>
       
$(document).ready(function() {
  $('#sendEmailButton').click(function() {
    // Show the spinner
    $('#spinner').removeClass('hidden');

    var selectedSchools = [];
    $('input[name="selected_schools[]"]:checked').each(function() {
      selectedSchools.push($(this).val());
    });

    $.ajax({
      url: '{{ route("emailschool") }}',
      type: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        selected_schools: selectedSchools
      },
      success: function(response) {
        // Hide the spinner and show the success message
        $('#spinner').addClass('hidden');
        $('#successModal').removeClass('hidden'); // Show the success modal
      },
      error: function(xhr, status, error) {
        // Hide the spinner and handle errors
        $('#spinner').addClass('hidden');
        console.error('Error sending emails:', error);
        alert('Failed to send emails. Please try again.');
      }
    });
  });

  // Close the success modal
  $('#closeSuccessModal').click(function() {
    $('#successModal').addClass('hidden');
  });
});

    </script>

</body>
</html>
