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
      <!-- Page Header -->
      <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded p-3 p-md-4 d-flex align-items-center justify-content-between flex-wrap">
                        <div>
                            <h5 class="mb-1">Exams</h5>
                            <small class="text-muted">Find your active, upcoming, and completed exams</small>
                        </div>
                        <div class="d-flex gap-2 mt-3 mt-md-0">
                            <button class="btn btn-outline-primary btn-sm"><i class="fa fa-sync me-2"></i>Refresh</button>
                            <button class="btn btn-primary btn-sm"><i class="fa fa-plus me-2"></i>New Registration</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  <!-- Exams List -->

  
  <div class="container-fluid pt-2 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded p-3 p-md-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="mb-0">Active & Upcoming Exams</h6>
                            <div class="d-flex gap-2">
                                <select class="form-select form-select-sm" style="width:auto">
                                    <option selected>All Subjects</option>
                                    <option>Mathematics</option>
                                    <option>Physics</option>
                                    <option>Chemistry</option>
                                </select>
                                <select class="form-select form-select-sm" style="width:auto">
                                    <option selected>Status: All</option>
                                    <option>Active</option>
                                    <option>Upcoming</option>
                                    <option>Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle table-hover mb-0">
                                <thead>
                                    <tr class="text-muted">
                                        <th>Exam</th>
                                        <th>Subject</th>
                                        <th>Schedule</th>
                                        <th>Duration</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($exam_list as $exam)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-primary me-3"><i class="fa fa-bolt"></i></span>
                                                <div>
                                                    <div class="fw-semibold">{{ $exam->subject_name }}</div>
                                                    <small class="text-muted">Code: {{ $exam->subject_code }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $exam->subject_name }}</td>
                                        <td>{{ $exam->start_date }}</td>
                                        <td>{{ $exam->duration }}</td>
                                        <td><span class="badge bg-success status-active">Active</span>
                                        @if ($exam_room_status === 'joined')

                                        <span class="badge bg-danger status-joined">joined</span>
                                        @endif
                                    
                                    </td>
                                                                        
                                        <td class="text-end">
                                            {{ $exam_room_status }}
                                        @if (!$exam_room_status == 'joined') <button type="button" class="btn btn-sm btn-primary enter-exam" 
                                                    data-bs-toggle="modal" data-bs-target="#examCodeModal">
                                                Enter Exam
                                            </button>
                                            @endif
                                        </td>


                                    </tr>
                                    @endforeach
                                   
                                </tbody>
                            </table>

        <!-- Enter Exam Code Modal -->
         <form  id="examCodeForm" method="POST">
            @csrf
        <div class="modal fade" id="examCodeModal" tabindex="-1" aria-hidden="true">

      

            <div class="modal-dialog modal-dialog-centered">
            
                <div class="modal-content">
                <span id="status-msg"></span>
                    <div class="modal-header">
                        <h6 class="modal-title">Enter Exam Code</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="examCodeInput" class="form-label">Exam Code</label>
                            <input type="text" name="exam_code" id="examCodeInput" class="form-control" placeholder="Enter your exam code" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" >Save</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        </div>
    </div>
</div>


@vite(['resources/js/exam-room.js'])
@endsection