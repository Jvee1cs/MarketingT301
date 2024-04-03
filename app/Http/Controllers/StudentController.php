<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\School;

use Illuminate\Support\Facades\Auth; // Add this line
use Illuminate\Foundation\Validation\ValidatesRequests; // Add this line
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     *
     * @return \Illuminate\Http\Response
     */
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

        Student::create($request->all());

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
}
