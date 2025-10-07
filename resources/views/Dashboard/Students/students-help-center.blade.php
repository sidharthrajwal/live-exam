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

        <!-- Header -->
        <div class="container-fluid pt-4 px-4">
            <div class="row g-3 g-md-4 align-items-center">
                <div class="col-lg-8">
                    <div class="bg-light rounded p-3 p-md-4 h-100 d-flex align-items-center">
                        <div>
                            <h5 class="mb-1">Help Center</h5>
                            <small class="text-muted">Find answers to common questions or contact support</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="bg-light rounded p-3 p-md-4 h-100 d-flex align-items-center justify-content-between">
                        <div class="small text-muted">Need help fast?</div>
                        <a href="#contact" class="btn btn-primary btn-sm"><i class="fa fa-life-ring me-2"></i>Contact Support</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ + Contact -->
        <div class="container-fluid pt-2 px-4">
            <div class="row g-3 g-md-4">
                <!-- FAQs -->
                <div class="col-lg-8">
                    <div class="bg-light rounded p-3 p-md-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="mb-0">Frequently Asked Questions</h6>
                            <small class="text-muted">General</small>
                        </div>
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq1h">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                        How do I join an exam?
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="faq1h" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body small text-muted">
                                        Go to <b>Exams</b> from the sidebar, locate your active exam, and click <b>Enter Exam</b>. Make sure your internet connection is stable and do not refresh during the exam.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq2h">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                        Where can I see my results?
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faq2h" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body small text-muted">
                                        Navigate to <b>Results</b> in the sidebar. You can filter by subject or status and view detailed breakdowns.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faq3h">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                        I lost connection during an exam. What should I do?
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faq3h" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body small text-muted">
                                        Reconnect as soon as possible and try re-entering the exam. If the issue persists, contact support with your exam code and a brief description.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Card -->
                <div class="col-lg-4" id="contact">
                    <div class="bg-light rounded p-3 p-md-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <span class="badge bg-primary p-3 rounded-circle me-3"><i class="fa fa-headset"></i></span>
                            <div>
                                <h6 class="mb-0">Contact Support</h6>
                                <small class="text-muted">We usually respond within 24 hours</small>
                            </div>
                        </div>
                        <form class="small">
                            <div class="mb-2">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control form-control-sm" placeholder="you@example.com">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Subject</label>
                                <input type="text" class="form-control form-control-sm" placeholder="e.g. Issue with exam">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Message</label>
                                <textarea class="form-control form-control-sm" rows="4" placeholder="Describe your issue..."></textarea>
                            </div>
                            <button type="button" class="btn btn-primary btn-sm w-100"><i class="fa fa-paper-plane me-2"></i>Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="container-fluid pt-2 px-4">
            <div class="bg-light rounded p-3 p-md-4">
                <div class="row g-3 g-md-4">
                    <div class="col-6 col-md-3">
                        <a href="{{ url('exam') }}" class="btn btn-outline-primary w-100 btn-sm"><i class="fa fa-laptop me-2"></i>Go to Exams</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ url('result') }}" class="btn btn-outline-success w-100 btn-sm"><i class="fa fa-th me-2"></i>View Results</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ url('resources') }}" class="btn btn-outline-info w-100 btn-sm"><i class="fa fa-keyboard me-2"></i>Resources</a>
                    </div>
                    <div class="col-6 col-md-3">
                        <a href="{{ url('analytics') }}" class="btn btn-outline-warning w-100 btn-sm"><i class="fa fa-chart-bar me-2"></i>Analytics</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Content End -->
</div>
<!-- End Container Fluid -->

@endsection

