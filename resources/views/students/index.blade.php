<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 md:p-8">
        <div class="mb-4 flex flex-wrap justify-between items-center">
            <h1 class="text-3xl md:text-4xl font-semibold mb-4 md:mb-8 text-blue-900">Student List</h1> 
            
            <div class="space-x-4 flex items-center">
            <a href="{{ route('students.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-user-plus"></i> Create New Student
    </a>
                
    <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-tachometer-alt"></i> Go to Dashboard
    </a>                <button type="button" id="exportButton" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-file-export"></i> Export Selected
    </button>
    
    <button id="deleteSelected" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-trash-alt"></i> Delete Selected
    </button>
    
    <button id="sendEmailButton" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-envelope"></i> Send Email
    </button>
                <button id="sendSMSButton" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"><i class="fas fa-sms"></i> Send SMS</button>

                <form action="{{ route('students.index') }}" method="GET" id="studentsearchForm" class="flex items-center">
                    @csrf
                    <input type="text" name="search" placeholder="Search..." class="input-search mr-2 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ $searchQuery }}">
                    @if ($searchQuery || $selectedSchool)
                        <a href="{{ route('students.index') }}" class="mr-2 text-red-500 hover:text-red-700">Clear</a>
                    @endif
                    <select id="schoolFilter" name="school_filter" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">All Schools</option>
                        @foreach($schools as $school)
                            <option value="{{ $school }}" {{ $selectedSchool == $school ? 'selected' : '' }}>{{ $school }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="mt-1 px-3 text-blue-500 hover:text-blue-700 mr-2">Search</button>
                    
                </form>
            </div>
            
        </div>
        <div>
        <form action="{{ route('students.export') }}" method="POST" id="studentForm">
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
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">School</th>
                        <th class="py-3 px-6 text-left">Created At</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($students as $student)
                        <tr class="border-b border-gray-200 hover:bg-gray-100" data-school="{{ $student->school_name }}">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <input type="checkbox" name="selected_students[]" value="{{ $student->id }}">
                            </td>
                            <td class="py-3 px-6 text-left">{{ $student->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $student->stud_first_name }} {{ $student->stud_last_name }}</td>
                            <td class="py-3 px-6 text-left">{{ $student->email_address }}</td>
                            <td class="py-3 px-6 text-left">{{ $student->school_name }}</td>
                            <td class="py-3 px-6 text-left">{{ $student->created_at->format('M d, Y H:i:s') }}</td>
                            <td class="py-3 px-6 text-left">
                                <a href="#" class="text-blue-500 hover:text-blue-700 mr-2 view-details" data-id="{{ $student->id }}">View</a>
                                <a href="#" class="text-blue-500 hover:text-blue-700 mr-2 edit-details" data-id="{{ $student->id }}">Edit</a>
                                <button class="text-red-500 hover:text-red-700 delete-student" data-id="{{ $student->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </form>

<div class="mt-4">
    {{ $students->appends(['school_filter' => $selectedSchool, 'search' => $searchQuery])->links() }}
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
    <!-- student Details Modal -->
    <div id="studentDetailsModal" class="fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 hidden">
        <div class="flex items-center justify-center h-full">
            <div class="bg-white p-8 rounded shadow-lg">
                <h2 class="text-2xl font-semibold mb-4 text-gray-900">Student Details</h2>
                <div id="studentDetailsContent"></div>
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

    <script src="{{ asset('js/student/student.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
    $('#schoolFilter').change(function() {
        var selectedSchool = $(this).val();

        // Show all rows if no school is selected
        if (!selectedSchool) {
            $('tbody tr').show();
            return;
        }

        // Hide all rows and then show only the rows with the selected school
        $('tbody tr').hide().filter(function() {
            return $(this).data('school') === selectedSchool;
        }).show();
    });
});
$(document).ready(function() {
  $('#sendEmailButton').click(function() {
    // Show the spinner
    $('#spinner').removeClass('hidden');

    var selectedStudents = [];
    $('input[name="selected_students[]"]:checked').each(function() {
      selectedStudents.push($(this).val());
    });

    $.ajax({
      url: '{{ route("send.email") }}',
      type: 'POST',
      data: {
        _token: '{{ csrf_token() }}',
        selected_students: selectedStudents
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
// Show SMS message modal when "Send SMS to Selected Students" button is clicked
$('#sendSMSButton').click(function() {
    $('#smsMessageModal').removeClass('hidden');
});

// Hide SMS message modal when "Cancel" button is clicked
$('#cancelSMSMessage').click(function() {
    $('#smsMessageModal').addClass('hidden');
});

// Send SMS message when "Send" button is clicked
$('#sendSMSMessage').click(function() {
    var smsMessage = $('#smsMessageInput').val();
    if (!smsMessage) {
        alert('Please enter a message.');
        return;
    }

    var selectedStudents = [];
    $('input[name="selected_students[]"]:checked').each(function() {
        selectedStudents.push($(this).val());
    });

    // Send a POST request to your server
    $.ajax({
        url: '{{ route("students.sendSMS") }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            selected_students: selectedStudents,
            sms_message: smsMessage
        },
        success: function(response) {
            // Handle success response
            alert('SMS messages sent successfully');
            $('#smsMessageModal').addClass('hidden');
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error('Error sending SMS messages:', error);
            alert('Failed to send SMS messages. Please try again.');
        }
    });
});
    </script>
</body>
</html>