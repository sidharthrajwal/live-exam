<?php

namespace App\Http\Controllers\DashboardController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentProfile;
use Illuminate\Support\Facades\Storage;

class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $student_profile = StudentProfile::where('user_id', $user->id)->first();
        return view('Dashboard.Students.students-profile', compact('user', 'student_profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find(auth()->user()->id);
        $student_profile = StudentProfile::where('user_id', $user->id)->first();
        return view('Dashboard.Students.students-profile', compact('user', 'student_profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|confirmed|min:6',
            'password_confirmation' => 'nullable',
            'address' => 'required',
            'city' => 'required',
            'region' => 'required',
            'country' => 'required',
            'postal_code' => 'required',
            'phone' => 'required',
            'date_of_birth' => 'required',
            'image' => 'nullable|image',
            'gender' => 'required',
        ]);

      
        
            $user = User::find($id);
            $user->email = $request->email;
            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
        

     
            $student_profile = StudentProfile::where('user_id', $id)->first();
            $student_profile->name = $request->name;
            $student_profile->address = $request->address;
            $student_profile->city = $request->city;
            $student_profile->region = $request->region;
            $student_profile->country = $request->country;
            $student_profile->postal_code = $request->postal_code;
            $student_profile->phone = $request->phone;
            $student_profile->dob = $request->date_of_birth;
            $student_profile->gender = $request->gender;
            if ($request->hasFile('image')) {
                
                $image = $request->file('image'); 
                $image_name =   $image->getClientOriginalName();
                $path = $image->storeAs('student_profile_image', $image_name, 'public');
                $student_profile->profile_image = $image_name;
            }
            
            $student_profile->save();

        

        return back()->with('success', 'Profile updated successfully');
    }

    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
