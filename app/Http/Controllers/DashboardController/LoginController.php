<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class LoginController extends Controller
{
    //
   public function index()
   {

    return view('FrontView.login');

   }

   public function authenticationuser(Request $request )
   {
    

       $validate   =    $request->validate([
        'terms'   => 'required'
       ]);

      $credentials = $request->validate([
        'email' => 'required',
        'password' => 'required',
       
      ]);

    
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('dashboard'); 
    }
    
    return back()->withErrors([
        'email' => 'Email not  registered.',
         'password' => 'Password is in valid',
       
    ])->withInput();

   }

}
