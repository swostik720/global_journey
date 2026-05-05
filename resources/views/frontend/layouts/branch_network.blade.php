@php
    $branchSectionEyebrow = $branchSectionEyebrow ?? 'Explore Our ';
    $branchSectionTitle = $branchSectionTitle ?? 'Discover Our Global Branch Network';
    $branchSectionClass = $branchSectionClass ?? 'offices gap';
    $branchSectionBackground = $branchSectionBackground ?? '#f0f6ff';
@endphp

<section data-aos="fade-up" class="{{ $branchSectionClass }} gj-branch-network"
    style="background-color:{{ $branchSectionBackground }};">
    <div class="container">
        <div data-aos="fade-up" data-aos-delay="100" class="heading-boder two text-center">
            <h2>{{ $branchSectionEyebrow }}<span>Locations</span></h2>
            <p>{{ $branchSectionTitle }}</p>
        </div>

        <div class="row g-4">
            @foreach ($branches ?? collect() as $branch)
                <div class="col-xl-6 col-lg-6">
                    <article data-aos="zoom-in-up" data-aos-delay="140" class="gj-branch-card">
                        <h3>{{ $branch->name ?? '' }}</h3>
                        <ul>
                            <li>
                                <i class="bi bi-envelope-fill"></i>
                                <span>{{ $branch->email ?? '' }}</span>
                            </li>
                            <li>
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>{{ $branch->contact_address ?? '' }}</span>
                            </li>
                            <li>
                                <i class="bi bi-telephone-fill"></i>
                                <span>{{ $branch->phone ?? '' }}</span>
                            </li>
                            <li>
                                <i class="bi bi-clock-fill"></i>
                                <span>{{ $branch->working_hours ?? '' }}</span>
                            </li>
                        </ul>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
    <div class="tp-hero__shapes">
        <div class="style-shapes-1"></div>
        <div class="style-shapes-2">
            <img alt="shap-4" src="{{ asset('frontend/assets/img/shap-4.png') }}">
        </div>
        <div class="style-shapes-3"></div>
    </div>
</section>

@once
    <style>
        .gj-branch-network {
            background: linear-gradient(180deg, #f8fbff 0%, #f0f6ff 100%);
        }

        .gj-branch-network .gj-branch-card {
            height: 100%;
            background: linear-gradient(145deg, rgba(255, 255, 255, 0.98) 0%, rgba(242, 247, 255, 0.96) 100%);
            border-radius: 22px;
            padding: 26px;
            border: 1px solid rgba(74, 144, 226, 0.14);
            box-shadow: 0 16px 38px rgba(8, 20, 39, 0.08);
            transition: transform 0.32s ease, box-shadow 0.32s ease, border-color 0.32s ease;
        }

        .gj-branch-network .gj-branch-card:hover {
            transform: translateY(-8px);
            border-color: rgba(74, 144, 226, 0.32);
            box-shadow: 0 24px 52px rgba(8, 20, 39, 0.12);
        }

        .gj-branch-network .gj-branch-card h3 {
            margin-bottom: 16px;
            color: #0b1f44;
            font-size: 1.35rem;
            font-weight: 800;
            letter-spacing: -0.01em;
        }

        .gj-branch-network .gj-branch-card ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 12px;
        }

        .gj-branch-network .gj-branch-card li {
            display: grid;
            grid-template-columns: 40px 1fr;
            align-items: start;
            gap: 12px;
            color: #4e607c;
            font-size: 0.96rem;
            line-height: 1.6;
            transition: color 0.25s ease, transform 0.25s ease;
        }

        .gj-branch-network .gj-branch-card li:hover {
            color: #0f2460;
            transform: translateX(2px);
        }

        .gj-branch-network .gj-branch-card i {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(74, 144, 226, 0.14) 0%, rgba(34, 102, 204, 0.18) 100%);
            color: #0f2460;
            transition: transform 0.25s ease, background 0.25s ease, color 0.25s ease;
        }

        .gj-branch-network .gj-branch-card li:hover i {
            transform: scale(1.08);
            background: linear-gradient(135deg, #0f2460 0%, #1d4ed8 100%);
            color: #fff;
        }

        @media (max-width: 575.98px) {
            .gj-branch-network .gj-branch-card {
                padding: 20px;
                border-radius: 18px;
            }

            .gj-branch-network .gj-branch-card li {
                grid-template-columns: 36px 1fr;
                gap: 10px;
                font-size: 0.92rem;
            }

            .gj-branch-network .gj-branch-card i {
                width: 36px;
                height: 36px;
                border-radius: 12px;
            }
        }
    </style>
@endonce

