<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Data Entry Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-indigo-50 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full p-6 bg-white rounded-md shadow-md font-sans">
        <img src="https://aics.edu.ph/wp-content/uploads/2018/10/logo_small.png" alt="Image" class="mx-auto mb-4 w-24 h-auto">
        <h1 class="text-3xl font-semibold text-black-600 mb-6 text-center">Student Data Entry Form</h1>
        
        <!-- Error Handling -->
        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- Form -->
        <form method="post" action="{{route('aics.store')}}" class="space-y-4">
            @csrf
            <!-- Input fields -->
            <!-- First Name -->
            <div>
                <label for="stud_first_name" class="block text-sm font-medium text-gray-700">First Name *</label>
                <input type="text" id="stud_first_name" name="stud_first_name" placeholder="First Name" required
                    class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Middle Name -->
            <div>
                <label for="stud_middle_name" class="block text-sm font-medium text-gray-700">Middle Name *</label>
                <input type="text" id="stud_middle_name" name="stud_middle_name" placeholder="Middle Name" required
                    class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Last Name -->
            <div>
                <label for="stud_last_name" class="block text-sm font-medium text-gray-700">Last Name *</label>
                <input type="text" id="stud_last_name" name="stud_last_name" placeholder="Last Name" required
                    class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Contact -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Contact *</label>
                <input type="text" id="phone" name="phone" placeholder="Contact" required
                    class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address *</label>
                <input type="text" id="address" name="address" placeholder="Address" required
                    class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- City -->
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700">City *</label>
                <select id="city" name="city" required
                class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
                <option value="">Please select city</option>
                @foreach($cities as $id => $city)
                    <option value="{{ $city }}">{{ $city }}</option>
                @endforeach
            </select>
            </div>
            <!-- Grade Level -->
            <div>
                <label for="grade_level" class="block text-sm font-medium text-gray-700">Grade Level *</label>
                <select id="grade_level" name="grade_level" required
                    class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
                    <option value="">Please select grade level</option>
                    <option value="10">Grade 10</option>
                    <option value="12">Grade 12</option>
                </select>
            </div>
            <div>
                <label for="strand" class="block text-sm font-medium text-gray-700">Desired Strand *</label>
                <select id="strand" name="strand" required
                class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
                <option value="">Please select strands</option>
                @foreach($strands as $id => $strand)
                    <option value="{{ $strand }}">{{ $strand }}</option>
                @endforeach
            </select>
            </div>
            <div>
                <label for="course" class="block text-sm font-medium text-gray-700">Course *</label>
                <select id="course" name="course" required
                class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
                <option value="">Please select courses</option>
                @foreach($courses as $id => $course)
                    <option value="{{ $course }}">{{ $course }}</option>
                @endforeach
            </select>
            </div>
            <!-- School Information -->
            <h3 class="text-2xl font-medium mb-2">School Information:</h3>
            <div>
    <label for="school_name" class="block text-sm font-medium text-gray-700">School *</label>
    <select id="school_name" name="school_name" required
        class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
        <option value="">Please select school</option>
        @foreach($schools as $id => $name)
            <option value="{{ $name }}">{{ $name }}</option>
        @endforeach
    </select>
</div>
            <!-- Guardian Information -->
            <h3 class="text-2xl font-medium mb-2">Guardian Information:</h3>
            <div>
                <label for="g_name" class="block text-sm font-medium text-gray-700">Guardian Name *</label>
                <input type="text" id="g_name" name="g_name" placeholder="Guardian Name" required
                    class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <div>
                <label for="g_phone" class="block text-sm font-medium text-gray-700">Guardian Contact *</label>
                <input type="text" id="g_phone" name="g_phone" placeholder="Guardian Contact" required
                    class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <div>
                <label for="g_relationship" class="block text-sm font-medium text-gray-700">Relationship with Guardian *</label>
                <input type="text" id="g_relationship" name="g_relationship" placeholder="Relationship with Guardian" required
                    class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Additional Information -->
            <h3 class="text-2xl font-medium mb-2">Additional Information:</h3>
            <div>
                <label for="email_address" class="block text-sm font-medium text-gray-700">Email Address *</label>
                <input type="email" id="email_address" name="email_address" placeholder="Email Address" required
                    class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <div>
                <label for="fbaccount" class="block text-sm font-medium text-gray-700">Facebook Account *</label>
                <input type="text" id="fbaccount" name="fbaccount" placeholder="Facebook Account" required
                    class="mt-1 w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base px-3 py-2 text-lg">
            </div>
            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-6 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit Now!
                </button>
            </div>
        </form>
    </div>
</body>

</html>

