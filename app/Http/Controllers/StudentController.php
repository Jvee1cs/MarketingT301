<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     *
     * @return \Illuminate\Http\Response
     */
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


    public function index()
    {
        $students = Student::all();
        $students = Student::paginate(10); // 10 users per page
        return view('students.index', compact('students'));
    }
    public function StudentRecord() {
        $students = Student::all();
        return view('students.index', compact('students'));
        // Your logic here
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
        $schools = School::pluck('name', 'id');
        return view('students.create', compact('schools'));
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
    {// Retrieve selected student IDs from the form
        $selectedstudentIds = $request->input('selected_students', []);
    
        // Retrieve students based on the selected IDs
        $students = student::whereIn('id', $selectedstudentIds)->get();
    
        // Create a new PDF instance
        $pdf = new Dompdf();
    
        // Set options for PDF rendering
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $pdf->setOptions($options);
    
        // Start buffering the output
        // Begin PDF content
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
