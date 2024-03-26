<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

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
        return view('students.create');
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
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
