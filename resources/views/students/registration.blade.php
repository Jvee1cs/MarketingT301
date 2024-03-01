<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center h-screen">
    <img src="https://aics.edu.ph/wp-content/uploads/2018/10/logo_small.png" alt="Your Logo" class="mb-4">
    <h2 class="text-lg font-semibold text-gray-700 mb-2">Asian Institute in Computer Studies Bicutan</h2>
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800">Registration Successful!</h1>
    </div>

    <!-- JavaScript to trigger SweetAlert -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Congratulations!',
                text: 'You have been successfully registered.',
                showConfirmButton: false,
                timer: 2000,
                background: '#F3F4F6',
                customClass: {
                    popup: 'sweet-alert-popup',
                    title: 'sweet-alert-title',
                    content: 'sweet-alert-content',
                }
            });
        });
    </script>
</body>
</html>
