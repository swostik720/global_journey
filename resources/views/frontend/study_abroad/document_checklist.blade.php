@extends('frontend.layouts.includes.master')
@section('maincontent')
    <div class="container py-5">
        <!-- Page Heading -->
        <div data-aos="fade-up" data-aos-delay="100" class="heading mb-5 text-center pt-5">
            <h6 class="text-primary">Document Checklist for {{ $country->name ?? 'Country' }}</h6>
            <h2>Annual Income Documents for Studying in {{ $country->name ?? 'Country' }}</h2>
            <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}" class="mx-auto mt-3" style="max-width:200px;">
        </div>

        <!-- Download Section -->
        <div class="text-center mb-5">
            <p>Download the full document checklist for <strong>{{ $country->name ?? 'Country' }}</strong></p>
            @php
                // Generate country-specific PDF file name
                $countryFile = strtolower(str_replace(' ', '_', $country->name ?? '')) . '_document_checklist.pdf';
                $pdfPath = 'frontend/assets/pdf/' . $countryFile;
            @endphp

            @if (file_exists(public_path($pdfPath)))
                <a href="{{ asset($pdfPath) }}" class="themebtu" download>
                    <i class="fa fa-download me-2"></i> Download PDF
                </a>
            @else
                <p class="text-danger mt-3">No PDF available for this country yet.</p>
            @endif
        </div>

        @if ($checklist && $checklist->documents)
            <!-- Checklist Cards -->
            <div class="row g-4">
                @foreach ($checklist->documents as $doc)
                    <div class="col-md-6 col-lg-4">
                        <div data-aos="zoom-in-up" data-aos-delay="140" class="card checklist-card shadow-sm h-100 text-center">
                            <div data-aos="zoom-in-up" data-aos-delay="140" class="card-body p-4">
                                <div class="checklist-icon mb-3 text-primary">
                                    <i class="fa fa-file fa-3x"></i>
                                </div>

                                <!-- Title (Clickable) -->
                                <div class="checklist-header d-flex justify-content-between align-items-center"
                                    style="cursor: pointer;" onclick="toggleDescription(this)">
                                    <p class="fw-semibold text-dark mb-0" style="font-size: 1.1rem;">{{ $doc['name'] }}</p>
                                    <i class="fa fa-chevron-down text-primary transition"></i>
                                </div>

                                <!-- Hidden Description -->
                                @if (!empty($doc['description']))
                                    <div class="checklist-description mt-3 text-muted"
                                        style="
                                            display: none;
                                            font-size: 0.95rem;
                                            text-align: left;
                                            margin-top: 10px;
                                            line-height: 1.6;
                                        ">
                                        <ul
                                            style="
                                                padding-left: 18px;
                                                margin-bottom: 0;
                                                list-style-type: disc;
                                            ">
                                            @foreach (explode("\n", trim($doc['description'])) as $line)
                                                @if (!empty(trim($line)))
                                                    <li>{{ trim($line, '- ') }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Other Documents Section -->
            <div class="text-center mt-5 pt-5">
                <h2>Other GTE Documents</h2>
                <img src="{{ asset('frontend/assets/img/headingline.png') }}" alt="line" class="mx-auto mt-3 mb-3" style="max-width:200px;">
                <p>For more GTE Documents, download the document checklist for
                    <strong>{{ $country->name ?? 'Country' }}</strong>
                </p>
                @if (file_exists(public_path($pdfPath)))
                    <a href="{{ asset($pdfPath) }}" class="themebtu" download>
                        <i class="fa fa-download me-2"></i> Download PDF
                    </a>
                @else
                    <p class="text-danger mt-3">No PDF available for this country yet.</p>
                @endif
            </div>
        @else
            <div class="alert alert-warning text-center mt-4">
                <i class="bx bx-info-circle"></i> No checklist available for this country.
            </div>
        @endif
    </div>

    <style>
        /* Card Styles */
        .checklist-card {
            border-radius: 20px;
            transition: all 0.35s ease;
            cursor: pointer;
            background: #fff;
        }

        .checklist-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
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

        /* Slide Down Animation */
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
