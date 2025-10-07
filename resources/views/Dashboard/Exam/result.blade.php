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

        <!-- Results Content Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
                <div class="col-12">
                    <div class="bg-light rounded p-3 p-md-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="mb-0">Exam Results</h6>
                            <div class="d-flex gap-2">
                                <select class="form-select form-select-sm" style="width:auto">
                                    <option selected>All Subjects</option>
                                    <option>Mathematics</option>
                                    <option>Physics</option>
                                    <option>Chemistry</option>
                                </select>
                                <select class="form-select form-select-sm" style="width:auto">
                                    <option selected>All Status</option>
                                    <option>Passed</option>
                                    <option>Failed</option>
                                    <option>Pending</option>
                                </select>
                            </div>
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
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Mid-Term Assessment</td>
                                        <td>Mathematics</td>
                                        <td>Sep 15, 2025</td>
                                        <td>85/100</td>
                                        <td><span class="badge bg-success">Passed</span></td>
                                        <td class="text-end"><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>Chapter Quiz</td>
                                        <td>Physics</td>
                                        <td>Sep 18, 2025</td>
                                        <td>42/60</td>
                                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                                        <td class="text-end"><a href="#" class="btn btn-sm btn-outline-primary">Details</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Results Content End -->
    </div>
    <!-- Content End -->
</div>
<!-- End Container Fluid -->

@endsection
