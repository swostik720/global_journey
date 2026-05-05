@extends('frontend.layouts.includes.master')
@section('meta_title', 'Home | ' . ($setting->name ?? config('app.name')))
@section('meta_description', 'Global Journey offers study abroad counseling, test preparation, admissions planning, and visa guidance for students in Nepal.')
@section('maincontent')
    @if (!empty($homepageFaqSchema))
        <script type="application/ld+json">
            {!! json_encode($homepageFaqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}
        </script>
    @endif

    @include('frontend.layouts.banner_section')

    @include('frontend.layouts.brands')

    @include('frontend.layouts.empowering_global')

    @include('frontend.layouts.study_procedure')

    @include('frontend.layouts.study_destination')

    @include('frontend.layouts.why_choose_global')

    @include('frontend.layouts.our_blogs')

    @include('frontend.layouts.lets_start_together')

    @include('frontend.layouts.home_faq')

    @include('frontend.layouts.branch_network')

    @include('frontend.layouts.take_next_step')

    @include('frontend.layouts.stay_updated')

@endsection
