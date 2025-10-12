@extends('layouts.master')
@section('title', 'DASHBOARD')

@section('content')
<div class="container-xxl py-4">
    <div class="text-center mb-5">
        <h3 class="fw-bold mb-2">📊 Dashboard Overview</h3>
        <p class="text-muted">Quick summary of key organizational data</p>
    </div>

    <div class="row g-4 justify-content-center">

        <!-- Countries -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-box p-4 rounded-4 shadow-sm d-flex align-items-center justify-content-between bg-white">
                <div>
                    <h6 class="mb-1 fw-semibold text-uppercase small text-muted">Countries</h6>
                    <h2 class="fw-bold mb-0">4</h2>
                </div>
                <i class="fa fa-globe fa-2x text-primary icon-float"></i>
            </div>
        </div>

        <!-- Branches -->
        <div class="col-md-6 col-lg-3">
            <div class="stat-box p-4 rounded-4 shadow-sm d-flex align-items-center justify-content-between bg-white">
                <div>
                    <h6 class="mb-1 fw-semibold text-uppercase small text-muted">Branches</h6>
                    <h2 class="fw-bold mb-0">3</h2>
                </div>
                <i class="fa fa-building fa-2x text-success icon-float"></i>
            </div>
        </div>

    </div>
</div>

<style>
/* Card Hover Effect */
.stat-box {
    transition: all 0.3s ease;
}
.stat-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* Floating Icons Animation */
.icon-float {
    opacity: 0.8;
    transition: transform 0.4s ease, opacity 0.3s ease;
}
.stat-box:hover .icon-float {
    transform: scale(1.15);
    opacity: 1;
}
</style>
@endsection
