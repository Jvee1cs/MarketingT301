<?php
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolController;

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
Route::middleware('auth')->group(function () {
    // Routes that require authentication

    // Define routes for authenticated users
    Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
    // Add more authenticated routes here...
// Route for showing the login form

// Define the route for registration
Route::get('/student/register', [StudentController::class, 'showRegistrationForm'])->name('student.register');
Route::post('/student/register', [StudentController::class, 'submitRegistrationForm'])->name('student.register.submit');
// Define the logout route for admin

// Define the route for school records
Route::get('/school/records', [SchoolController::class, 'index'])->name('school.records');
// Define the route for adding school records
Route::post('/school/add', [SchoolController::class, 'store'])->name('school.add');
// Define the route for user records

// Route for adding user records
Route::post('/user/add', [UserController::class, 'store'])->name('user.add');

Route::get('/student', [StudentController::class, 'registration'])->name('student.registration');
Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
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
Route::get('/profile', [UserController::class, 'profile'])->name('profile');



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

// IPASOK MO DITO PARA MAPASOK



});
// Route for handling the login and logout form submission
Route::get('/admin/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [UserController::class, 'login']);
Route::post('/admin/logout', [UserController::class, 'logout'])->name('admin.logout');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');



Route::post('/notifications/update', [NotificationController::class, 'updateThreshold'])->name('notifications.update');

Route::get('/notifications/settings', function () {
    return view('notifications.settings');
})->name('notifications.settings');

Route::get('/', function () {
    return view('login/index');
});

