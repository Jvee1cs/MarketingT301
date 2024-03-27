<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line
use Illuminate\Foundation\Validation\ValidatesRequests; // Add this line
use App\Models\User;

class UserController extends Controller
{
    use ValidatesRequests; // Add this line

    // Method to display the login form
    public function showLoginForm()
    {
        return view('login/index');
    }

    // Method to handle the login request
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password'); // Change 'email' to 'username'

        // Authentication
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('admin.dashboard'); // Change 'dashboard' to your desired route
        } else {
            // Authentication failed...
            return back()->withErrors(['username' => 'Invalid credentials']); // Change 'email' to 'username'
        }
    }

    // Show dashboard
    public function dashboard()
    {
        return view('dashboard.dashboard');
    }

    // Method to handle the logout request
    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login'); // Redirect to the login route
    }

    // Index method for displaying all users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Create method for displaying the form to create a new user
    public function create()
    {
        return view('users.create');
    }

    // Store method for storing a newly created user in the database
    public function store(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users', // Change 'email' to 'username'
            'password' => 'required|min:5',
        ]);

        // Hash the password before storing the user
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);

        // Create the user
        User::create($data);

        return redirect()->route('users.index');
    }

    // Show method for displaying the specified user
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Edit method for displaying the form to edit the specified user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update method for updating the specified user in the database
    public function update(Request $request, User $user)
    {
        // Validate the request
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$user->id,
        ]);

        // Update the user data
        $data = $request->all();

        // Hash the password if it's included in the request
        if ($request->has('password')) {
            $data['password'] = bcrypt($data['password']);
        }

        // Update the user
        $user->update($data);

        return redirect()->route('users.index');
    }

    // Destroy method for removing the specified user from the database
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
