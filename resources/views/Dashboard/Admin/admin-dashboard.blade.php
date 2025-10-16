@extends('layouts.dashboard.app')

@section('content')
<div class="container-fluid position-relative bg-white d-flex p-0">
    @include('layouts.dashboard.sidebar')

    <div class="content">
        @include('layouts.dashboard.navbar-content')

        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <!-- Header -->
                <div class="col-12">
                    <div class="bg-light rounded p-4">
                        <h4 class="text-primary mb-2">
                            <i class="fas fa-crown me-2"></i>Master Admin Dashboard
                        </h4>
                        <p class="text-muted mb-0">Create exams and upload questions</p>
                    </div>
                </div>

                <!-- Exam Creation Form -->
                <div class="col-12">
                    <div class="bg-light rounded p-4">
                        <h4 class="text-primary mb-4">
                            <i class="fas fa-plus me-2"></i>Create New Exam
                        </h4>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.dashboard.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label">Subject Name</label>
                                        <input type="text" class="form-control" name="exam_name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Subject Code</label>
                                        <input type="text" class="form-control" name="exam_code" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Duration</label>
                                        <select class="form-select" name="exam_duration" required>
                                            <option value="">Select...</option>
                                            <option value="30">30 min</option>
                                            <option value="60">1 hour</option>
                                            <option value="90">1.5 hours</option>
                                            <option value="120">2 hours</option>
                                            <option value="180">3 hours</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="exam_status" required>
                                            <option value="">Select...</option>
                                            <option value="active">Active</option>
                                            <option value="upcoming">Upcoming</option>
                                            <option value="pending">Pending</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Exam Date</label>
                                        <input type="date" class="form-control" name="exam_date" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Start Time</label>
                                        <input type="time" class="form-control" name="start_time" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Exam Room</label>
                                        <select class="form-select" name="exam_room" required>
                                            <option value="">Select...</option>
                                            <option value="Room 101">Room 101</option>
                                            <option value="Room 102">Room 102</option>
                                            <option value="Lab A">Lab A</option>
                                            <option value="Online">Online</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-plus me-2"></i>Create Exam
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Question Upload Form -->
                <div class="col-12">
                    <div class="bg-light rounded p-4">
                        <h4 class="text-primary mb-4">
                            <i class="fas fa-upload me-2"></i>Upload Question
                        </h4>

                        <form action="{{ route('admin.questions.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label">Select Exam</label>
                                        <select class="form-select" name="exam_id" required>
                                            <option value="">Choose exam...</option>
                                            @php $exams = App\Models\ExamList::all(); @endphp
                                            @foreach($exams as $exam)
                                                <option value="{{ $exam->id }}">{{ $exam->subject_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Question</label>
                                        <textarea class="form-control" name="question" rows="3" required></textarea>
                                    </div>

                                    <div class="row g-2 mb-3">
                                        
                                            <div class="col-md-6">
                                                <label>A.</label>
                                                <input type="text" class="form-control form-control-sm" name="option[]" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>B.</label>
                                                <input type="text" class="form-control form-control-sm" name="option[]" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>C.</label>
                                                <input type="text" class="form-control form-control-sm" name="option[]" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>D.</label>
                                                <input type="text" class="form-control form-control-sm" name="option[]" required>
                                            </div>
                                     
                                    </div>

                                    <div class="mb-3">
                                        <label>Correct Answer</label>
                                        <div class="row g-2">
                                           
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="option" value="option_a" required>
                                                        <label class="form-check-label small">A</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="option" value="option_b" required>
                                                        <label class="form-check-label small">B</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="option" value="option_c" required>
                                                        <label class="form-check-label small">C</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="option" value="option_d" required>
                                                        <label class="form-check-label small">D</label>
                                                    </div>
                                                </div>
                                          
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-2 ">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fas fa-upload me-2"></i>Upload Question
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
/* Card styling */
.bg-light.rounded.p-4 {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: transform 0.2s, box-shadow 0.2s;
}

.bg-light.rounded.p-4:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

/* Headers */
h4.text-primary {
    font-weight: 600;
    font-size: 1.25rem;
}

/* Buttons */
.btn-primary, .btn-success {
    font-weight: 600;
    border-radius: 0.5rem;
    transition: background-color 0.2s, transform 0.2s;
}

.btn-primary:hover, .btn-success:hover {
    transform: translateY(-2px);
}

/* Form inputs */
.form-control, .form-select {
    border-radius: 0.5rem;
    box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-control:focus, .form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);
}

/* Radio buttons */
.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

/* Small text labels for radio */
.form-check-label.small {
    font-size: 0.85rem;
    font-weight: 500;
}

/* Page container */
.container-fluid.pt-4.px-4 {
    padding-bottom: 40px;
}
</style>
