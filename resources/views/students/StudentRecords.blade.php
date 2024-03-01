<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Records</title>
</head>
<body>
<table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <!-- Add more headers for other columns if needed -->
    </tr>
    @foreach($students as $student)
    <tr>
        <td>{{ $student->id }}</td>
        <td>{{ $student->stud_first_name }}</td>
        <td>{{ $student->stud_last_name }}</td>
        <!-- Add more columns if needed -->
    </tr>
    @endforeach
</table>

</body>
</html>
