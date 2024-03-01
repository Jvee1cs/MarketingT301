<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TargetSchool; // Assuming you have a TargetSchool model

class StudentController extends Controller
{
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
    
}