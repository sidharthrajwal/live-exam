<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class ApiController extends Controller
{
    function  SubmitAnswer(Request $request)
    {
        
        $validatedData = Validator::make($request->all(), [
            'token' => 'required',
        ]);
        $validated = $validatedData->validated();
      $data = (object) $validated;
      $token =  'sdasdasdasdasdasdasdasdasdsaddd';
     
        if ($validatedData->fails()) {
            return response($validatedData->messages());
        }

      return response()->json(['token' => $data->token, 'data' => 'new'], 200);
    }
}
