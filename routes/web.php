<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController\LoginController;
use App\Http\Controllers\DashboardController\RegisterController;
use App\Http\Controllers\DashboardController\StudentProfileController;

Route::get('/', function () {
    return view('FrontView.welcome');
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
});

Route::get('/exam', function () {

    return view('Dashboard.Exam.students-exam');
    
    });

Route::get('all-exam', function()
{

return view('Dashboard.Exam.all-exam');

});

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