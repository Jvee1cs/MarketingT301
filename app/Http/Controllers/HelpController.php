<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    //
    public function index()
{
    return view('HELP'); // Assuming there's a 'help.blade.php' view file
}

}
