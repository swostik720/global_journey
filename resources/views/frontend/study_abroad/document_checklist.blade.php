@extends('frontend.layouts.includes.master')
@section('meta_title', ('Document Checklist for ' . ($country->name ?? 'Your Destination')) . ' | ' . ($setting->name ?? config('app.name')))
@section('meta_description', 'Review required study abroad documents and supporting financial checklist items to prepare a stronger application file.')
@section('maincontent')
    @include('frontend.layouts.includes.page_hero', [
        'eyebrow' => 'Document Checklist',
        'title' => 'Study Documents for ',
        'accent' => $country->name ?? 'Your Country',
        'subtitle' => 'Review the essential financial and supporting documents typically required for a stronger study abroad application file.',
        'meta' => ['Country-Specific Guidance', 'Downloadable Checklist', 'GTE Support'],
    ])

    <section class="gj-page-shell gj-page-shell--white">
    <div class="container">
        <div data-aos="fade-up" data-aos-delay="100" class="gj-section-header">
            <span class="gj-section-header__eyebrow">Document Checklist for {{ $country->name ?? 'Country' }}</span>
            <h2>Annual Income Documents for Studying in {{ $country->name ?? 'Country' }}</h2>
            <p>Start with the core documents first so your financial profile and supporting case stay organized from the beginning.</p>
        </div>

        @php
            $fallbackCountryFile = strtolower(str_replace(' ', '_', $country->name ?? '')) . '_document_checklist.pdf';
            $pdfPath = $checklist->pdf_path ?? ('frontend/assets/pdf/' . $fallbackCountryFile);
            $hasPdf = file_exists(public_path($pdfPath));
        @endphp

        <div class="checklist-action-panel" data-aos="fade-up" data-aos-delay="120">
            <div>
                <p class="checklist-action-panel__label">Country File</p>
                <h3 class="checklist-action-panel__title">{{ $country->name ?? 'Country' }} Document Checklist</h3>
                <p class="checklist-action-panel__text">Get the full PDF and keep your application file preparation on track.</p>
            </div>
            @if ($hasPdf)
                <div class="checklist-action-panel__buttons">
                    <a href="{{ asset($pdfPath) }}" class="themebtu" download>
                        <i class="bi bi-download me-2"></i> Download PDF
                    </a>
                    <a href="{{ asset($pdfPath) }}" target="_blank" class="themebtu themebtu--outline">
                        <i class="bi bi-eye me-2"></i> View PDF
                    </a>
                </div>
            @else
                <p class="text-danger mb-0">No PDF available for this country yet.</p>
            @endif
        </div>

        @if ($checklist && $checklist->documents)
            <div class="checklist-stack">
                @foreach ($checklist->documents as $doc)
                    <article data-aos="fade-up" data-aos-delay="140" class="checklist-item">
                        <button type="button" class="checklist-trigger" onclick="toggleDescription(this)">
                            <span class="checklist-trigger__left">
                                <span class="checklist-count">{{ str_pad((string) ($loop->iteration), 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="checklist-name">{{ $doc['name'] ?? 'Document' }}</span>
                            </span>
                            <i class="bi bi-chevron-down"></i>
                        </button>

                        @if (!empty($doc['description']))
                            <div class="checklist-description">
                                <ul class="checklist-bullets">
                                    @foreach (preg_split('/\r\n|\r|\n/', trim($doc['description'])) as $line)
                                        @if (!empty(trim($line)))
                                            <li>{{ preg_replace('/^[-*•\s]+/u', '', trim($line)) }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </article>
                @endforeach
            </div>
        @else
            <div class="alert alert-warning text-center mt-4">
                <i class="bx bx-info-circle"></i> No checklist available for this country.
            </div>
        @endif
    </div>
    </section>

    <style>
        .checklist-action-panel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            background: linear-gradient(135deg, #f6fafc 0%, #eaf4ff 100%);
            border: 1px solid #d8e8f8;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 32px;
        }

        .checklist-action-panel__label {
            margin: 0 0 4px;
            color: #2f6fa8;
            font-weight: 700;
            font-size: 0.76rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .checklist-action-panel__title {
            margin: 0 0 6px;
            font-size: 1.35rem;
            color: #12324d;
        }

        .checklist-action-panel__text {
            margin: 0;
            color: #4d6277;
        }

        .checklist-action-panel__buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 10px;
        }

        .themebtu.themebtu--outline {
            background: #fff;
            color: #0d5d99;
            border: 1px solid #bfd9ef;
        }

        .checklist-stack {
            display: grid;
            gap: 14px;
        }

        .checklist-item {
            border: 1px solid #e3edf7;
            border-radius: 14px;
            background: #fff;
            overflow: hidden;
            box-shadow: 0 3px 12px rgba(18, 50, 77, 0.05);
            transition: box-shadow 0.25s ease, transform 0.25s ease;
        }

        .checklist-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(18, 50, 77, 0.12);
        }

        .checklist-trigger {
            width: 100%;
            border: 0;
            background: transparent;
            padding: 16px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            text-align: left;
            cursor: pointer;
        }

        .checklist-trigger__left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .checklist-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #eef5ff;
            color: #205f96;
            font-size: 0.84rem;
            font-weight: 700;
        }

        .checklist-name {
            font-size: 1.02rem;
            font-weight: 600;
            color: #122f48;
            line-height: 1.35;
        }

        .checklist-trigger i {
            color: #205f96;
            font-size: 1.1rem;
            transition: transform 0.25s ease;
        }

        .checklist-trigger.active i {
            transform: rotate(180deg);
        }

        .checklist-description {
            display: none;
            border-top: 1px solid #ecf2f8;
            padding: 14px 20px 16px 56px;
            color: #455d75;
        }

        .checklist-description ul,
        .checklist-bullets {
            margin: 0;
            padding-left: 22px !important;
            list-style: disc !important;
            line-height: 1.75;
        }

        .checklist-description li,
        .checklist-bullets li {
            margin-bottom: 2px;
            display: list-item !important;
            list-style: disc !important;
        }

        .checklist-description li::marker,
        .checklist-bullets li::marker {
            color: #1e5c91;
            font-size: 0.95em;
        }

        @media (max-width: 991px) {
            .checklist-action-panel {
                flex-direction: column;
                align-items: flex-start;
            }

            .checklist-action-panel__buttons {
                justify-content: flex-start;
            }
        }

        @media (max-width: 576px) {
            .checklist-trigger {
                padding: 14px;
            }

            .checklist-name {
                font-size: 0.95rem;
            }

            .checklist-description {
                padding: 12px 14px 14px 14px;
            }

            .checklist-action-panel {
                margin-bottom: 24px;
                padding: 16px;
            }
        }
    </style>

    <script>
        function toggleDescription(element) {
            const description = element.closest('.checklist-item').querySelector('.checklist-description');

            if (description) {
                const isVisible = description.style.display === 'block';
                // Close all other open descriptions
                document.querySelectorAll('.checklist-description').forEach(desc => desc.style.display = 'none');
                document.querySelectorAll('.checklist-trigger').forEach(header => header.classList.remove('active'));

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

