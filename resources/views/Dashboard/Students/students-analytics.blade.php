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

        <!-- Header and Filters -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-3 g-md-4 align-items-center">
                <div class="col-lg-7">
                    <div class="bg-light rounded p-3 p-md-4 h-100 d-flex align-items-center">
                        <div>
                            <h5 class="mb-1">Performance Analytics</h5>
                            <small class="text-muted">Track your scores, trends, and study progress</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="bg-light rounded p-3 p-md-4">
                        <div class="row g-2">
                            <div class="col-6">
                                <select class="form-select form-select-sm">
                                    <option selected>All Subjects</option>
                                    <option>Mathematics</option>
                                    <option>Physics</option>
                                    <option>Chemistry</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <select class="form-select form-select-sm">
                                    <option selected>Last 30 days</option>
                                    <option>Last 7 days</option>
                                    <option>Last 90 days</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="container-fluid pt-2 px-4">
            <div class="row g-3 g-md-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Average Score</div>
                            <div class="fs-4 fw-semibold">82%</div>
                        </div>
                        <span class="badge bg-success"><i class="fa fa-arrow-up me-1"></i>+4%</span>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Exams Completed</div>
                            <div class="fs-4 fw-semibold">12</div>
                        </div>
                        <span class="badge bg-primary"><i class="fa fa-check me-1"></i></span>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Study Hours</div>
                            <div class="fs-4 fw-semibold">36h</div>
                        </div>
                        <span class="badge bg-info"><i class="fa fa-clock me-1"></i></span>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small">Consistency</div>
                            <div class="fs-4 fw-semibold">76%</div>
                        </div>
                        <span class="badge bg-warning text-dark"><i class="fa fa-bolt me-1"></i></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="container-fluid pt-2 px-4">
            <div class="row g-3 g-md-4">
                <div class="col-lg-8">
                    <div class="bg-light rounded p-3 p-md-4 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="mb-0">Score Trend</h6>
                            <small class="text-muted">Last 10 exams</small>
                        </div>
                        <div class="border rounded bg-white" style="height: 280px; display:flex; align-items:center; justify-content:center;">
                            <div class="text-muted small"><i class="fa fa-chart-line me-2"></i>Chart placeholder</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-light rounded p-3 p-md-4 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="mb-0">Subject Breakdown</h6>
                            <small class="text-muted">Average by subject</small>
                        </div>
                        <div class="border rounded bg-white" style="height: 280px; display:flex; align-items:center; justify-content:center;">
                            <div class="text-muted small"><i class="fa fa-chart-pie me-2"></i>Chart placeholder</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Performance Table -->
        <div class="container-fluid pt-2 px-4">
            <div class="row g-3 g-md-4">
                <div class="col-12">
                    <div class="bg-light rounded p-3 p-md-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="mb-0">Recent Exams</h6>
                            <a href="#" class="small">View all</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle table-hover mb-0">
                                <thead>
                                    <tr class="text-muted">
                                        <th>Exam</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Score</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Unit Test</td>
                                        <td>Mathematics</td>
                                        <td>Sep 10, 2025</td>
                                        <td>78%</td>
                                        <td><span class="badge bg-success">Passed</span></td>
                                    </tr>
                                    <tr>
                                        <td>Chapter Quiz</td>
                                        <td>Physics</td>
                                        <td>Sep 16, 2025</td>
                                        <td>64%</td>
                                        <td><span class="badge bg-warning text-dark">Borderline</span></td>
                                    </tr>
                                </tbody>
                            </table>
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

