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


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
              
                    <div id="flash-container" class="flash-container"></div>
                    <form id="loginform" action="{{ route('login') }}" method="post">
                    @csrf

                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Won Exam</h3>
                                 
                                  <!-- <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Logo"> -->

                            </a>
                            <h3>Sign In</h3>
                        </div>
                        <div class="form-floating mb-3">
                        <input 
            type="email" 
            name="email" 
            id="email" 
            value="{{ old('email') }}" 
            class="form-control @error('email') is-invalid @enderror"
            placeholder="Enter email"
        >

                            <label for="floatingInput">Email address</label>

                            @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
                        </div>
                        <div class="form-floating mb-4">
                        <input 
              type="password" 
            name="password" 
            id="password" 
            value="{{ old('password') }}" 
            class="form-control @error('password') is-invalid @enderror"
            placeholder="Enter Password"
        >
                            <label for="floatingPassword">Password</label>

                            @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check">
                                <input type="checkbox" name="terms" class="form-check-input @error('terms') is-invalid @enderror" id="exampleCheck1">
                                <label class="form-check-label d-block " for="exampleCheck1">Check me out</label>
                                
                            </div>
                            <a href="">Forgot Password</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                        <p class="text-center mb-0">Don't have an Account? <a href="{{url('signup')}}">Sign Up</a></p>
                    </div>
            
</form>
        </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

@endsection