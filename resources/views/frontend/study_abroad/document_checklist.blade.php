@extends('frontend.layouts.includes.master')
@section('maincontent')
    <div class="container py-5">
        <div class="heading mb-5 text-center pt-5">
            <h6 class="text-primary">Document Checklist for {{ $country->name ?? 'Country' }}</h6>
            <h2>Documents Required for Studying in {{ $country->name ?? 'Country' }}</h2>
            <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="mx-auto mt-3"
                style="max-width:200px;">
        </div>

        @if ($checklist && $checklist->documents)
            <div class="row g-4">
                @foreach ($checklist->documents as $doc)
                    <div class="col-md-6 col-lg-4">
                        <div class="card checklist-card shadow-lg rounded-4 h-100 text-center position-relative"
                            style="border-radius: 20px;">
                            <div class="card-body p-4">
                                <div class="checklist-icon mb-3">
                                    <i class="fa fa-file text-primary" style="font-size:3rem;"></i>
                                </div>

                                <!-- Title (Clickable) -->
                                <div class="checklist-header d-flex justify-content-between align-items-center"
                                    style="cursor: pointer;" onclick="toggleDescription(this)">
                                    <p class="fw-semibold text-dark mb-0" style="font-size: 1.15rem;">
                                        {{ $doc['name'] }}
                                    </p>
                                    <i class="fa fa-chevron-down text-primary transition"></i>
                                </div>

                                <!-- Hidden Description -->
                                @if (!empty($doc['description']))
                                    <div class="checklist-description mt-3 text-muted"
                                        style="display: none; font-size: 0.95rem;">
                                        {{ $doc['description'] }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning text-center mt-4">
                <i class="bx bx-info-circle"></i> No checklist available for this country.
            </div>
        @endif
    </div>

    <style>
        .checklist-card {
            transition: all 0.35s ease;
            cursor: pointer;
            background: #fff;
        }

        .checklist-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.1);
            background: linear-gradient(145deg, #f2f8ff, #ffffff);
        }

        .checklist-icon {
            transition: all 0.4s ease;
        }

        .checklist-card:hover .checklist-icon {
            transform: rotate(-10deg) scale(1.2);
        }

        .checklist-header i {
            transition: transform 0.3s ease;
        }

        .checklist-header.active i {
            transform: rotate(180deg);
        }

        .checklist-description {
            animation: slideDown 0.35s ease forwards;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        function toggleDescription(element) {
            const description = element.parentElement.querySelector('.checklist-description');
            const icon = element.querySelector('i');

            if (description) {
                const isVisible = description.style.display === 'block';
                // Close all other open descriptions
                document.querySelectorAll('.checklist-description').forEach(desc => desc.style.display = 'none');
                document.querySelectorAll('.checklist-header').forEach(header => header.classList.remove('active'));

                if (!isVisible) {
                    description.style.display = 'block';
                    element.classList.add('active');
                } else {
                    description.style.display = 'none';
                    element.classList.remove('active');
                }
            }
        }
    </script>
@endsection
