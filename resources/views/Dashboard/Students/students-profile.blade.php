@extends('Dashboard.dashboard-main')

@section('content')
<div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


    @include('layouts.dashboard.sidebar')

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('layouts.dashboard.navbar-content')  
            <!-- Navbar End -->


            <!-- Form Start -->
            <form action="{{ route('profile.update', auth()->user()->id.'edit') }}" method="post" enctype="multipart/form-data">
            @if(session('success'))
            <div class="container mt-5">
<div class="alert alert-primary">
    {{ session('success') }}
</div>
</div>
@endif
        

                @csrf
                @method('PUT')
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">User detail</h6>
                    
                                <div class="mb-3">
                                    <label for="forName" class="form-label">Name</label>

                                    <input type="text" name="name" class="form-control" id="forName"
                                        aria-describedby="emailHelp" value="{{ $user->name }}">
                                        @error('name')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    
                                </div>
                                <div class="mb-3">
                                <label for="forEmail" class="form-label">Email Id</label>
                                    <input type="email" name="email" class="form-control" id="forEmail"
                                        aria-describedby="emailHelp" value="{{ $user->email }}">
                                            @error('email')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                    </div>
                                </div>
                               
                               
                        
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Security</h6>
                         
                                <div class="mb-3">
                                    <label for="forPassword" class="form-label">New Password</label>
                                  
                                    <input type="password" name="password" class="form-control" id="forPassword"
                                        aria-describedby="emailHelp">
                                        @error('password')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    
                                </div>
                                <div class="mb-3">
                                <label for="forConfirmPassword" class="form-label">Confirm New Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="forConfirmPassword"
                                        aria-describedby="emailHelp">
                                        @if ($errors->has('password_confirmation'))
                                            <div class="text-danger small">{{ $errors->first('password_confirmation') }}</div>
                                        @endif
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                    </div>
                                </div>
                               
                          
                        
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Verification</h6>
                            <div class="form-floating mb-3">
                                <input type="email" name="verification_email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com">
                                <label for="floatingInput">Verification Email (optional)</label>
                            </div>
                          
                            <div class="form-floating mb-3">
                                <select name="role" class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label for="floatingSelect">Works with selects</label>
                            </div>
                            <div class="form-floating">
                                <textarea name="verification_comments" class="form-control" placeholder="Leave a comment here"
                                    id="floatingTextarea" style="height: 150px;"></textarea>
                                <label for="floatingTextarea">Comments</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Profile Image</h6>
                            <div class="mb-3 col-xl-6">
                                <label for="formFile" class="form-label">Default file input example</label>
                                <input name="image" class="form-control" type="file" id="formFile" onchange="showImage()">
                            </div>
                            <div id="imagePreview" class="mt-3">
                                <img  src="{{ asset('storage/student_profile_image/' . $student_profile->profile_image) }}" alt="Image Preview" style="max-width: 200px;">
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Additional Information</h6>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control" rows="3" placeholder="Enter your address">{{ $student_profile->address }}</textarea>
                                @error('address')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" name="city" id="city" class="form-control" value="{{ $student_profile->city }}" placeholder="City">
                                    @error('city')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="region" class="form-label">Region/State</label>
                                    <input type="text" name="region" id="region" class="form-control" value="{{ $student_profile->region }}" placeholder="Region or State">
                                    @error('region')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="postal_code" class="form-label">Postal Code</label>
                                    <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ $student_profile->postal_code }}" placeholder="Postal Code">
                                    @error('postal_code')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" name="country" id="country" class="form-control" value="{{ $student_profile->country }}" placeholder="Country">
                                    @error('country')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $student_profile->phone }}" placeholder="Phone">
                                    @error('phone')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" min="0" name="age" id="age" class="form-control" value="{{ $student_profile->age }}" placeholder="Age">
                                    @error('age')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-select">
                                        <option value="" selected disabled>Select</option>
                                        <option value="male" @selected($student_profile->gender==='male')>Male</option>
                                        <option value="female" @selected($student_profile->gender==='female')>Female</option>
                                        <option value="other" @selected($student_profile->gender==='other')>Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ $student_profile->dob }}">
                                @error('date_of_birth')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-12 col-xl-6">
                    <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Last Exam Details</h6>
                           <div> 
                            <div class="lol">
                                <img src="{{ $student_profile->profile_image }}" alt="">
                            </div>  
                           </div>
                        </div>
                    </div>
    
                </div>
            </div>
            <button class="button-85" role="button">Update</button>
            </form>
          
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
@endsection