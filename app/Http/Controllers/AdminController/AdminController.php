<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\questions;   
use App\Models\ExamList;   
use App\Models\answers;   

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->check() || auth()->user()->role !== 'Admin') {
            abort(403);
        }
        return view('Dashboard.Admin.admin-dashboard');
    }

    public function manageExam()
    {
    
        if (!auth()->check() || auth()->user()->role !== 'Admin') {
            abort(403);

           
        }
        $examList = ExamList::all();
        return view('Dashboard.Admin.exams-list', compact('examList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
     //  dd($request->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         $exam_data = $request->validate([

            'exam_name' => 'required',
            'exam_code' => 'required',
            'exam_duration' => 'required',
            'exam_status' => 'required',
            'exam_date' => 'required',
            // 'start_time' => 'required',
            
          
        ]);
    
    $examroom = ExamList::create([  
        'subject_name' => $exam_data['exam_name'],
        'subject_code' => $exam_data['exam_code'],
        'exam_duration' => $exam_data['exam_duration'],
        'status' => $exam_data['exam_status'],
        'start_date' => $exam_data['exam_date'],
        // 'start_time' => $exam_data['start_time'],
        
    ]);

    return redirect()->back()->with('success', 'Exam created successfully');


    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    
    $exam_detail = ExamList::find($id);
    $questionList = questions::with('answers')->where('exam_id', $id)->get();
    return view('Dashboard.Admin.manage-exam', compact('exam_detail', 'questionList'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
