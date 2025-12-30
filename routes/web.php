<?php

use App\Http\Controllers\AdminController\AdminController;
use App\Http\Controllers\AdminController\QuestionController;
use App\Http\Controllers\DashboardController\ExamRoomController;
use App\Http\Controllers\DashboardController\LoginController;
use App\Http\Controllers\DashboardController\RegisterController;
use App\Http\Controllers\DashboardController\SlotbookingController;
use App\Http\Controllers\DashboardController\StudentProfileController;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('Dashboard.Students.students-profile');
    });

    Route::resource('profile', (StudentProfileController::class))->names('profile');

    Route::get('/dashboard', function () {
        return view('Dashboard.Students.students-dashboard');
    })->name('dashboard');

    Route::get('/examroom', [ExamRoomController::class, 'index'])->name('examroom');
    Route::post('/examroom', [ExamRoomController::class, 'joinSlot']);
    Route::post('/examroom/change-questions', [ExamRoomController::class, 'ChangeQuestions'])->name('examroom.change-questions');
    Route::post('/examroom/submit-answer', [ExamRoomController::class, 'SubmitAnswer'])->name('examroom.submit-answer');
    Route::post('/examroom/submit-exam', [ExamRoomController::class, 'SubmitExam'])->name('examroom.submit-exam');
    // Route::post('/examroom/review-marked', [ExamRoomController::class, 'ReviewMarked'])->name('examroom.review-marked');

    Route::get('/all-exams', [SlotbookingController::class, 'index'])->name('all-exams');
    Route::post('/all-exams', [SlotbookingController::class, 'joinSlot'])->name('all-exams.new');

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
    Route::post('/join-slot', [SlotbookingController::class, 'joinSlot'])->name('join-slot.new');

    Route::get('/leave-slot', [SlotbookingController::class, 'index'])->name('leave-slot');
    Route::post('/leave-slot', [SlotbookingController::class, 'leaveSlot'])->name('leave-slot.new');

    // Admin Routes

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard/exam/list', [AdminController::class, 'manageExam'])->name('exam-list');

        Route::resource('/dashboard/exam', (AdminController::class))->names([
            'index' => 'manage-exam.dashboard',
            'store' => 'exam.save',
            'edit' => 'manage-exam.edit',
            'update' => 'manage-exam.update',
        ]);

        Route::resource('questions', QuestionController::class)
            ->names([
                'index' => 'questions.list',
                'store' => 'questions.save',
                'edit' => 'questions.edit',
                'update' => 'questions.update',
                'destroy' => 'questions.destroy'
            ]);
    });
});

// Route::get('/admin/questions', [QuestionController::class, 'index'])->name('admin.questions.index');
// Route::post('/admin/questions', [QuestionController::class, 'store'])->name('admin.questions.store');
