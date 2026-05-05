@php
    $takeNextStepSubtitle = $takeNextStepSubtitle ?? 'Take the Next Step';
    $takeNextStepTitle = $takeNextStepTitle ?? 'You';
    $takeNextStepItems = $takeNextStepItems ?? [
        [
            'icon' => 'bi bi-person-lines-fill',
            'title' => 'Free Consultation',
            'body' => 'Get a personalised profile evaluation and discover the best study destinations and universities tailored just for you.',
            'url' => url('/contact-us'),
            'button' => 'Book Free Session',
        ],
        [
            'icon' => 'bi bi-journal-check',
            'title' => 'Test Preparation',
            'body' => 'Expert IELTS, PTE, TOEFL, SAT, and GRE coaching designed to help you hit your target score fast.',
            'url' => route('test-preparation'),
            'button' => 'Explore Courses',
        ],
        [
            'icon' => 'bi bi-mic-fill',
            'title' => 'Interview Preparation',
            'body' => 'Build confidence for credibility interviews with expert-led practice sessions, structured feedback, and real question simulations.',
            'url' => route('interview-preparation'),
            'button' => 'Prepare Now',
        ],
    ];
@endphp

<section data-aos="fade-up" class="bds-extra-ctas-section">
    <div class="container">
        <div class="tp-hero__shapes bds-extra-ctas__shapes">
            <div class="style-shapes-1"></div>
            <div class="style-shapes-2">
                <img alt="shape" src="{{ asset('frontend/assets/img/shap-4.png') }}">
            </div>
            <div class="style-shapes-3"></div>
            <div class="style-shapes-5">
                <img alt="shape" src="{{ asset('frontend/assets/img/shap-1.png') }}">
            </div>
            <div class="style-shapes-6">
                <img alt="shape" src="{{ asset('frontend/assets/img/shap-2.png') }}">
            </div>
        </div>

        <div data-aos="fade-up" data-aos-delay="100" class="heading-boder two text-center">
            <h2>How We Can<span>{{ $takeNextStepTitle }}</span></h2>
            <p>{{ $takeNextStepSubtitle }}</p>
        </div>
        <div class="bds-extra-ctas__grid">
            @foreach ($takeNextStepItems as $index => $item)
                <div data-aos="zoom-in-up" data-aos-delay="{{ 100 + ($index * 90) }}" class="bds-extra-cta bds-extra-cta--{{ ($index % 3) + 1 }}">
                    <div class="bds-extra-cta__icon"><i class="{{ $item['icon'] }}"></i></div>
                    <h3 class="bds-extra-cta__title">{{ $item['title'] }}</h3>
                    <p class="bds-extra-cta__body">{{ $item['body'] }}</p>
                    <a href="{{ $item['url'] }}" class="bds-extra-cta__btn">{{ $item['button'] }} <i class="bi bi-arrow-right ms-1"></i></a>
                </div>
            @endforeach
        </div>
    </div>
</section>

@once
    @push('custom_css')
        <style>
            .bds-extra-ctas-section,
            .bds-extra-ctas-section * { font-family: "Poppins", sans-serif !important; }

            .bds-extra-ctas-section {
                background: linear-gradient(180deg, #ffffff 0%, #f7faff 100%);
                padding: 76px 0 62px;
                position: relative;
                overflow: hidden;
            }
            .bds-extra-ctas-section .container { position: relative; z-index: 1; }
            .bds-extra-ctas__shapes { pointer-events: none; }
            .bds-extra-ctas-section .heading-boder { margin-bottom: 34px; }
            .bds-extra-ctas-section .heading-boder h2 { color: #111827; }
            .bds-extra-ctas-section .heading-boder p { color: #5f7399; font-weight: 500; }
            .bds-extra-ctas-section .heading-boder img { margin-top: 12px; }
            .bds-extra-ctas__grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
            .bds-extra-cta {
                border-radius: 24px; padding: 30px 24px; color: #0f172a;
                display: flex; flex-direction: column; gap: 12px;
                box-shadow: 0 18px 42px rgba(15,36,96,0.09);
                transition: transform 0.25s ease, box-shadow 0.25s ease;
                position: relative; overflow: hidden;
                border: 1px solid rgba(15,36,96,0.08);
                background: linear-gradient(180deg, #ffffff 0%, #f7faff 100%);
            }
            .bds-extra-cta::before {
                content: ""; position: absolute; left: 0; right: 0; top: 0; height: 6px;
                pointer-events: none;
            }
            .bds-extra-cta::after {
                content: "";
                position: absolute;
                right: -34px;
                bottom: -34px;
                width: 120px;
                height: 120px;
                border-radius: 50%;
                background: radial-gradient(circle, rgba(96,165,250,0.18) 0%, rgba(96,165,250,0) 72%);
            }
            .bds-extra-cta:hover { transform: translateY(-6px); box-shadow: 0 20px 44px rgba(15,36,96,0.14); }
            .bds-extra-cta--1::before { background: linear-gradient(90deg, #0f2460, #1d4ed8); }
            .bds-extra-cta--2 { background: linear-gradient(180deg, #ffffff 0%, #f2f7ff 100%); }
            .bds-extra-cta--2::before { background: linear-gradient(90deg, #12306f, #2563eb); }
            .bds-extra-cta--3 { background: linear-gradient(180deg, #ffffff 0%, #eef4ff 100%); }
            .bds-extra-cta--3::before { background: linear-gradient(90deg, #1d4ed8, #60a5fa); }
            .bds-extra-cta > * { position: relative; z-index: 1; }
            .bds-extra-cta__icon {
                width: 60px; height: 60px; border-radius: 20px;
                background: linear-gradient(135deg, #dbeafe, #bfdbfe);
                display: flex; align-items: center; justify-content: center; font-size: 24px;
                color: #12306f;
            }
            .bds-extra-cta__title { font-size: 1.24rem; font-weight: 700; color: #0f172a; line-height: 1.35; margin: 0; }
            .bds-extra-cta__body  { font-size: 14px; line-height: 1.72; color: #475569; flex: 1; margin: 0; }
            .bds-extra-cta__btn {
                display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px;
                border-radius: 12px; background: linear-gradient(135deg, #0f2460, #1d4ed8);
                border: 1px solid rgba(15,36,96,0.12); color: #fff;
                font-size: 13px; font-weight: 600; text-decoration: none;
                transition: all 0.18s; align-self: flex-start;
            }
            .bds-extra-cta__btn:hover { background: linear-gradient(135deg, #0d1e4f, #143ba5); color: #fff; border-color: transparent; }

            @media (max-width: 1100px) {
                .bds-extra-ctas__grid { grid-template-columns: repeat(2, 1fr); }
            }
            @media (max-width: 768px) {
                .bds-extra-ctas__grid { grid-template-columns: 1fr; }
            }
        </style>
    @endpush
@endonce
