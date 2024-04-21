<?php

namespace App\Http\Controllers;
use Twilio\Exceptions\RestException;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\School;
use Illuminate\Support\Str; // Add this line
use Illuminate\Support\Facades\Auth; // Add this line
use Illuminate\Foundation\Validation\ValidatesRequests; // Add this line
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use QrCode;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Notifications\StudentCreatedNotification;
use App\Notifications\StudentDeletedNotification;
use App\Notifications\StudentUpdatedNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentEmail;
use App\Models\Cities;
use App\Models\Course;
use App\Models\Strand;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     *
     * @return \Illuminate\Http\Response
     */

      public function sendSMS(Request $request)
    {
        // Validate the request data
    $request->validate([
        'selected_students' => 'required|array',
        'selected_students.*' => 'exists:students,id',
        'sms_message' => 'required|string|max:160', // Adjust the max length as per your SMS service provider's limitations
    ]);

    // Get the selected student IDs from the request
    $selectedStudents = $request->input('selected_students');

    // Fetch the students from the database
    $students = Student::whereIn('id', $selectedStudents)->get();

    // Initialize Twilio client with your Twilio credentials
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_AUTH_TOKEN');
    $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');
    $twilio = new Client($sid, $token);

    // Loop through the selected students and send SMS message to each one
    foreach ($students as $student) {
        try {
            // Prepend the country code for the Philippines ('+63') to the phone number
            $phoneNumber = '+63' . substr($student->phone, 1);

            $twilio->messages->create(
                $phoneNumber, // Student's phone number with country code
                [
                    'from' => $twilioPhoneNumber, // Your Twilio phone number
                    'body' => $request->input('sms_message'),
                ]
            );
        } catch (RestException $e) {
            // Log any errors that occur during SMS sending
            \Log::error('Error sending SMS to student ' . $student->id . ': ' . $e->getMessage());
            // Optionally, you can handle errors here based on your application's requirements
        }
    }

    // Redirect back or to a specific route after sending the SMS messages
    return redirect()->back()->with('status', 'SMS messages sent successfully');
    }

    // Other controller methods...



    public function sendEmail(Request $request)
    {
        // Validate the request data
        $request->validate([
            'selected_students' => 'required|array',
            'selected_students.*' => 'exists:students,id',
        ]);

        // Get the selected student IDs from the request
        $selectedStudents = $request->input('selected_students');

        // Fetch the students from the database
        $students = Student::whereIn('id', $selectedStudents)->get();

        // Loop through the selected students and send email to each one
        foreach ($students as $student) {
            Mail::to($student->email_address)->send(new StudentEmail($student));
        }

        // Redirect back or to a specific route after sending the emails
        return redirect()->back()->with('status', 'Emails sent successfully');
    }


    public function index(Request $request)
{
    // Retrieve the search query from the request
    $searchQuery = $request->input('search');

    // Retrieve the selected school filter
    $selectedSchool = $request->input('school_filter');

    // Query students and filter based on the search query and selected school
    $studentsQuery = Student::query();

    if ($searchQuery) {
        $studentsQuery->where(function($query) use ($searchQuery) {
            $query->where(DB::raw("CONCAT(stud_first_name, ' ', stud_last_name)"), 'like', '%' . $searchQuery . '%')
                  ->orWhere('email_address', 'like', '%' . $searchQuery . '%')
                  ->orWhere('phone', 'like', '%' . $searchQuery . '%');
        });
    }

    if ($selectedSchool) {
        $studentsQuery->where('school_name', $selectedSchool);
    }

    // Paginate the filtered students
    $students = $studentsQuery->orderBy('stud_first_name')->paginate(15);

    // Fetch distinct school names from the database
    $schools = Student::distinct()->pluck('school_name');

    // Pass data to the view
    return view('students.index', compact('students', 'schools', 'searchQuery', 'selectedSchool'));
}

    public function StudentRecord() {
        $students = Student::all();
        return view('students.index', compact('students'));
        // Your logic here
    }

    public function course()
    {
        return view('students.course');
    }

    public function stored(Request $request)
    {
        $request->validate([

            'course' => 'required|string',

        ]);

            Course::create($request->all());

            return redirect()->route('students.records')
                ->with('success', 'Course created successfully');

    }

    public function strand()
    {
        return view('students.strand');
    }

    public function stores(Request $request)
    {
        $request->validate([

            'strand' => 'required|string',

        ]);

            Strand::create($request->all());

            return redirect()->route('students.records')
                ->with('success', 'Strand created successfully');

    }

    /**
     * Show the form for creating a new student.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
{
    return view('students.show', compact('student'));
}

    public function create()
    {
        // Fetch all school names from the database
        $strands = Strand::pluck('strand', 'id');
        $courses = Course::pluck('course', 'id');
        $cities = Cities::pluck('city', 'id');
        $schools = School::pluck('name', 'id');
        return view('students.create', compact('schools','cities','courses','strands'));
    }

    /**
     * Store a newly created student in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'stud_first_name' => 'required|string',
            'stud_last_name' => 'required|string',
            'stud_middle_name' => 'required|string',
            'phone' => 'required|string|max:11',
            'address' => 'required|string',
            'city' => 'required|string',
            'grade_level' => 'required|integer',
            'strand' => 'required|string',
            'course' => 'required|string',
            'school_name' => 'required|string',
            'g_name' => 'required|string',
            'g_phone' => 'required|string|max:11',
            'g_relationship' => 'required|string',
            'email_address' => 'required|string|email',
            'fbaccount' => 'required|string',
        ]);

        $student = Student::create($request->all());

        // Trigger the notification
        $user = auth()->user();
        $user->notify(new StudentCreatedNotification($student));
        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Show the form for editing the specified student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'stud_first_name' => 'required|string',
            'stud_last_name' => 'required|string',
            'stud_middle_name' => 'required|string',
            'phone' => 'required|string|max:11',
            'address' => 'required|string',
            'city' => 'required|string',
            'grade_level' => 'required|integer',
            'strand' => 'required|string',
            'course' => 'required|string',
            'school_name' => 'required|string',
            'g_name' => 'required|string',
            'g_phone' => 'required|string|max:11',
            'g_relationship' => 'required|string',
            'email_address' => 'required|string|email',
            'fbaccount' => 'required|string',

        ]);

        $student = Student::findOrFail($id);
        $student->update($request->all());

        auth()->user()->notify(new StudentUpdatedNotification($student));

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
         // Trigger the notification
         $user = auth()->user();
         $user->notify(new StudentDeletedNotification($student));
        return response()->json(['message' => 'Student deleted successfully']);

    }
    public function export(Request $request)
<<<<<<< HEAD
    {// Retrieve selected student IDs from the form
        $selectedstudentIds = $request->input('selected_students', []);

        // Retrieve students based on the selected IDs
        $students = student::whereIn('id', $selectedstudentIds)->get();

        // Create a new PDF instance
        $pdf = new Dompdf();

=======
    {
        // Retrieve selected student IDs from the form
        $selectedStudentIds = $request->input('selected_students', []);
        
        // Retrieve students based on the selected IDs
        $students = Student::whereIn('id', $selectedStudentIds)->get();
        
        // Create a new PDF instance
        $pdf = new Dompdf();
        
>>>>>>> b6f9231f065b19c639309a6358e04b323806da93
        // Set options for PDF rendering
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $pdf->setOptions($options);
<<<<<<< HEAD

=======
        
>>>>>>> b6f9231f065b19c639309a6358e04b323806da93
        // Start buffering the output
        ob_start(); // To capture output in a buffer
        
        // Begin PDF content
<<<<<<< HEAD
    echo "<h1>student List</h1>";
    echo "<table border='1' cellpadding='5'>
        <tr>
            <th>ID</th>
            <th>stud_last_name</th>
            <th>stud_first_name</th>
            <th>stud_middle_name</th>
            <th>address</th>
            <th>city</th>
            <th>grade_level</th>
        </tr>";

    foreach ($students as $student) {
        echo "<tr>
            <td>{$student->id}</td>
            <td>{$student->stud_last_name}</td>
            <td>{$student->stud_first_name}</td>
            <td>{$student->stud_middle_name}</td>
            <td>{$student->address}</td>
            <td>{$student->city}</td>
            <td>{$student->grade_level}</td>
        </tr>";
    }
    echo "</table>";
        // End buffering and assign the content to a variable
        $html = ob_get_clean();

        // Load HTML content into the PDF
        $pdf->loadHtml($html);

        // Set paper size and orientation
        $pdf->setPaper('A4', 'landscape');

        // Render the PDF
        $pdf->render();

        // Output the PDF to the browser
        return $pdf->stream('students.pdf');
    }

=======
        echo "<h1>Student List</h1>";
        echo "<table border='1' cellpadding='5'>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Grade Level</th>
                <th>Strand</th>
                <th>Course</th>
                <th>School Name</th>
                <th>Email Address</th>
                <th>Phone no.</th>


            </tr>";
        
        foreach ($students as $student) {
            // Concatenate first name and last name to create a full name
            $fullName = "{$student->stud_first_name} {$student->stud_middle_name} {$student->stud_last_name}";
    
            echo "<tr>
                <td>{$student->id}</td>
                <td>{$fullName}</td>
                <td>{$student->address}</td>
                <td>{$student->city}</td>
                <td>{$student->grade_level}</td>
                <td>{$student->strand}</td>
                <td>{$student->course}</td>
                <td>{$student->school_name}</td>
                <td>{$student->email_address}</td>
                <td>{$student->phone}</td>
            </tr>";
        }
        
        echo "</table>";
        
        // End buffering and assign the content to a variable
        $html = ob_get_clean(); // Retrieve the content from the buffer
        
        // Load HTML content into the PDF
        $pdf->loadHtml($html);
        
        // Set paper size and orientation
        $pdf->setPaper('A4', 'landscape');
        
        // Render the PDF
        $pdf->render();
        
        // Output the PDF to the browser
        return $pdf->stream('students.pdf');
    }
>>>>>>> b6f9231f065b19c639309a6358e04b323806da93
    public function bulkDelete(Request $request)
        {
            $studentIds = $request->input('student_ids');

            // Perform validation if needed

            student::whereIn('id', $studentIds)->delete();

            return response()->json(['message' => 'students deleted successfully'], 200);
        }
        public function statistics()
{
   // Total number of students submitted
   $totalStudents = Student::count();

   // Number of students submitted by school
   $studentsBySchool = Student::select('school_name', DB::raw('count(*) as total_students'))
       ->groupBy('school_name')
       ->orderBy('total_students', 'desc')
       ->limit(50)
       ->get();

   // Distribution of students by grade level
   $studentsByGradeLevel = Student::select('grade_level', DB::raw('count(*) as total_students'))
       ->groupBy('grade_level')
       ->orderBy('grade_level')
       ->get();

   // Top courses chosen by students
   $topCourses = Student::select('course', DB::raw('count(*) as total_students'))
       ->groupBy('course')
       ->orderBy('total_students', 'desc')
       ->limit(5)
       ->get();

   // Submission trend data (assuming you have a created_at field in the Student model)
   $submissionTrend = Student::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
       ->groupBy('date')
       ->orderBy('date')
       ->get();

    // Pass data to the view and load the view
    return view('submission_statistics', compact('totalStudents', 'studentsBySchool', 'studentsByGradeLevel', 'topCourses', 'submissionTrend'));
}
}
