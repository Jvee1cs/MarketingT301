<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests; // Add this line
use App\Models\User;

class UserController extends Controller
{
    use ValidatesRequests; // Add this line

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
            'email' => 'required|email|unique:users',
        ]);

        // Create the user
        User::create($request->all());

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
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        // Update the user
        $user->update($request->all());

        return redirect()->route('users.index');
    }

    // Destroy method for removing the specified user from the database
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
