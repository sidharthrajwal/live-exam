<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   function login(Request $request)
   {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $token = $request->user()->createToken('auth_token')->plainTextToken;
        echo $token;
        return response()->json(['message' => 'Login successful', 'token' => $token]);
    }

    return response()->json(['message' => 'Login failed']);
    
   }
}
