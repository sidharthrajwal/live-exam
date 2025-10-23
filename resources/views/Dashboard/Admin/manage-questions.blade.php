@extends('layouts.dashboard.app')

@section('content')
<div class="container-fluid position-relative bg-white d-flex p-0">
    @include('layouts.dashboard.sidebar')

    <div class="content">
        @include('layouts.dashboard.navbar-content')


                <div class="container-fluid p-4">
                    <!-- Header Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card bg-light p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="text-primary mb-2">
                                            <i class="fas fa-edit me-2"></i>Manage Question
                                        </h4>
                                        <p class="text-muted mb-0">Edit question details and update answers</p>
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

                    <!-- Edit Question Form -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card p-4">
                                <h5 class="text-primary mb-4">Edit Question</h5>

                                <!-- Success/Error Messages -->
                                <div class="alert alert-success" style="display: none;">
                                    Question updated successfully!
                                </div>
                                <div class="alert alert-danger" style="display: none;">
                                    <ul class="mb-0">
                                        <li>Please fill in all required fields.</li>
                                    </ul>
                                </div>

                                <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
                                @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif  
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="form-label">Question Text</label>
                                        <textarea class="form-control" rows="3" name="question" required>{{ $question->question }}</textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Answer Options</label>
                                        <div class="row g-3">

                                            <!-- Option A -->
                                            @foreach ($question->answers as $index => $answer)
                                            <div class="col-md-6">
                                                <div class="card border p-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="form-check me-2">
                                                            {{$answer->c_answer}}
                                                            <input class="form-check-input" type="radio" name="correct_option" value="{{$index}}" {{ $answer->c_answer == true ? 'checked' : '' }}>
                                                            <label class="form-check-label fw-bold">A</label>
                                                        </div>
                                                        @if($answer->c_answer == true)
                                                        <span class="badge bg-success">Correct</span>
                                                        @endif
                                                    </div>
                                                    <input type="text" class="form-control" name="options[]" value="{{ $answer->option_value }}" required>
                                                </div>
                                            </div>
                                            @endforeach
                                          
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Update Question
                                        </button>
                                        <button type="reset" class="btn btn-secondary">
                                            <i class="fas fa-undo me-2"></i>Reset
                                        </button>
                                        <a href="#" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-2"></i>Cancel
                                        </a>
                                    </div>
                                </form>
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
                    <h5 class="modal-title text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>Delete Question
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this question?</p>
                    <div class="alert alert-warning">
                        <strong>Warning:</strong> This action cannot be undone. All student responses to this question will also be deleted.
                    </div>
                    <div class="mb-3">
                        <strong>Question:</strong><br>
                        What is the derivative of x² with respect to x?
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Question
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
