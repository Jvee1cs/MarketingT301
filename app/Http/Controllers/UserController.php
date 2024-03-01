<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the user records.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Your logic to fetch and display user records goes here
        return view('user.records'); // Assuming you have a Blade view named 'user.records'
    }
    public function store(Request $request)
    {
        // Your logic to store the user record goes here
        // For example:
        // User::create($request->all());

        // Redirect to a suitable route after adding the record
        return redirect()->back()->with('success', 'User record added successfully!');
    }
}
