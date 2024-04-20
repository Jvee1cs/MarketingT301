<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Statistics</title>
    <!-- Include Bootstrap for styling -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .chart-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-3xl font-semibold mb-4 text-center text-blue-900">Submission Statistics</h1>
        <button id="toggleTotalStudents" class="text-white bg-blue-500 hover:bg-blue-600 py-1 px-4 rounded mb-1" onclick="toggleVisibility('totalStudents')" data-name="Total Students">Hide Total Students</button>
        <button id="toggleStudentsBySchool" class="text-white bg-blue-500 hover:bg-blue-600 py-1 px-4 rounded mb-1" onclick="toggleVisibility('studentsBySchool')" data-name="Students by School">Show Students by School</button>
        <button id="toggleTopCourses" class="text-white bg-blue-500 hover:bg-blue-600 py-1 px-4 rounded mb-1" onclick="toggleVisibility('topCourses')" data-name="Top Courses">Show Top Courses</button>
        
        <div id="totalStudents" class="mb-4">
    </br>
            <p class="lead text-xl font-semibold mb-4 text-blue-900 text-center">Total Number of Students Submitted: <strong>{{ $totalStudents }}</strong></p>
            <div class="chart-container">
                <canvas id="gradeLevelChart" width="400" height="200"></canvas>
            </div>
            <ul class="list-group">
                @foreach ($studentsByGradeLevel as $student)
                    <li class="list-group-item">Grade {{ $student->grade_level }}: <strong>{{ $student->total_students }}</strong></li>
                @endforeach
            </ul>
        </div>

        <div id="studentsBySchool" class="mb-4" style="display: none;">
        </br>
            <h2 class="text-xl font-semibold mb-4 text-blue-900 text-center">Number of Students Submitted by School</h2>
            
            <div class="chart-container">
            <canvas id="schoolDistributionChart" width="100" height="100"></canvas>
            </div>
            <ul class="list-group">
                @foreach ($studentsBySchool as $school)
                    <li class="list-group-item">{{ $school->school_name }}: <strong>{{ $school->total_students }}</strong></li>
                @endforeach
            </ul>
           
        </div>

        <div id="topCourses" class="mb-4" style="display: none;">
        </br>
            <h2 class="text-xl font-semibold mb-4 text-blue-900 text-center">Top Courses Chosen by Students</h2>
            <div class="chart-container">
                <canvas id="topCoursesChart" width="400" height="200"></canvas>
            </div>
            <ul class="list-group">
                @foreach ($topCourses as $course)
                    <li class="list-group-item">{{ $course->course }}: <strong>{{ $course->total_students }}</strong></li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        function toggleVisibility(elementId) {
            var element = document.getElementById(elementId);
            var button = document.getElementById('toggle' + elementId.charAt(0).toUpperCase() + elementId.slice(1));
            if (element.style.display === 'none') {
                element.style.display = 'block';
                button.textContent = 'Hide ' + button.dataset.name;
            } else {
                element.style.display = 'none';
                button.textContent = 'Show ' + button.dataset.name;
            }
        }

        // Prepare data for charts
        var grades = [];
        var totalStudents = [];
        @foreach ($studentsByGradeLevel as $grade)
            grades.push('Grade {{ $grade->grade_level }}');
            totalStudents.push({{ $grade->total_students }});
        @endforeach

        var schoolNames = [];
        var studentsBySchool = [];
        @foreach ($studentsBySchool as $school)
            schoolNames.push('{{ $school->school_name }}');
            studentsBySchool.push({{ $school->total_students }});
        @endforeach

        var courses = [];
        var studentsByCourse = [];
        @foreach ($topCourses as $course)
            courses.push('{{ $course->course }}');
            studentsByCourse.push({{ $course->total_students }});
        @endforeach

        // Render charts
        var ctxGradeLevel = document.getElementById('gradeLevelChart').getContext('2d');
        var chartGradeLevel = new Chart(ctxGradeLevel, {
    type: 'bar',
    data: {
        labels: grades,
        datasets: [{
            label: 'Students by Grade Level',
            data: totalStudents,
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

        var ctxSchoolDistribution = document.getElementById('schoolDistributionChart').getContext('2d');
        var chartSchoolDistribution = new Chart(ctxSchoolDistribution, {
    type: 'pie',
    data: {
        labels: schoolNames,
        datasets: [{
            label: 'Students by School',
            data: studentsBySchool,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)',
                'rgba(255, 159, 64, 0.5)'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});


        var ctxTopCourses = document.getElementById('topCoursesChart').getContext('2d');
        var chartTopCourses = new Chart(ctxTopCourses, {
    type: 'bar',
    data: {
        labels: courses,
        datasets: [{
            label: 'Top Courses Chosen by Students',
            data: studentsByCourse,
            backgroundColor: 'rgba(255, 159, 64, 0.5)',
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
    </script>
</body>
</html>
