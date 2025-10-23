<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\questions;
use App\Models\answers;
use App\Models\ExamList;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Dashboard.Admin.admin-dashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $question_data = $request->validate([

        
            'question' => 'required',
            'options.*' => 'required|string|max:255',
            'correct_option' => 'required',

        ]);
    
        $question_title = $request->question;
        $question_options = $request->options;
        $question_correct_option = $request->correct_option;
        $question_exam_id = $request->exam_id;

        $question = questions::create([

            'exam_id' => $question_exam_id,
            'question' => $question_title,

        ]);

        $options = collect($question_options)->map(function($option, $index) use ($question_correct_option) {
            return [
                'option_value' => $option,
                'c_answer' => $index == $question_correct_option ? true : false,
            ];
        })->toArray();
        
        $question->answers()->createMany($options);

        return redirect()->back()->with('question_success', 'Question created successfully');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = questions::all();
        return view('Dashboard.Admin.admin-dashboard', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = questions::with('answers')->find($id);
       // dd($question);
        return view('Dashboard.Admin.manage-questions', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $question_data = $request->validate([
            'question' => 'required',
            'options.*' => 'required|string|max:255',
            'correct_option' => 'required',
            
        ]);



        $update_question = questions::find($id);
        $update_question->update($question_data);   
        $question_options = $request->options;

        $question_correct_option = $request->correct_option;

        $answers = $update_question->answers; 

        foreach ($answers as $index => $answer) {
     
            $answer->update([
                'option_value' => $question_options[$index],
                'c_answer' => $index == $question_correct_option ? true : false,
            ]);
          
        }
    
        return redirect()->back()->with('question_success', 'Question updated successfully');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = questions::find($id);
        $question->delete();
        return redirect()->back()->with('question_success', 'Question deleted successfully');
    }
}
