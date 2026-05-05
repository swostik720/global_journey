@if(isset($homepageFaqs) && $homepageFaqs->isNotEmpty())
    <section data-aos="fade-up" class="home-faq-section">
        <div class="container">
            <div data-aos="fade-up" data-aos-delay="90" class="heading-boder text-center two">
                <h2>Frequently Asked <br><span>Questions</span></h2>
                <p>Quick answers to common questions from students and families.</p>
            </div>

            <div data-aos="zoom-in-up" data-aos-delay="120" class="home-faq-wrap">
                <div class="accordion home-faq" id="homeFaqAccordion">
                    @foreach ($homepageFaqs as $index => $faq)
                        <div class="accordion-item home-faq__item" data-aos="fade-up" data-aos-delay="{{ 130 + ($index * 45) }}">
                            <h3 class="accordion-header" id="homeFaqHeading{{ $faq->id }}">
                                <button
                                    class="accordion-button home-faq__button {{ $index !== 0 ? 'collapsed' : '' }}"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#homeFaqCollapse{{ $faq->id }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-controls="homeFaqCollapse{{ $faq->id }}"
                                >
                                    {{ $faq->question }}
                                </button>
                            </h3>
                            <div
                                id="homeFaqCollapse{{ $faq->id }}"
                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                aria-labelledby="homeFaqHeading{{ $faq->id }}"
                                data-bs-parent="#homeFaqAccordion"
                            >
                                <div class="accordion-body home-faq__answer">
                                    {!! nl2br(e($faq->answer)) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <style>
        .home-faq-section {
            padding: 42px 0 42px;
            background: #f4f7fb;
        }

        .home-faq-section,
        .home-faq-section * {
            font-family: "Poppins", sans-serif;
        }

        .home-faq-section .heading-boder.two {
            margin-bottom: 24px;
        }

        .home-faq-section .heading-boder.two p {
            max-width: 62ch;
            margin-left: auto;
            margin-right: auto;
        }

        .home-faq-wrap {
            max-width: 960px;
            margin: 0 auto;
            border: 1px solid #e2e8f3;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(10, 30, 80, 0.07);
            padding: 24px;
        }

        .home-faq__item {
            border: 1px solid #e2e8f3;
            border-radius: 12px !important;
            overflow: hidden;
            margin-bottom: 12px;
            background: #fff;
        }

        .home-faq__item:last-child {
            margin-bottom: 0;
        }

        .home-faq__button {
            font-weight: 600;
            color: #1e3a8a;
            background: #fff;
            padding: 16px 18px;
            border: 0;
            box-shadow: none !important;
            line-height: 1.5;
            transition: background-color 0.25s ease, color 0.25s ease;
        }

        .home-faq__button:not(.collapsed) {
            color: #1d4ed8;
            background: #eff6ff;
        }

        .home-faq__button::after {
            transition: transform 0.3s ease;
        }

        .home-faq .accordion-collapse {
            transition: height 0.32s ease;
        }

        .home-faq__answer {
            color: #475569;
            line-height: 1.85;
            background: #f8fbff;
            padding: 16px 18px;
            animation: homeFaqFade 0.24s ease;
        }

        @keyframes homeFaqFade {
            from {
                opacity: 0;
                transform: translateY(-2px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 991.98px) {
            .home-faq-section {
                padding: 18px 0 34px;
            }

            .home-faq-wrap {
                padding: 18px;
            }
        }

        @media (max-width: 575.98px) {
            .home-faq-section {
                padding: 14px 0 28px;
            }

            .home-faq-wrap {
                border-radius: 14px;
                padding: 14px;
            }

            .home-faq__button {
                padding: 14px 15px;
                font-size: 0.96rem;
            }

            .home-faq__answer {
                padding: 13px 15px;
                font-size: 0.94rem;
            }
        }
    </style>
@endif
