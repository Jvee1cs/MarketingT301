<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Login;
class AdminController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Handle login
    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Logic for authenticating the admin user
        // You can use Laravel's authentication mechanisms here

        // If authentication succeeds, redirect the user
        // Replace 'dashboard' with the actual route you want to redirect to
        return redirect()->route('admin.dashboard');
    }

    // Show dashboard
    public function dashboard()
    {
        return view('dashboard/dashboard');
    }

    public function save(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'username' => 'required|string',
        'password' => 'required|string',
        // Add more validation rules as needed
    ]);

    Login::create([
        'name' => $request->input('name'),
        'username' => $request->input('username'),
        'password' => $request->input('password'),
        // Assign other fields similarly
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Record created successfully!');
}
public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Assuming you are using a custom guard named 'admin'
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Redirect to the login page after logout
    }
}
