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

        <!-- Resources Header -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-3 g-md-4 align-items-center">
                <div class="col-lg-6">
                    <div class="bg-light rounded p-3 p-md-4 h-100 d-flex align-items-center">
                        <div>
                            <h5 class="mb-1">Learning Resources</h5>
                            <small class="text-muted">Search and explore curated materials for your courses</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="bg-light rounded p-3 p-md-4">
                        <div class="row g-2">
                            <div class="col-12 col-md-7">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text bg-white"><i class="fa fa-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Search resources...">
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <select class="form-select form-select-sm">
                                    <option selected>All Subjects</option>
                                    <option>Mathematics</option>
                                    <option>Physics</option>
                                    <option>Chemistry</option>
                                </select>
                            </div>
                            <div class="col-6 col-md-2 d-grid">
                                <button class="btn btn-primary btn-sm"><i class="fa fa-filter me-2"></i>Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resources Grid -->
        <div class="container-fluid pt-2 px-4">
            <div class="row g-3 g-md-4">
                <!-- Resource Card -->
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-primary p-3 rounded-circle me-3"><i class="fa fa-book"></i></span>
                                <div>
                                    <h6 class="mb-0">Algebra Basics</h6>
                                    <small class="text-muted">Mathematics • PDF</small>
                                </div>
                            </div>
                            <p class="text-muted small mb-3">Concise notes covering linear equations, inequalities, and factorization with examples.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-1">
                                    <span class="badge rounded-pill bg-light text-dark">notes</span>
                                    <span class="badge rounded-pill bg-light text-dark">algebra</span>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-primary"><i class="fa fa-download me-2"></i>Download</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resource Card -->
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-success p-3 rounded-circle me-3"><i class="fa fa-video"></i></span>
                                <div>
                                    <h6 class="mb-0">Newton's Laws Explained</h6>
                                    <small class="text-muted">Physics • Video</small>
                                </div>
                            </div>
                            <p class="text-muted small mb-3">Visual walkthrough of Newton's three laws with real-world demonstrations.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-1">
                                    <span class="badge rounded-pill bg-light text-dark">dynamics</span>
                                    <span class="badge rounded-pill bg-light text-dark">laws</span>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-success"><i class="fa fa-play me-2"></i>Watch</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resource Card -->
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-warning text-dark p-3 rounded-circle me-3"><i class="fa fa-flask"></i></span>
                                <div>
                                    <h6 class="mb-0">Organic Chemistry Summary</h6>
                                    <small class="text-muted">Chemistry • Slides</small>
                                </div>
                            </div>
                            <p class="text-muted small mb-3">Key reaction mechanisms, functional groups, and tips for quick revision.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex gap-1">
                                    <span class="badge rounded-pill bg-light text-dark">organic</span>
                                    <span class="badge rounded-pill bg-light text-dark">summary</span>
                                </div>
                                <a href="#" class="btn btn-sm btn-outline-warning"><i class="fa fa-external-link-alt me-2"></i>Open</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tips Panel -->
                <div class="col-12">
                    <div class="bg-light rounded p-3 p-md-4">
                        <div class="d-flex align-items-start">
                            <i class="fa fa-lightbulb text-warning me-3 mt-1"></i>
                            <div>
                                <div class="fw-semibold mb-1">Study Tips</div>
                                <ul class="small text-muted mb-0 ps-3">
                                    <li>Organize resources by topic and difficulty.</li>
                                    <li>Practice with past papers after reviewing notes.</li>
                                    <li>Use spaced repetition for long-term retention.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Content End -->
</div>
<!-- End Container Fluid -->

@endsection

