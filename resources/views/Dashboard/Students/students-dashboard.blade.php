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

            <!-- Dashboard Content Start -->
            <div class="container-fluid pt-4 px-4">
                <!-- Quick Stats Start -->
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-calendar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Upcoming Exams</p>
                                <h6 class="mb-0">3</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-check-circle fa-3x text-success"></i>
                            <div class="ms-3">
                                <p class="mb-2">Completed Exams</p>
                                <h6 class="mb-0">5</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-info"></i>
                            <div class="ms-3">
                                <p class="mb-2">Average Score</p>
                                <h6 class="mb-0">85%</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-bell fa-3x text-warning"></i>
                            <div class="ms-3">
                                <p class="mb-2">Notifications</p>
                                <h6 class="mb-0">2 New</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Quick Stats End -->

                <div class="row g-4 mt-2">
                    <!-- Recent Activities Start -->
                    <div class="col-sm-12 col-xl-8">
                        <div class="bg-light text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Recent Activities</h6>
                                <a href="#">Show All</a>
                            </div>
                            <div class="activity-feed">
                                <div class="activity-item d-flex border-bottom py-3">
                                    <div class="activity-badge bg-primary text-white rounded-circle me-3">
                                        <i class="fa fa-book"></i>
                                    </div>
                                    <div class="activity-content text-start">
                                        <h6 class="mb-1">Mathematics Exam</h6>
                                        <p class="mb-0 text-muted">You have an upcoming exam in 2 days</p>
                                        <small class="text-muted">2 hours ago</small>
                                    </div>
                                </div>
                                <div class="activity-item d-flex border-bottom py-3">
                                    <div class="activity-badge bg-success text-white rounded-circle me-3">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="activity-content text-start">
                                        <h6 class="mb-1">Science Results</h6>
                                        <p class="mb-0 text-muted">Your exam results have been published</p>
                                        <small class="text-muted">1 day ago</small>
                                    </div>
                                </div>
                                <div class="activity-item d-flex py-3">
                                    <div class="activity-badge bg-info text-white rounded-circle me-3">
                                        <i class="fa fa-bullhorn"></i>
                                    </div>
                                    <div class="activity-content text-start">
                                        <h6 class="mb-1">New Assignment</h6>
                                        <p class="mb-0 text-muted">New assignment uploaded for Physics</p>
                                        <small class="text-muted">2 days ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Recent Activities End -->

                    <!-- Notifications Start -->
                    <div class="col-sm-12 col-xl-4">
                        <div class="bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Notifications</h6>
                                <span class="badge bg-primary rounded-pill">2 New</span>
                            </div>
                            <div class="notifications">
                                <div class="notification-item d-flex align-items-center mb-3 p-2 bg-white rounded">
                                    <div class="icon-box bg-primary text-white rounded-circle me-3 p-2">
                                        <i class="fa fa-exclamation"></i>
                                    </div>
                                    <div class="notification-content text-start">
                                        <h6 class="mb-0">Exam Reminder</h6>
                                        <p class="mb-0 text-muted small">Mathematics exam tomorrow at 10:00 AM</p>
                                    </div>
                                </div>
                                <div class="notification-item d-flex align-items-center p-2 bg-white rounded">
                                    <div class="icon-box bg-success text-white rounded-circle me-3 p-2">
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="notification-content text-start">
                                        <h6 class="mb-0">Result Published</h6>
                                        <p class="mb-0 text-muted small">Your Science exam results are available</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Notifications End -->
                </div>

                <!-- Upcoming Deadlines Start -->
                <div class="row g-4 mt-2">
                    <div class="col-12">
                        <div class="bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Upcoming Deadlines</h6>
                                <a href="#">View All</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-borderless table-hover mb-0">
                                    <thead>
                                        <tr class="text-muted">
                                            <th scope="col">Subject</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Mathematics</td>
                                            <td>Exam</td>
                                            <td>Tomorrow, 10:00 AM</td>
                                            <td><span class="badge bg-warning text-dark">Upcoming</span></td>
                                            <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                        </tr>
                                        <tr>
                                            <td>Physics</td>
                                            <td>Assignment</td>
                                            <td>Sep 28, 2024</td>
                                            <td><span class="badge bg-info">In Progress</span></td>
                                            <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Upcoming Deadlines End -->
            </div>
            <!-- Dashboard Content End -->
        </div>
        <!-- Content End -->
    </div>
    <!-- End Container Fluid -->
</div>
<!-- End Container -->
@endsection