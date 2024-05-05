<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\School;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Cities;
use App\Models\Course;
use App\Models\Strand;
class LinkController extends Controller
{
    private function deleteExpiredLinks()
    {
        $expiredLinks = Link::where('expires_at', '<', Carbon::now())->get();

        foreach ($expiredLinks as $link) {
            $link->delete();
        }
    }
    public function generateLink()
    {
        // Delete expired links before generating a new one
        $this->deleteExpiredLinks();

        $uniqueIdentifier = Str::random(10);
        $expiresAt = now()->addHours(24);
        $qrCode = $this->generateQrCode(route('aics.create.unique', $uniqueIdentifier));

        $link = Link::create([
            'unique_identifier' => $uniqueIdentifier,
            'expires_at' => $expiresAt,
            'is_active' => true,
        ]);

        return view('/UniqueLink/generate-link', compact('qrCode', 'uniqueIdentifier', 'link'));
    }

    public function store(Request $request)
    {
        // Retrieve the user's IP address
        $userIP = $request->ip();

        // Check if the user's IP has already submitted the form
        $previouslySubmittedIP = Session::get('submitted_ip');
        if ($previouslySubmittedIP === $userIP) {
            // Handle case where user has already submitted the form
            return redirect()->route('already.create')->with('error', 'You have already submitted the form.');
        }

        // Validate the form data
        $validatedData = $request->validate([
            'stud_first_name' => 'required|string',
            'stud_last_name' => 'required|string',
            'stud_middle_name' => 'required|string',
            'phone' => 'required|string|max:11',
            'address' => 'required|string',
            'city' => 'required|string',
            'grade_level' => 'required|integer',
            'strand' => 'required|string',
            'course' => 'nullable|string',
            'school_name' => 'required|string',
            'g_name' => 'required|string',
            'g_phone' => 'required|string|max:11',
            'g_relationship' => 'required|string',
            'email_address' => 'required|string|email',
            'fbaccount' => 'required|string',
        ]);

        // Create the student record
        Student::create($validatedData);

        // Store the user's IP to prevent multiple submissions
        Session::put('submitted_ip', $userIP);

        // Redirect to the success route
        return redirect()->route('success')->with('success', 'Student created successfully.');
    }

    public function create()
    {
        // Fetch all school names from the database
        $strands = Strand::pluck('strand', 'id');
        $courses = Course::pluck('course', 'id');
        $cities = Cities::pluck('city', 'id');
        $schools = School::pluck('name', 'id');
        return view('/UniqueLink/aics', compact('schools','cities','courses','strands'));
    }

    private function generateQrCode($url)
    {
        // API endpoint for generating QR codes
        $apiEndpoint = 'https://api.qrserver.com/v1/create-qr-code/';

        // Parameters for the API request
        $params = [
            'data' => urlencode($url),
            'size' => '200x200', // QR code size
            'format' => 'png',   // QR code format
        ];

        // Construct the API request URL
        $requestUrl = $apiEndpoint . '?' . http_build_query($params);

        // Fetch the QR code image data
        return file_get_contents($requestUrl);
    }

    public function toggleActivation(Request $request, $uniqueIdentifier)
    {
        $link = Link::where('unique_identifier', $uniqueIdentifier)->firstOrFail();
        $link->is_active = !$link->is_active;
        $link->save();

        return redirect()->back()->with('message', 'Link activation toggled successfully.');
    }

  

    public function generateLinkPage()
    {
        $this->deleteExpiredLinks();
        return view('/UniqueLink/generate-link');
    }

    public function manageLinks()
    {
        $this->deleteExpiredLinks();
        $links = Link::all();
        return view('/UniqueLink/links', compact('links'));
    }

    public function delete(Link $link)
    {
        $link->delete();

        return redirect()->back()->with('message', 'Link deleted successfully.');
    }

    public function editExpiration(Request $request, $uniqueIdentifier)
    {
        $validatedData = $request->validate([
            'expires_at' => 'required|date',
        ]);

        $link = Link::where('unique_identifier', $uniqueIdentifier)->firstOrFail();
        $link->expires_at = $validatedData['expires_at'];
        $link->save();

        return redirect()->back()->with('message', 'Link expiration updated successfully.');
    }
}
