<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex flex-col items-center justify-center py-8">
        <img src="https://aics.edu.ph/wp-content/uploads/2018/10/logo_small.png" width="120" height="120" class="mb-8" alt="Asian Institute of Computer Studies">
        <header class="bg-gray-100 text-white py-4">
            <div class="container mx-auto flex justify-between items-center px-4">
                <h1 class="text-blue-900 block font-medium text-lg">Student Registration Form</h1>
            </div>
        </header>
    </div>
    <main class="container mx-auto py-8 px-4 md:px-0">
        <h2 class="text-xl font-medium mb-4">Student Registration Form</h2>
        <form action="{{ route('student.register.submit') }}" method="POST">
            @csrf
            <label for="stud_lastname" class="block mb-2">Last Name:</label>
            <input type="text" id="stud_lastname" name="stud_lastname" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4" required>

            <label for="stud_firstname" class="block mb-2">First Name:</label>
            <input type="text" id="stud_firstname" name="stud_firstname" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4" required>

            <label for="stud_middlename" class="block mb-2">Middle Name:</label>
            <input type="text" id="stud_middlename" name="stud_middlename" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4">

            <label for="contact_number" class="block mb-2">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4" required>

            <label for="address" class="block mb-2">Address:</label>
            <input type="text" id="address" name="address" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4" required>

            <label for="city" class="block mb-2">City:</label>
            <select id="city" name="city" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4" required>
                <option value="">Please select city</option>
                <option value="Manila">Manila</option>
                <option value="Quezon City">Quezon City</option>
                <option value="Caloocan">Caloocan</option>
        <option value="Las Pinas">Las Piñas</option>
        <option value="Makati">Makati</option>
        <option value="Malabon">Malabon</option>
        <option value="Mandaluyong">Mandaluyong</option>
        <option value="Marikina">Marikina</option>
        <option value="Muntinlupa">Muntinlupa</option>
        <option value="Navotas">Navotas</option>
        <option value="Paranaque">Parañaque</option>
        <option value="Pasay">Pasay</option>
        <option value="San Juan">San Juan</option>
        <option value="Taguig">Taguig</option>
        <option value="Valenzuela">Valenzuela</option>
                <!-- Add more options as needed -->
            </select><br><br>
      <label for="grade_level" class="block mb-2">Grade Level:</label>
      <select id="grade_level" name="grade_level" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4" required>
        <option value="">Please select grade level</option>
        <option value="10">Grade 10</option>
        <option value="11">Grade 11</option>
        <option value="12">Grade 12</option>
      </select><br><br>
      <label for="strand" class="block mb-2" class="block mb-2">Desire Strand & Course:</label>
      <select id="strand" name="strand" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4">
        <option value="Strand">Select Strand</option>
        <option value="STEM">STEM</option>
        <option value="ABM">ABM</option>
        <option value="GAS">GAS</option>
        <option value="HUMSS">HUMSS</option>
        <option value="ICT">GAS</option>
        <option value="IA">IA</option>

      </select><br><br>
      <select id="course" name="course" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4">
        <option value="course">Select course</option>
        <option value="BS COMPUTER SCIENCE">BS COMPUTER SCIENCE</option>
        <option value="BS ENTREPRENUERSHIP">BS ENTREPRENUERSHIP</option>
      </select><br><br>
      

      <h3 class=" text-xl font-medium mb-4">School Information:</h3>
<label for="school_name" class="block mb-2">School</label>
<select id="school_name" name="school_name" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4" required>
  <option value="">Please select school</option>
  </select><br><br>


 
      
      <h3 class=" text-xl font-medium mb-4">Guardian Information:</h3>
      <label for="g_name">Guardian Name:</label>
      <input type="text" id="g_name" name="g_name" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4"><br><br>
      <label for="g_contact">Guardian Contact</label>
      <input type="text" id="g_contact" name="g_contact" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4"><br><br>
      <label for="g_relationship">Relationship with Guardian:</label>
      <input type="text" id="g_relationship" name="g_relationship" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4"><br><br>
      

      <h3 class=" text-xl font-medium mb-4">Additional Information:</h3>
      <label for="email_address">Email Address:</label>
      <input type="email" id="email_address" name="email_address" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4"><br><br>
      <label for="fbaccount">FB Account:</label>
      <input type="text" id="fbaccount" name="fbaccount" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4"><br>
        <!-- Rest of your form content -->
        <!-- Modify as per your Laravel application's structure -->
            <!-- Include the rest of your form elements with appropriate Tailwind CSS classes -->

            <input type="submit" value="Submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-md" class="w-full border border-gray-300 rounded-md py-2 px-4 mb-4">
        </form>
    </main>
</body>
</html>