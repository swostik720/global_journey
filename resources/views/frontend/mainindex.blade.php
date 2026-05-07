@extends('frontend.layouts.includes.master')
@section('meta_title', 'Best Consultancy in Nepal for the UK and Australia | Consult Now')
@section('meta_description', 'If you are looking for the best consultancy in Nepal for the UK, Australia, Canada, the USA, and New Zealand, then contact us: +977-9843215204, 01-4168345')
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
