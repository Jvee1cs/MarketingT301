<?php
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\LinkController;

use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Apply middleware to a group of routes

// Routes accessible only to Admin
Route::middleware(['auth', 'admin'])->group(function () {
    // Define routes accessible only to Admin
    // For example:
    Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
    // Add more routes accessible only to Admin here...
    // Define the route for school records
Route::get('/school/records', [SchoolController::class, 'index'])->name('school.records');
// Define the route for adding school records
Route::post('/school/add', [SchoolController::class, 'store'])->name('school.add');
// Routes for displaying and managing School records
Route::get('/schools', [SchoolController::class, 'index'])->name('schools.index');
Route::get('/schools/create', [SchoolController::class, 'create'])->name('schools.create');
Route::post('/schools', [SchoolController::class, 'store'])->name('schools.store');
Route::get('/schools/{school}', [SchoolController::class, 'show'])->name('schools.show');
Route::get('/schools/{school}/edit', [SchoolController::class, 'edit'])->name('schools.edit');
Route::put('/schools/{school}', [SchoolController::class, 'update'])->name('schools.update');
Route::get('/schools/create', [SchoolController::class, 'create'])->name('schools.create');
Route::post('/schools/bulk-delete',  [SchoolController::class, 'bulkDelete'])->name('schools.bulk-delete');
Route::post('/schools/export', [SchoolController::class, 'export'])->name('schools.export');
Route::delete('/schools/{school}', [SchoolController::class, 'destroy'])->name('schools.destroy');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');


// Define the route for user records

// Route for adding user records
Route::post('/user/add', [UserController::class, 'store'])->name('user.add');

// Routes for displaying and managing users records

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/user/records', [UserController::class, 'index'])->name('user.records');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::post('/users/bulk-delete',  [UserController::class, 'bulkDelete'])->name('users.bulk-delete');
Route::post('/users/export', [UserController::class, 'export'])->name('users.export');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');



});

// Routes accessible only to User
Route::middleware(['auth', 'user'])->group(function () {
    // Define routes accessible only to User
    // Add more routes accessible only to User here...
    Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    // Routes that require authentication

 // Define routes for authenticated users
 Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
 // Add more authenticated routes here...
// Define the route for registration
Route::get('/student/register', [StudentController::class, 'showRegistrationForm'])->name('student.register');
Route::post('/student/register', [StudentController::class, 'submitRegistrationForm'])->name('student.register.submit');
// Define the logout route for admin

Route::get('/student', [StudentController::class, 'registration'])->name('student.registration');

Route::post('/student', [StudentController::class, 'store'])->name('student.store');
// Route for displaying the form to edit a student

// Routes for displaying and managing student records
Route::get('/students/records', [StudentController::class, 'index'])->name('students.records');
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{id}/update', [StudentController::class, 'update'])->name('students.update');
Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
Route::post('/students/bulk-delete',  [StudentController::class, 'bulkDelete'])->name('students.bulk-delete');
Route::post('/students/export', [StudentController::class, 'export'])->name('students.export');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

// Define the route for generating a unique link
Route::get('/generate', [LinkController::class, 'generateLink'])->name('generate.link');
Route::post('/update-expiration/{uniqueIdentifier}', [LinkController::class, 'updateExpiration'])->middleware('validate.unique.link')->name('update.expiration');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/update', [NotificationController::class, 'updateThreshold'])->name('notifications.update');
Route::get('/notifications/settings', function () {
    return view('notifications.settings');
})->name('notifications.settings');
Route::post('/toggle-link/{uniqueIdentifier}', [LinkController::class, 'toggleActivation'])->name('toggle.link');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');


// Define the route for creating students with a unique link

// Route for the page to generate links
Route::get('/generate-link', [LinkController::class, 'generateLinkPage'])->name('aics.gen');


});
// Route for handling the login and logout form submission
Route::get('/admin/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [UserController::class, 'login']);
Route::post('/admin/logout', [UserController::class, 'logout'])->name('admin.logout');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('login/index');
});


// Route to fetch flash messages
Route::get('/get_flash_messages', function () {
    return response()->json(['message' => session('message')]);
});

Route::middleware('web')->group(function () {
    

    // Define the route for creating students with a unique link
    Route::get('/aics/{uniqueIdentifier}', [LinkController::class, 'create'])
        ->middleware('validate.unique.link')
        ->name('aics.create.unique');
// Define the route for storing students
Route::post('/aics/store', [LinkController::class, 'store'])
->name('aics.store');

        Route::get('/success', function () {
            return view('/UniqueLink/success');
        })->name('success');
        Route::get('/already-submitted', function () {
            return view('/UniqueLink/already');
        })->name('already.create');
});


Route::get('/welcome', function () {
    return view('welcome');
});
 
 // Define the route for the success page