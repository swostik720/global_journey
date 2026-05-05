@extends('frontend.layouts.includes.master')
@section('meta_title', ($page->title_text ?: $pageLabel ?: 'Legal Information') . ' | ' . ($setting->name ?? config('app.name')))
@section('meta_description', 'Read official legal information, terms, and policy documents from Global Journey.')

@section('maincontent')
@include('frontend.layouts.includes.page_hero', [
    'eyebrow' => 'Global Journey Legal Center',
    'title' => $page->title_text ?: $pageLabel,
    'subtitle' => 'Important legal information, policies, and terms presented in a clear format for students, families, and partners.',
    'meta' => ['Last updated: ' . ($page->last_updated ?: 'N/A'), 'Official Policy Page'],
])

<section class="legal-body gj-page-shell gj-page-shell--white gj-page-shell--compact" data-aos="fade-up" data-aos-delay="100">
    <div class="container">
        <div class="legal-paper">
            {!! $page->description_html !!}
        </div>
    </div>
</section>

<style>
    .legal-hero {
        position: relative;
        padding: 74px 0 28px;
        background:
            radial-gradient(circle at 11% 22%, rgba(30, 86, 188, 0.22), transparent 42%),
            radial-gradient(circle at 88% 9%, rgba(19, 154, 132, 0.24), transparent 37%),
            linear-gradient(140deg, #f1f7ff 0%, #f8fcff 52%, #f2f7fb 100%);
        overflow: hidden;
    }

    .legal-hero::before {
        content: '';
        position: absolute;
        width: 460px;
        height: 460px;
        border-radius: 50%;
        right: -180px;
        top: -180px;
        background: rgba(18, 101, 204, 0.15);
        animation: orbitFloat 9s ease-in-out infinite;
    }

    .legal-hero__card {
        position: relative;
        z-index: 2;
        max-width: 860px;
        margin: 0 auto;
        text-align: center;
        background: rgba(255, 255, 255, 0.78);
        border: 1px solid rgba(16, 73, 170, 0.14);
        border-radius: 26px;
        backdrop-filter: blur(7px);
        box-shadow: 0 20px 44px rgba(9, 47, 107, 0.1);
        padding: 32px 26px;
    }

    .legal-hero__eyebrow {
        margin: 0 0 10px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-size: 12px;
        color: #0f549f;
        font-weight: 700;
    }

    .legal-hero h1 {
        margin: 0;
        font-size: clamp(30px, 5vw, 52px);
        line-height: 1.08;
        color: #0b2350;
        font-weight: 800;
    }

    .legal-hero__updated {
        margin: 14px 0 0;
        color: #496083;
        font-size: 15px;
        font-weight: 600;
    }

    .legal-body {
        padding: 24px 0 80px;
        background: linear-gradient(180deg, #f8fbff 0%, #ffffff 85%);
    }

    .legal-paper {
        max-width: 980px;
        margin: 0 auto;
        border-radius: 24px;
        border: 1px solid #dfebff;
        background: #ffffff;
        padding: clamp(20px, 4vw, 38px);
        box-shadow: 0 16px 40px rgba(7, 34, 80, 0.08);
        animation: paperRise .8s ease both;
    }

    .legal-paper h3 {
        margin: 28px 0 12px;
        color: #0d3d85;
        font-size: clamp(19px, 2vw, 23px);
        font-weight: 800;
        line-height: 1.35;
        border-left: 4px solid #1a63cb;
        padding-left: 10px;
    }

    .legal-paper p,
    .legal-paper li {
        color: #263f61;
        font-size: 16px;
        line-height: 1.8;
    }

    .legal-paper ul {
        margin: 8px 0 18px;
        padding-left: 20px;
    }

    .legal-paper strong {
        color: #102e62;
    }

    @keyframes orbitFloat {
        0%,
        100% {
            transform: translate(0, 0);
        }
        50% {
            transform: translate(-16px, 16px);
        }
    }

    @keyframes paperRise {
        0% {
            opacity: 0;
            transform: translateY(22px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 991.98px) {
        .legal-body {
            padding: 18px 0 56px;
        }
    }

    @media (max-width: 575.98px) {
        .legal-hero {
            padding: 40px 0 20px;
        }

        .legal-hero__card {
            padding: 22px 16px;
            border-radius: 18px;
        }

        .legal-body {
            padding: 14px 0 40px;
        }

        .legal-paper {
            border-radius: 16px;
        }

        .legal-paper h3 {
            margin: 20px 0 10px;
        }

        .legal-paper p,
        .legal-paper li {
            font-size: 15px;
        }
    }
</style>
@endsection
