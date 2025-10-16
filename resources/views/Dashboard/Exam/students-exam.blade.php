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

  
@if(empty($joined_subjects) )
    
<div class="alert alert-primary border-0 d-flex align-items-center justify-content-center mb-4 shadow-lg position-fixed top-50 start-50 translate-middle" role="alert" 
     style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); min-width: 400px; max-width: 90vw; z-index: 1050; border-left: 4px solid #2196f3 !important;">
    <div class="text-center">
        <div class="mb-3">
            <i class="fa fa-door-open fa-3x text-primary"></i>
        </div>
        <h5 class="alert-heading text-primary fw-semibold mb-3">
            <i class="fa fa-sign-in-alt me-2"></i>Join Exam Room Required
        </h5>
        <p class="mb-3 text-dark">
            Please first join the room by clicking on the join button.
        </p>
        <a href="{{ url('all-exams') }}" class="btn btn-primary px-4 py-2">
            <i class="fa fa-sign-in-alt me-2"></i>Join Room Now
        </a>
    </div>
</div>

@else
        <!-- Slot Booking (Read-only) -->
        <div class="container-fluid pt-2 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-white border rounded p-3 p-md-4">
                        <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
                            <div>
                                <h6 class="mb-1">Slot Booking (Read-only)</h6>
                                <small class="text-muted">Visual layout of 100 slots. Booked slots are highlighted.</small>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-success"><i class="fa fa-check me-1"></i>Booked</span>
                                <span class="badge bg-secondary"><i class="fa fa-minus me-1"></i>Unbooked</span>
                            </div>
                        </div>

                        <!-- Layout only: 10x10 static grid (no logic) -->
                        <div class="d-grid" style="grid-template-columns: repeat(10, minmax(0, 1fr)); gap: .25rem;">
                            @for($i = 1; $i <= 100; $i++)
                                <div
                                    class="text-center small py-1 @if($booked_slot_count >= $i) bg-success text-white @else bg-light text-muted @endif rounded border user-select-none   border-secondary"
                                    style="font-size: .75rem; line-height: 1.1;"
                                    title="Slot {{ $i }}"
                                    aria-label="Slot {{ $i }}"
                                >
                                    {{ $i }}
                                </div>
                            @endfor
                        </div>

                        <div class="mt-2">
                            <small class="text-muted">This is a read-only display. Slot states cannot be changed here.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Exam Room Layout -->
        <div id="exam-room" class="container-fluid pt-2 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-white border rounded p-0 overflow-hidden">
                        <!-- Exam Header -->
                        <div class="bg-light border-bottom p-3 p-md-4 d-flex flex-wrap align-items-center justify-content-between">
                            <div>
                                <h6 class="mb-1">Exam Room: Mid-Term Assessment</h6>
                                <small class="text-muted">Subject:  {{ $exam_room_subject_name}} · Code: {{ $exam_room_code }}</small>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-secondary p-2"><i class="fa fa-question-circle me-1"></i> 20 Questions</span>
                                <span class="badge bg-primary p-2" id="exam-timer" data-duration="3600"><i class="fa fa-hourglass-half me-1"></i> {{ $exam_room_duration}}</span>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#leaveExamModal"><i class="fa fa-sign-out-alt me-2"></i>Leave</button>
                            </div>
                        </div>

                        <div class="row g-0">
                            <!-- Left: Instructions and Question -->
                            <div class="col-lg-9 p-3 p-md-4">
                                <!-- Instructions -->
                                <div class="alert alert-info d-flex align-items-start" role="alert">
                                    <i class="fa fa-info-circle me-3 mt-1"></i>
                                    <div>
                                        <div class="fw-semibold mb-1">Please read before starting:</div>
                                        <ul class="mb-0 ps-3">
                                            <li>Total time is 60 minutes. The timer starts when you enter.</li>
                                            <li>Do not refresh or navigate away. Your progress may be lost.</li>
                                            <li>Use the question navigator to jump between questions.</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Question Card -->
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="badge bg-dark">Question 1 of 20</span>
                                            <small class="text-muted">1 mark</small>
                                        </div>
                                        <p class="mb-3">If 2x + 3 = 11, what is the value of x?</p>

                                        <div class="list-group">
                                            <label class="list-group-item">
                                                <input class="form-check-input me-2" type="radio" name="q1" /> 2
                                            </label>
                                            <label class="list-group-item">
                                                <input class="form-check-input me-2" type="radio" name="q1" /> 3
                                            </label>
                                            <label class="list-group-item">
                                                <input class="form-check-input me-2" type="radio" name="q1" /> 4
                                            </label>
                                            <label class="list-group-item">
                                                <input class="form-check-input me-2" type="radio" name="q1" /> 5
                                            </label>
                                        </div>

                                        <div class="d-flex justify-content-between mt-3">
                                            <button class="btn btn-outline-secondary btn-sm"><i class="fa fa-arrow-left me-2"></i>Previous</button>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-outline-warning btn-sm"><i class="fa fa-flag me-2"></i>Mark for Review</button>
                                                <button class="btn btn-success btn-sm"><i class="fa fa-save me-2"></i>Save Answer</button>
                                            </div>
                                            <button class="btn btn-primary btn-sm">Next<i class="fa fa-arrow-right ms-2"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submission -->
                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#submitExamModal"><i class="fa fa-paper-plane me-2"></i>Submit Exam</button>
                                </div>
                            </div>

                            <!-- Right: Navigator -->
                            <div class="col-lg-3 border-start p-3 p-md-4 bg-light">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="mb-0">Navigator</h6>
                                    <div class="d-flex gap-1">
                                        <span class="badge bg-success">Saved</span>
                                        <span class="badge bg-warning text-dark">Marked</span>
                                    </div>
                                </div>
                                <div class="row g-2">
                                    @for($i=1; $i<=20; $i++)
                                        <div class="col-3">
                                            <button class="btn btn-sm w-100 btn-outline-secondary">{{$i}}</button>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Leave Exam Modal -->
        <div class="modal fade" id="leaveExamModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('leave-slot') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Leave Exam?</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Your progress may not be saved. Are you sure you want to leave the exam?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Leave</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <!-- Submit Exam Modal -->
        <div class="modal fade" id="submitExamModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Submit Exam?</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        You are about to submit your answers. This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Review Again</button>
                        <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
    <!-- Content End -->
</div>
<!-- End Container Fluid -->

@push('scripts')
<script>
    // Simple countdown display (UI only)
    document.addEventListener('DOMContentLoaded', function () {
        const timerEl = document.getElementById('exam-timer');
        if (!timerEl) return;
        let remaining = parseInt(timerEl.getAttribute('data-duration'), 10) || 0;

        function format(sec){
            const m = Math.floor(sec / 60).toString().padStart(2, '0');
            const s = (sec % 60).toString().padStart(2, '0');
            return `${m}:${s}`;
        }

        timerEl.innerHTML = `<i class="fa fa-hourglass-half me-1"></i> ${format(remaining)}`;
        const iv = setInterval(() => {
            remaining--;
            if (remaining <= 0) {
                clearInterval(iv);
                timerEl.classList.remove('bg-primary');
                timerEl.classList.add('bg-danger');
                timerEl.innerHTML = `<i class=\"fa fa-hourglass-end me-1\"></i> 00:00`;
                return;
            }
            timerEl.innerHTML = `<i class=\"fa fa-hourglass-half me-1\"></i> ${format(remaining)}`;
        }, 1000);
    });
</script>
@endpush

@endsection
