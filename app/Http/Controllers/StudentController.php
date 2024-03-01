<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TargetSchool;
use App\Models\Student;
 // Assuming you have a TargetSchool model

class StudentController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function StudentRecord()
    {
        // Retrieve all students from the database
        $students = Student::all();

        // Return the view with the students data
        return view('students.StudentRecords', compact('students'));
    }

    public function showRegistrationForm()
    {
        // You can pass data to the view if needed
        return view('dashboard\student-registration');
    }

    public function submitRegistrationForm(Request $request)
    {
        // Handle form submission
        // Use Eloquent ORM to interact with your database
        // Example:
        $schoolNames = TargetSchool::distinct()->pluck('school_name');

        // Process form data and save to the database

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
    public function index()
    {
        // Your logic to fetch and display student records goes here
        return view('student.records'); // Assuming you have a Blade view named 'student.records'
        // Your logic to fetch and display school records goes here
        return view('school.records'); // Assuming you have a Blade view named 'school.records'
    }

    public function registration(){
        return view('students.registration');
    }

    public function create(){
        return view('students.create');
    }

    public function store(Request $request){
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
        'email_address' => 'required|string',
        'fbaccount' => 'required|string',
       ]);

       Student::create([
        'stud_first_name' => $request->input('stud_first_name'),
        'stud_last_name' => $request->input('stud_last_name'),
        'stud_middle_name' => $request->input('stud_middle_name'),
        'phone' => $request->input('phone'),
        'address' => $request->input('address'),
        'city' => $request->input('city'),
        'grade_level' => $request->input('grade_level'),
        'strand' => $request->input('strand'),
        'course' => $request->input('course'),
        'school_name' => $request->input('school_name'),
        'g_name' => $request->input('g_name'),
        'g_phone' => $request->input('g_phone'),
        'g_relationship' => $request->input('g_relationship'),
        'email_address' => $request->input('email_address'),
        'fbaccount' => $request->input('fbaccount'),
    ]);

       return redirect(route('student.registration'));
    }


}
