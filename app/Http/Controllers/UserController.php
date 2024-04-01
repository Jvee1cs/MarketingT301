<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line
use Illuminate\Foundation\Validation\ValidatesRequests; // Add this line
use App\Models\User;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
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
    // Index method for displaying all users with search functionality
public function index(Request $request)
{
    // Retrieve the search query from the request
    $searchQuery = $request->input('search');

    // Query users and filter based on the search query
    $usersQuery = User::query();

    if ($searchQuery) {
        $usersQuery->where('name', 'like', '%' . $searchQuery . '%')
                   ->orWhere('username', 'like', '%' . $searchQuery . '%')
                   ->orWhere('email', 'like', '%' . $searchQuery . '%');
    }

    // Retrieve filtered users and sort them alphabetically by name
    $users = $usersQuery->orderBy('name')->get();

    // Retrieve all users if there's no search query provided
    if (!$searchQuery) {
        $users = User::all();
    }

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
            'password' => 'required',
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
        return response()->json(['message' => 'User deleted successfully']);
    }

    public function export(Request $request)
{// Retrieve selected user IDs from the form
    $selectedUserIds = $request->input('selected_users', []);

    // Retrieve users based on the selected IDs
    $users = User::whereIn('id', $selectedUserIds)->get();

    // Create a new PDF instance
    $pdf = new Dompdf();

    // Set options for PDF rendering
    $options = new Options();
    $options->set('defaultFont', 'Arial');
    $pdf->setOptions($options);

    // Start buffering the output
    // Begin PDF content
echo "<h1>User List</h1>";
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

foreach ($users as $user) {
    echo "<tr>
        <td>{$user->id}</td>
        <td>{$user->name}</td>
        <td>{$user->username}</td>
        <td>{$user->password}</td>
        <td>{$user->email}</td>
        <td>{$user->created_at}</td>
        <td>{$user->updated_at}</td>
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
    return $pdf->stream('users.pdf');
}

public function bulkDelete(Request $request)
    {
        $userIds = $request->input('user_ids');

        // Perform validation if needed

        User::whereIn('id', $userIds)->delete();

        return response()->json(['message' => 'Users deleted successfully'], 200);
    }
    
}

