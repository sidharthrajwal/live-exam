<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\LoginController;




Route::post('/submit-answer', [ApiController::class, 'SubmitAnswer']);


Route::post('/login', [LoginController::class, 'login']);