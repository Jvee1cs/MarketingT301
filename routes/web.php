<?php
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SchoolController;

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

Route::get('/', function () {
    return view('login/index');
});
// Route for showing the login form
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');

// Route for handling the login form submission
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');

// Route for showing the dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Route for saving data
Route::post('/admin/save', [AdminController::class, 'save'])->name('admin.save');
// Define the route for registration
Route::get('/student/register', [StudentController::class, 'showRegistrationForm'])->name('student.register');
Route::post('/student/register', [StudentController::class, 'submitRegistrationForm'])->name('student.register.submit');
// Define the logout route for admin
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

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
Route::delete('/students/{id}/delete', [StudentController::class, 'destroy'])->name('students.destroy');
Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');

// Routes for displaying and managing users records

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/user/records', [UserController::class, 'index'])->name('user.records');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Routes for displaying and managing School records
Route::get('/schools', [SchoolController::class, 'index'])->name('schools.index');
Route::get('/schools/create', [SchoolController::class, 'create'])->name('schools.create');
Route::post('/schools', [SchoolController::class, 'store'])->name('schools.store');
Route::get('/schools/{school}', [SchoolController::class, 'show'])->name('schools.show');
Route::get('/schools/{school}/edit', [SchoolController::class, 'edit'])->name('schools.edit');
Route::put('/schools/{school}', [SchoolController::class, 'update'])->name('schools.update');
Route::delete('/schools/{school}', [SchoolController::class, 'destroy'])->name('schools.destroy');