@extends('layouts.dashboard.app')

@section('content')
<div class="container-fluid position-relative bg-white d-flex p-0">
    @include('layouts.dashboard.sidebar')

    <div class="content">
        @include('layouts.dashboard.navbar-content')

    <div class="container-fluid pt-4 px-4">
        <div class="row">
        

            <!-- Main Content -->
            <div class="col-12">

                    <!-- Header Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card bg-light p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="text-primary mb-2">
                                            <i class="fas fa-cog me-2"></i>Manage Exam: {{$exam_detail->subject_name}}
                                        </h4>
                                        <p class="text-muted mb-0">Edit exam details and manage questions</p>
                                    </div>
                                    <div>
                                        <a href="#" class="btn btn-secondary me-2">
                                            <i class="fas fa-arrow-left me-2"></i>Back
                                        </a>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <i class="fas fa-trash me-2"></i>Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Exam Form -->
                    <div class="row mb-4">
                        <div class="col-lg-8">
                            <div class="card p-4">
                                <h5 class="text-primary mb-4">Edit Exam Details</h5>
                                <form action="{{route('admin.manage-exam.update', $exam_detail->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Subject Name</label>
                                                <input type="text" class="form-control" value="{{$exam_detail->subject_name}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Subject Code</label>
                                                <input type="text" class="form-control" value="{{$exam_detail->subject_code}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Duration (minutes)</label>
                                                <input type="number" class="form-control" value="{{$exam_detail->exam_duration}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Start Date</label>
                                                {{$exam_detail->start_date}}
                                                <input type="date" class="form-control" value="{{$exam_detail->start_date}}" placeholder="{{$exam_detail->start_date}}" required>
                                            </div>
                                        </div>
                                    </div>
                                 

                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        @php $exam_status =  ['active', 'upcoming', 'completed', 'pending']; @endphp
                                        <select class="form-select" required>
                                            @foreach ($exam_status as $status)
                                            <option value="{{$status}}" {{$exam_detail->status == $status ? 'selected' : ''}}>{{$status}}</option>
                                            @endforeach
                                        </select>
                                    
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Exam</button>
                                </form>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="col-lg-4">
                            <div class="card p-4">
                                <h5 class="text-primary mb-4">Quick Stats</h5>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Questions:</span>
                                        <span class="fw-bold">{{ $questionList->count() }}</span>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Status:</span>
                                        <span class="fw-bold text-success">{{$exam_detail->status}}</span>
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <a href="#" class="btn btn-success btn-sm">Add Question</a>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#questionsModal">
                                        View Questions
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Questions List -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card p-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="text-primary mb-0">Questions ({{ $questionList->count() }})</h5>
                                    <a href="#" class="btn btn-primary btn-sm">Add Question</a>
                                </div>
                                <div class="table-responsive">
                                    <form action="">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Question</th>
                                                <th>Options</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $data  =  1; @endphp
                                          
                                            @foreach ($questionList as $question)
                                            <tr>
                                                <td>{{$data++}}</td>
                                                <td style="max-width: 300px;">
                                                    <div class="fw-bold">{{ $question->question }}</div>
                                                </td>
                                               
                                                <td>Options {{$question->answers->count()}}</td>
                                             
                                                <td>
                                                    <a href="{{route('admin.questions.edit', $question->id)}}" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                                    <a href="{{route('admin.questions.destroy', $question->id)}}" class="btn btn-sm btn-outline-danger">Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Delete Exam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Delete <strong>Mathematics</strong>?</p>
                    <div class="alert alert-warning">This action cannot be undone.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Questions Modal -->
    <div class="modal fade" id="questionsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Questions - Mathematics</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 p-3 border rounded">
                        <h6><strong>1.</strong> What is the derivative of x²?</h6>
                        <div class="form-check mb-1 ms-3">
                            <input class="form-check-input" type="radio" disabled>
                            <label class="form-check-label">x</label>
                        </div>
                        <div class="form-check mb-1 ms-3">
                            <input class="form-check-input" type="radio" disabled checked>
                            <label class="form-check-label">2x <span class="badge bg-success ms-2">Correct</span></label>
                        </div>
                        <div class="form-check mb-1 ms-3">
                            <input class="form-check-input" type="radio" disabled>
                            <label class="form-check-label">x²</label>
                        </div>
                        <div class="form-check mb-1 ms-3">
                            <input class="form-check-input" type="radio" disabled>
                            <label class="form-check-label">1</label>
                        </div>
                    </div>
                    <div class="mb-3 p-3 border rounded">
                        <h6><strong>2.</strong> Solve the equation 2x + 3 = 7</h6>
                        <div class="form-check mb-1 ms-3">
                            <input class="form-check-input" type="radio" disabled>
                            <label class="form-check-label">x = 1</label>
                        </div>
                        <div class="form-check mb-1 ms-3">
                            <input class="form-check-input" type="radio" disabled checked>
                            <label class="form-check-label">x = 2 <span class="badge bg-success ms-2">Correct</span></label>
                        </div>
                        <div class="form-check mb-1 ms-3">
                            <input class="form-check-input" type="radio" disabled>
                            <label class="form-check-label">x = 3</label>
                        </div>
                        <div class="form-check mb-1 ms-3">
                            <input class="form-check-input" type="radio" disabled>
                            <label class="form-check-label">x = 4</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
  
    </div>
</div>
@endsection