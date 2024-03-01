<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Store a newly created school record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Your logic to store the school record goes here
        // For example:
        // School::create($request->all());

        // Redirect to a suitable route after adding the record
        return redirect()->back()->with('success', 'School record added successfully!');
    }
}
