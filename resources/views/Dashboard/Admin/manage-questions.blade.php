<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Question - Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <style>
        .form-check-input:checked {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .card {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
        }
        .card:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .text-primary {
            color: #0d6efd !important;
        }
        .bg-light {
            background-color: #f8f9fa !important;
        }
        .alert {
            border-radius: 0.5rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);
        }
        .badge {
            font-size: 0.75rem;
            padding: 0.375rem 0.75rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 bg-dark text-white p-3" style="min-height: 100vh;">
                <h5 class="text-center mb-4">
                    <i class="fas fa-hashtag me-2"></i>Won Exam
                </h5>
                <nav class="nav flex-column">
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                    </a>
                    <a href="#" class="nav-link text-white active">
                        <i class="fas fa-list me-2"></i>Manage Exams
                    </a>
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-question me-2"></i>Questions
                    </a>
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-chart-bar me-2"></i>Analytics
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <!-- Top Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4 py-3">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1">
                            <i class="fas fa-crown text-primary me-2"></i>Master Admin Dashboard
                        </span>
                        <div class="ms-auto d-flex align-items-center">
                            <div class="me-3">
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-link text-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle fa-lg"></i> Admin
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

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

                                <form>
                                    <div class="mb-4">
                                        <label class="form-label">Question Text</label>
                                        <textarea class="form-control" rows="3" required>
                                            What is the derivative of x² with respect to x?
                                        </textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">Answer Options</label>
                                        <div class="row g-3">
                                            <!-- Option A -->
                                            <div class="col-md-6">
                                                <div class="card border p-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="form-check me-2">
                                                            <input class="form-check-input" type="radio" name="correct_option" value="0">
                                                            <label class="form-check-label fw-bold">A</label>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" value="x" required>
                                                </div>
                                            </div>

                                            <!-- Option B -->
                                            <div class="col-md-6">
                                                <div class="card border p-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="form-check me-2">
                                                            <input class="form-check-input" type="radio" name="correct_option" value="1" checked>
                                                            <label class="form-check-label fw-bold">B</label>
                                                        </div>
                                                        <span class="badge bg-success">Correct</span>
                                                    </div>
                                                    <input type="text" class="form-control" value="2x" required>
                                                </div>
                                            </div>

                                            <!-- Option C -->
                                            <div class="col-md-6">
                                                <div class="card border p-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="form-check me-2">
                                                            <input class="form-check-input" type="radio" name="correct_option" value="2">
                                                            <label class="form-check-label fw-bold">C</label>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" value="x²" required>
                                                </div>
                                            </div>

                                            <!-- Option D -->
                                            <div class="col-md-6">
                                                <div class="card border p-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="form-check me-2">
                                                            <input class="form-check-input" type="radio" name="correct_option" value="3">
                                                            <label class="form-check-label fw-bold">D</label>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control" value="1" required>
                                                </div>
                                            </div>
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

                    <!-- Question Preview -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card p-4">
                                <h5 class="text-primary mb-4">
                                    <i class="fas fa-eye me-2"></i>Question Preview
                                </h5>
                                <div class="card border-0 bg-white p-3">
                                    <h6 class="mb-3">What is the derivative of x² with respect to x?</h6>
                                    <div class="row g-2">
                                        <div class="col-md-6">
                                            <div class="form-check border rounded p-2">
                                                <input class="form-check-input" type="radio" disabled>
                                                <label class="form-check-label">
                                                    <strong>A.</strong> x
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check border rounded p-2 border-success">
                                                <input class="form-check-input" type="radio" disabled checked>
                                                <label class="form-check-label">
                                                    <strong>B.</strong> 2x
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check border rounded p-2">
                                                <input class="form-check-input" type="radio" disabled>
                                                <label class="form-check-label">
                                                    <strong>C.</strong> x²
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check border rounded p-2">
                                                <input class="form-check-input" type="radio" disabled>
                                                <label class="form-check-label">
                                                    <strong>D.</strong> 1
                                                </label>
                                            </div>
                                        </div>
                                    </div>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>