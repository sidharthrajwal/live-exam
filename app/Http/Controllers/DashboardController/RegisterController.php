<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
 
     return view('FrontView.signup');
 
    }

    public function addnewuser(Request $request )
    {
     
    
        $requested_data = $request->validate([

         'username'   => 'required',
         'email' => 'required',
         'password' => 'required',  
         'terms' =>  'required'

        ]);

        $save_data = new User();
       
        $save_data->name = $request->username;
        $save_data->email = $request->email;
        $save_data->password = bcrypt($request->password);

        try {
        $save_data->save();

    } catch(\Illuminate\Database\QueryException $e){
    
       
        return back()->with('duplicateerror', 'Email already exists!');

    }

        return view('Dashboard.dashboard-main');  


    }
}
