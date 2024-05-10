<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Support</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth; /* Enable smooth scrolling */
        }

        /* Sidebar styling */
        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            height: 100%;
            width: 250px; /* Wider sidebar for more space */
            background-color: #1e3a8a; /* Blue-900 in Tailwind */
            color: white;
            padding: 20px;
            overflow-y: auto;
            z-index: 10; /* Ensures sidebar is above other content */
            transition: transform 0.3s ease-in-out; /* Smooth transition for toggle */
        }

        .sidebar.hidden {
            transform: translateX(100%); /* Hide sidebar when class "hidden" is added */
        }

        .sidebar h2 {
            font-size: 1.25rem; /* Larger font for headings */
            font-weight: bold; /* Bold font for emphasis */
            margin-bottom: 20px; /* Space between header and buttons */
        }

        .sidebar button {
            display: block;
            width: 100%; /* Full width for buttons */
            margin-bottom: 10px;
            background-color: #3b82f6; /* Blue-500 in Tailwind */
            text-align: center;
            padding: 12px; /* Increased padding for larger buttons */
            color: white;
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s ease; /* Smooth hover effect */
        }

        .sidebar button:hover {
            background-color: #2563eb; /* Blue-600 on hover */
        }

        /* Toggle button for the sidebar */
        .toggle-sidebar {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #1e3a8a;
            color: white;
            padding: 12px;
            border-radius: 5px; /* Rounded corners */
            cursor: pointer;
            z-index: 20; /* Ensure it's above the sidebar */
            transition: background-color 0.3s ease; /* Smooth hover effect */
        }

        .toggle-sidebar:hover {
            background-color: #2563eb; /* Blue-600 on hover */
        }

        /* Adjust main content to avoid overlap with sidebar */
        .main-content {
            margin-right: 270px; /* Provide enough space for the sidebar */

        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto px-6 py-4">
        <a href="#" onclick="history.go(-1)" class="text-blue-500 hover:text-blue-700 focus:outline-none mr-4">
            <svg class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to dashboard
        </a>
        <h1 class="text-3xl font-bold text-center text-blue-900">Help & Support</h1>
        <p class="text-lg text-center mb-8 text-gray-600">Find guidance on how to use the system and answers to common questions.</p>
<!-- Sidebar toggle button -->
<div class="toggle-sidebar" onclick="toggleSidebar()">☰</div>

<!-- Sidebar with Shortcut Buttons -->
<div class="sidebar hidden" id="rightSidebar"> <!-- Sidebar hidden by default -->
<img src="https://aics.edu.ph/wp-content/uploads/2018/10/logo_small.png" alt="Brand Logo" class="w-16 h-16 mx-auto mb-4"> <!-- Adjust image size -->

    <h2 class="text-xl font-bold mb-4 text-center">Quick Navigation</h2>
    <button onclick="scrollToSection('#Dashboard')">Dashboard</button>
    <button onclick="scrollToSection('#working-with-records')">Working with Records</button>
    <button onclick="scrollToSection('#Profile')">Profile</button>
    <button onclick="scrollToSection('#Notification')">Notification</button>
    <button onclick="scrollToSection('#Statistics')">Statistics</button>
    <button onclick="scrollToSection('#Map')">Map</button>
</div>
<section class="mb-10" id="system-navigation">
            <h2 class="text-2xl font-semibold text-blue-900">System Navigation</h2>
            <p class="mt-4 text-gray-700"> You can access the Quick Navigation tool in the upper right corner by clicking on the three lined button.  Here's a quick description of each tool on this website:</p>
            <ul class="list-disc list-inside mt-4 text-gray-700">
                <li><strong>Dashboard:</strong> This is the home page where you can find an overview of the system.</li>
                <li><strong>Working with Records:</strong> In the Marketing Dashboard, you can manage three main types of records: Student, School, and User records.</li>
                <li><strong>Profile:</strong> Update your profile information and change your password.</li>
                <li><strong>Notification:</strong> View and manage system notifications.</li>
                <li><strong>Statistics:</strong> View data and statistics related to student, school, and user records.</li>
                <li><strong>Map:</strong> Access geographical information for targeted schools and cities.</li>

            </ul>
        </section>
        <!-- Sections with Unique IDs -->
        <section class="mb-10" id="getting-started">
            <h2 class="text-2xl font-semibold text-blue-900">Getting Started</h2>
            <p class="mt-4 text-gray-700">Welcome to the Marketing Dashboard! To get started, follow these simple steps:</p>

            <ol class="list-decimal list-inside mt-4 text-gray-700">
                <li>Log in using your registered username and password.</li>
                <img src="{{ asset('image/login.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

         
            </ol>
        </section>

    

       

       
        <section class="mb-10" id="Dashboard">
            <h2 class="text-2xl font-semibold text-blue-900">Dashboard</h2>
            <ol class="list-decimal list-inside mt-4 text-gray-700">
               
                <img src="{{ asset('image/dashboard.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

                <li>Once logged in, you will see the dashboard.</li>
                <li>If you need to switch between sections, click on the sidebar toggle button to open/close the sidebar.</li>
            </ol>
        </section>

        <section class="mb-10" id="working-with-records">
            <h2 class="text-2xl font-semibold text-blue-900">Working with Records</h2>
            <p class="mt-4 text-gray-700">In the Marketing Dashboard, you can work with three main types of records:</p>
            <ul class="list-disc list-inside mt-4 text-gray-700">
                <li><strong>Student Records:</strong> View and manage student data. Generate form links, add new courses, and new strands.</li>
                <li><strong>School Records:</strong> View and manage school data. Add new target schools and cities.</li>
                <li><strong>User Records:</strong> View and manage user information. Add new login records.</li>
            </ul>
        </section>
        
        <section class="mb-10" id="dashboard">
            <h2 class="text-2xl font-semibold text-blue-900">Student Records</h2>
            <ol class="list-decimal list-inside mt-4 text-gray-700">
            <p class="mt-4 text-gray-700">The "Student Records" is located here:</p>
                <img src="{{ asset('image/gotostudent.png') }}" alt="Getting Started" > <!-- Example image for illustration -->
            </ol>
        </section>
        <section class="mb-10" id="dashboard">
            <h2 class="text-2xl font-semibold text-blue-900">Student List</h2>
            <ol class="list-decimal list-inside mt-4 text-gray-700">
            <li>Once "Students Records" button is clicked. You will see this "Students List" page. Now, you can view and manage data, create new student profiles, export data into a PDF format, delete selected records, send emails to students, and send SMS messages to students from this section.</li>
                <img src="{{ asset('image/studentarea.png') }}" alt="Getting Started" > <!-- Example image for illustration -->
            </ol>
            </section>
            <section class="mb-10" id="dashboard">
                <h2 class="text-2xl font-semibold text-blue-900">Generate Form Link</h2>
                <p class="mt-4 text-gray-700">Here is the Generate Form link</p>
                <ol class="list-decimal list-inside mt-4 text-gray-700">
                    <img src="{{ asset('image/gotolink.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

                </ol>
            </section>
            <section class="mb-10" id="dashboard">
                <ol class="list-decimal list-inside mt-4 text-gray-700">
                    <li>Once the "Generate Form Link" is clicked, this will show up</li>
                    <img src="{{ asset('image/linkarea.png') }}" alt="Getting Started" > <!-- Example image for illustration -->
                    <li>After that, click the "Generate New Link" button to generate a link </li>
                    <li>After that, it will generate a new link. Then, you can choose from the options below the Actions menu. You can deactivate the link, set a date or time for when you want the link to expire, or delete the link. </li>
                </ol>
        </section>
        <section class="mb-10" id="dashboard">
            <h2 class="text-2xl font-semibold text-blue-900">Add New Course</h2>
            <p class="mt-4 text-gray-700">The "Add New Course" is located here</p>
            <ol class="list-decimal list-inside mt-4 text-gray-700">
                <li>Click the Button</li>
                <img src="{{ asset('image/gotocourse.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

                <li>When button is clicked, u would need to type the name of the course on the textfield, then click the "Add New Course" button to add the course you've typed.</li>
                <img src="{{ asset('image/coursearea.png') }}" alt="Getting Started" > <!-- Example image for illustration -->
            </ol>
    </section>
    <section class="mb-10" id="dashboard">
        <h2 class="text-2xl font-semibold text-blue-900">Add new strand</h2>
        <p class="mt-4 text-gray-700">Here is the Add New Strand</p>
        <ol class="list-decimal list-inside mt-4 text-gray-700">
            <li>Click the button</li>
            <img src="{{ asset('image/gotostrand.png') }}" alt="Getting Started" > <!-- Example image for illustration -->
            <li>Once clicked, please fill in the textfield the name of the strand u want to put then click the "Add New Strand button." </li>
            <img src="{{ asset('image/strandarea.png') }}" alt="Getting Started" > <!-- Example image for illustration -->
        </ol>
    </section>
   
        <section class="mb-10" id="dashboard">
            <h2 class="text-2xl font-semibold text-blue-900">School Records</h2>
            <p class="mt-4 text-gray-700">Here is the School Records</p>
            <ol class="list-decimal list-inside mt-4 text-gray-700">
                <li>Click the button.</li>
                <img src="{{ asset('image/gotoschool.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

                <li>Once clicked, you can view and manage data, add new schools, export data into a PDF format, delete selected records, send emails to schools, or search school data in your system. </li>
              
                <img src="{{ asset('image/schoolarea.png') }}" alt="Getting Started" > <!-- Example image for illustration -->
            </ol>
        </section>
        <section class="mb-10" id="dashboard">
            <h2 class="text-2xl font-semibold text-blue-900">Add Target School</h2>
            <p class="mt-4 text-gray-700">Here is the Add target school</p>
            <ol class="list-decimal list-inside mt-4 text-gray-700">
                <li>Click the button.</li>
                <img src="{{ asset('image/gototargetschool.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

                <li>Once clicked, fill the text fields with the corresponding info that is needed, then click "Add School."</li>

                <img src="{{ asset('image/targetschoolarea.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

            </ol>
        </section>
        <section class="mb-10" id="dashboard">
            <h2 class="text-2xl font-semibold text-blue-900">Add Target Cities</h2>
            <p class="mt-4 text-gray-700">Here is the Add Target Cities</p>
            <ol class="list-decimal list-inside mt-4 text-gray-700">
                <li>Click the button.</li>
                <img src="{{ asset('image/gototargetcities.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

                <li>Once clicked, Fill the textfield then click the Add Target City button.</li>
           
                <img src="{{ asset('image/targetcitiesarea.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

            </ol>
        </section>
        <section class="mb-10" id="dashboard">
            <h2 class="text-2xl font-semibold text-blue-900">User Records</h2>
            <p class="mt-4 text-gray-700">Here is the User Records</p>
            <ol class="list-decimal list-inside mt-4 text-gray-700">
                <li>Click the button.</li>
                <img src="{{ asset('image/gotouser.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

               
                <li>Once clicked, you can view and manage data, add new users, export data into a PDF format, delete selected records, or search user data in your system.</li>
                <img src="{{ asset('image/userarea.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

                
            </ol>
        </section>
        <section class="mb-10" id="dashboard">
            <h2 class="text-2xl font-semibold text-blue-900">Add Login Record (Admin Privelege)</h2>
            <p class="mt-4 text-gray-700">Here is the Add login record</p>
            <ol class="list-decimal list-inside mt-4 text-gray-700">
                <li>Click the button.</li>
                <img src="{{ asset('image/gotoaddloginrecord.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

                <li>Once clicked, fill in the corresponding info, then u can choose if u want to set the Role to Admin or User, then click the Submit button.</li>
                
                <img src="{{ asset('image/addloginrecordarea.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

    
            </ol>
        </section>
        <section class="mb-10" id="Profile">
            <h2 class="text-2xl font-semibold text-blue-900">Profile</h2>
            <p class="mt-4 text-gray-700">Here is the Profile</p>
            <ol class="list-decimal list-inside mt-4 text-gray-700">
                <li>Click the Profile button on the sidebar.</li>
                <img src="{{ asset('image/gotoprofile.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

                <li>Once clicked, you can freely view the Profile Information</li>
               
                <img src="{{ asset('image/profilearea.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

            </ol>
        </section>
        <section class="mb-10" id="Notification">
            <h2 class="text-2xl font-semibold text-blue-900">Notification</h2>
            <p class="mt-4 text-gray-700">Here is the Notification</p>
            <ol class="list-decimal list-inside mt-4 text-gray-700">
                <li>Click the Norification button on the Sidebar</li>
                <img src="{{ asset('image/gotonotification.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

                <li>Once Clicked, you can freely view , marked as read and Delete the Notifications if u want.</li>
             
                <img src="{{ asset('image/notificationarea.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

            </ol>
        </section>
        <section class="mb-10" id="Statistics">
            <h2 class="text-2xl font-semibold text-blue-900">Statistics</h2>
            <p class="mt-4 text-gray-700">Here is the Statistics Page</p>
            <ol class="list-decimal list-inside mt-4 text-gray-700">
                <li> Click the Statistics Page on the sidebar.</li>
                <img src="{{ asset('image/gotostatistics.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

                <li>Once clicked, you can show students by school , show top courses  and hide total students this is great for data visualization.</li>
                
                <img src="{{ asset('image/statisticsarea.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

               
            </ol>
        </section>
        <section class="mb-10" id="Map">
            <h2 class="text-2xl font-semibold text-blue-900">Map</h2>
            <p class="mt-4 text-gray-700">Here is the Map</p>
            <ol class="list-decimal list-inside mt-4 text-gray-700">
                <li>Click the Map button on the sidebar.</li>
                <img src="{{ asset('image/gotomap.png') }}" alt="Getting Started" > <!-- Example image for illustration -->

                
                <li>Once clicked, u can Select the City and Select the Barangay then it will pinpoint the location on the map, and u can also show your own location so you would know the distance of the school from you. </li>
                <img src="{{ asset('image/maparea.png') }}" alt="Getting Started" > <!-- Example image for illustration -->
            </ol>
        </section>
       
    </div>

   <!-- JavaScript for Smooth Scrolling and Sidebar Toggle -->
   <script>
        function scrollToSection(sectionId) {
            const section = document.querySelector(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        }

        function toggleSidebar() {
            const sidebar = document.getElementById('rightSidebar');
            sidebar.classList.toggle('hidden'); /* Toggle sidebar visibility */
        }
    </script>

</body>
</html>
