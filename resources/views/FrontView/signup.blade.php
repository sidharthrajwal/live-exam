@extends('layouts.dashboard.app')

@section('content')

<div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
              
                    <form id="signupform" action="{{ route('signup') }}" method="post">
                  
                 
                    @csrf
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Won Exam</h3>
                            </a>
                            <h3>Sign Up</h3>
                        </div>
                        @if(session('duplicateerror'))
            <div class="alert alert-danger">{{ session('duplicateerror') }}</div>
        @endif
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="floatingText" placeholder="jhondoe"  value="{{ old('username') }}" >
                            <label for="floatingText">Username</label>
                            @error('username')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}"      >
                            <label for="floatingInput">Email address</label>
                            @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" value="{{ old('password') }}" >
                            <label for="floatingPassword">Password</label>
                            @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" name="terms" class="form-check-input @error('terms') is-invalid @enderror" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                              
                            </div>
                            <a href="">Forgot Password</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                        <p class="text-center mb-0">Already have an Account? <a href="{{ url('/login') }}">Sign In</a></p>
                    </div>
</form>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>
   
    @endsection
