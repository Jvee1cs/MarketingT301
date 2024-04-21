<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Support\Facades\Auth; // Add this line
use Illuminate\Foundation\Validation\ValidatesRequests; // Add this line
use App\Exports\StudentExport;
use App\Models\Cities;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
class SchoolController extends Controller
{
    public function index()
    {

        $schools = School::paginate(10); // 10 users per page
        return view('schools.index', compact('schools'));
    }

    public function create()
    {
        return view('schools.create');
    }

    public function city()
    {
        return view('schools.city');
    }

    public function stored(Request $request)
    {
        $request->validate([

            'city' => 'required|string',

        ]);

            Cities::create($request->all());

            return redirect()->route('schools.index')
                ->with('success', 'School created successfully');

    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'principal' => 'required|string',
            'contact' => 'required|string',

            // Add more validation rules as needed
        ]);

        School::create($request->all());

        return redirect()->route('schools.index')
            ->with('success', 'School created successfully');
    }

    public function show(School $school)
    {
        return view('schools.show', compact('school'));
    }

    public function edit(School $school)
    {
        return view('schools.edit', compact('school'));
    }

    public function update(Request $request, School $school)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'principal' => 'required|string',
            'contact' => 'required|string',
            // Add more validation rules as needed
        ]);

        $school->update($request->all());

        return redirect()->route('schools.index')
            ->with('success', 'School updated successfully');
    }

    public function destroy(School $school)
    {


        $school->delete();
        return response()->json(['message' => 'School deleted successfully']);
    }

    public function export(Request $request)
{// Retrieve selected school IDs from the form
    $selectedSchoolIds = $request->input('selected_schools', []);

    // Retrieve school based on the selected IDs
    $schools = School::whereIn('id', $selectedSchoolIds)->get();

    // Create a new PDF instance
    $pdf = new Dompdf();

    // Set options for PDF rendering
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $pdf->setOptions($options);

    // Start buffering the output
    // Begin PDF content
echo "<h1>School List</h1>";
echo "<table border='1' cellpadding='5'>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Username</th>
        <th>Password</th>
        <th>Email</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>";

foreach ($schools as $school) {
    echo "<tr>
        <td>{$school->id}</td>
        <td>{$school->name}</td>
        <td>{$school->username}</td>
        <td>{$school->password}</td>
        <td>{$school->email}</td>
        <td>{$school->created_at}</td>
        <td>{$school->updated_at}</td>
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
    return $pdf->stream('school.pdf');
}

public function bulkDelete(Request $request)
    {
        $schoolIds = $request->input('school_ids');

        // Perform validation if needed

        School::whereIn('id', $schoolIds)->delete();

        return response()->json(['message' => 'Schools deleted successfully'], 200);
    }
}
