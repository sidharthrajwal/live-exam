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
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="text-primary mb-2">
                                    <i class="fas fa-list me-2"></i>Manage Exams
                                </h4>
                                <p class="text-muted mb-0">View, edit, and manage all created exams</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.manage-exam.dashboard') }}" class="btn btn-secondary me-2">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                                </a>
                                <a href="{{ route('admin.manage-exam.dashboard') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Create New Exam
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Exams List -->
                <div class="col-12">
                    <div class="bg-light rounded p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="text-primary mb-0">
                                <i class="fas fa-clipboard-list me-2"></i>All Exams
                            </h5>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" placeholder="Search exams..." style="width: 250px;">
                                <select class="form-select" style="width: 150px;">
                                    <option>All Status</option>
                                    <option>Active</option>
                                    <option>Upcoming</option>
                                    <option>Completed</option>
                                    <option>Pending</option>
                                </select>
                            </div>
                        </div>

       

                        @if($examList->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="border-0">#</th>
                                            <th class="border-0">Subject Name</th>
                                            <th class="border-0">Subject Code</th>
                                            <th class="border-0">Duration</th>
                                            <th class="border-0">Start Date</th>
                                            <th class="border-0">Status</th>
                                            <th class="border-0">Questions</th>
                                            <th class="border-0 text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($examList as $index => $exam)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    <div class="fw-bold">{{ $exam->subject_name }}</div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">{{ $exam->subject_code }}</span>
                                                </td>
                                                <td>{{ $exam->exam_duration }} min</td>
                                                <td>{{ \Carbon\Carbon::parse($exam->start_date)->format('M d, Y') }}</td>
                                                <td>
                                                    @if($exam->status == 'active')
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif($exam->status == 'upcoming')
                                                        <span class="badge bg-warning">Upcoming</span>
                                                    @elseif($exam->status == 'completed')
                                                        <span class="badge bg-primary">Completed</span>
                                                    @else
                                                        <span class="badge bg-secondary">Pending</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="text-muted">
                                                        <i class="fas fa-question-circle me-1"></i>
                                                       
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                       
                                                        <a href="{{ route('admin.manage-exam.edit', $exam->id) }}" class="btn btn-sm btn-outline-success me-1" title="Edit Exam">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                  
                                                        <a class="btn btn-sm btn-outline-danger" title="Delete Exam">
                                                            <i class="fas fa-trash"></i>
</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="text-muted">
                                    Showing {{ $examList->count() }} exam(s)
                                </div>
                                <nav aria-label="Exam pagination">
                                    <ul class="pagination pagination-sm mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="#">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="#">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        @else
                            <!-- Empty State -->
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="fas fa-clipboard-list fa-4x text-muted"></i>
                                </div>
                                <h5 class="text-muted">No exams found</h5>
                                <p class="text-muted mb-4">You haven't created any exams yet. Start by creating your first exam.</p>
                                <a href="{{ route('admin.manage-exam.dashboard') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Create Your First Exam
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection