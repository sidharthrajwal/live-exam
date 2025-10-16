<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController\LoginController;
use App\Http\Controllers\DashboardController\RegisterController;
use App\Http\Controllers\DashboardController\StudentProfileController;
use App\Http\Controllers\DashboardController\SlotbookingController;
use App\Http\Controllers\DashboardController\ExamRoomController;
use App\Http\Controllers\AdminController\AdminController;
use App\Http\Controllers\AdminController\QuestionController;


Route::get('/', function () {
    return view('FrontView.login');
});

// Authenticate User \\


Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticationuser'])->name('login');

Route::get('/signup', [RegisterController::class, 'index']);
Route::post('/signup', [RegisterController::class, 'addnewuser'])->name('signup');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::resource('profile', (StudentProfileController::class))->names('profile');

// Dashboard \\
Route::middleware('auth')->group(function ()
{

Route::get('/profile', function () {

    return view('Dashboard.Students.students-profile');
    
    });

Route::resource('profile', (StudentProfileController::class))->names('profile');


Route::get('/dashboard', function () {

    return view('Dashboard.Students.students-dashboard');
    
    });

    Route::get('/examroom', [ExamRoomController::class, 'index'])->name('examroom');
    Route::post('/examroom', [ExamRoomController::class, 'joinSlot'])->name('examroom');  

    Route::get('/all-exams', [SlotbookingController::class, 'index'])->name('all-exams');
    Route::post('/all-exams', [SlotbookingController::class, 'joinSlot'])->name('all-exams');  


Route::get('/result', function () {

    return view('Dashboard.Exam.result');
    
    });

Route::get('/resources', function () {

    return view('Dashboard.Students.students-resources');
    
    });

Route::get('/analytics', function () {

    return view('Dashboard.Students.students-analytics');
    
    });

Route::get('/help-center', function () {

    return view('Dashboard.Students.students-help-center');
    
    });

    Route::get('/join-slot', [SlotbookingController::class, 'index'])->name('join-slot');
    Route::post('/join-slot', [SlotbookingController::class, 'joinSlot'])->name('join-slot');   

    Route::get('/leave-slot', [SlotbookingController::class, 'index'])->name('leave-slot');
    Route::post('/leave-slot', [SlotbookingController::class, 'leaveSlot'])->name('leave-slot');   


// Admin Routes

    Route::resource('/admin/dashboard', (AdminController::class))->names('admin.dashboard');
    Route::resource('/admin/questions', (QuestionController::class))->names('admin.questions');


});



// Route::get('/admin/questions', [QuestionController::class, 'index'])->name('admin.questions.index');
// Route::post('/admin/questions', [QuestionController::class, 'store'])->name('admin.questions.store');