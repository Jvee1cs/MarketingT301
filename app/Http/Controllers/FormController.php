<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\Course;
use App\Models\Strand;

class FormController extends Controller
{

    public function index()
    {
        // Optionally retrieve data to pass to the view
        // For example:
        // $someData = SomeModel::all();

        return view('normform.index'); // Return the 'index.blade.php' view
    }
    
    public function indexCities()
    {
        $cities = Cities::all();
        return view('normform.index', compact('cities'));
    }

    public function destroyCities(Cities $city)
    {
        $city->delete();
        return redirect()->route('normform.cities')->with('success', 'City deleted successfully.');
    }

    public function indexCourse()
    {
        $course = Course::all();
        return view('normform.index', compact('course'));
    }

    public function destroyCourse(Course $course)
    {
        $course->delete();
        return redirect()->route('normform.course')->with('success', 'Course deleted successfully.');
    }

    public function indexStrand()
    {
        $strand = Strand::all();
        return view('normform.index', compact('strand'));
    }

    public function destroyStrand(Strand $strand)
    {
        $strand->delete();
        return redirect()->route('normform.strand')->with('success', 'Strand deleted successfully.');
    }
}
