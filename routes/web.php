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

// Define the route for student records
Route::get('/student/records', [StudentController::class, 'index'])->name('student.records');
// Define the route for school records
Route::get('/school/records', [SchoolController::class, 'index'])->name('school.records');
// Define the route for adding school records
Route::post('/school/add', [SchoolController::class, 'store'])->name('school.add');
// Define the route for user records
Route::get('/user/records', [UserController::class, 'index'])->name('user.records');
// Define the route for adding user records
Route::post('/user/add', [UserController::class, 'store'])->name('user.add');

Route::get('/student', [StudentController::class, 'registration'])->name('student.registration');
Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/student', [StudentController::class, 'store'])->name('student.store');
