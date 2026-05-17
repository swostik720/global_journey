<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="google-site-verification" content="LrVtsw_d_nzB4Vt_Fk6Xgp_KJa7XS1YHoZ8v4tPoERM" />
@php
    $defaultSiteTitle = $setting->name ?? config('app.name', 'Global journeys');
    $routeName = request()->route()?->getName() ?? '';
    $metaTitleSuffix = ' | Global Journey Nepal';
    $metaTitleMinimumSuffixMap = [
        'home' => ' | Study Abroad Counseling Nepal',
        'about-us' => ' | Our Counseling Team Nepal',
        'contact-us' => ' | Book Guidance Appointment',
        'enquiry-us' => ' | Personalized Counseling Query',
        'enrollNow' => ' | Student Enrollment Support',
        'blogs' => ' | Student Visa Tips Nepal',
        'blog.details' => ' | Study Abroad Insights',
        'blog.profile' => ' | Author Expertise and Articles',
        'study-abroad' => ' | Country and Admission Guidance',
        'study-abroad.details' => ' | Course and Visa Guidance',
        'frontend.study_abroad.document_checklist' => ' | Required Documents and Proofs',
        'frontend.study_abroad.college_and_university' => ' | Institution Selection Support',
        'frontend.study_abroad.why_country' => ' | Benefits and Career Outcomes',
        'frontend.study_abroad.country_guide' => ' | Admission and Living Guide',
        'test-preparation' => ' | Exam Classes and Strategies',
        'test-preparation.details' => ' | Exam Pattern and Tips',
        'interview-preparation' => ' | Visa Interview Preparation',
        'interview-preparation.details' => ' | Questions and Strategy',
        'galleries.index' => ' | Student Journey Moments',
        'gallery.details' => ' | Event Highlights and Stories',
        'terms-and-conditions' => ' | Legal Terms and Policies',
        'privacy-policy' => ' | Data Protection and Privacy',
    ];
    $metaDescriptionSuffixMap = [
        'home' => ' Explore destinations, admissions planning, test preparation, and visa documentation support with Global Journey Nepal.',
        'about-us' => ' Meet our counselors and learn how we guide students through applications, documentation, and pre-departure preparation.',
        'contact-us' => ' Reach out for counseling, document review, class details, and personalized study abroad planning support.',
        'enquiry-us' => ' Share your goals and timeline to receive personalized recommendations from our counseling team.',
        'enrollNow' => ' Complete your enrollment request and connect with our advisors for next-step planning and support.',
        'blogs' => ' Discover practical guidance on admissions, scholarships, visa processes, and destination-wise student planning.',
        'blog.details' => ' Get practical study abroad insights, timelines, and application tips tailored for students from Nepal.',
        'blog.profile' => ' Read expert-written articles, destination guides, and admission strategies from this author profile.',
        'study-abroad' => ' Compare destinations, requirements, intakes, and visa pathways for your academic goals.',
        'study-abroad.details' => ' Review eligibility, documents, deadlines, and visa guidance for this study option.',
        'frontend.study_abroad.document_checklist' => ' Review country-specific checklists for documents, finances, and application readiness.',
        'frontend.study_abroad.college_and_university' => ' Compare universities, course options, tuition, and admission criteria for this destination.',
        'frontend.study_abroad.why_country' => ' Understand education quality, career pathways, and lifestyle benefits before choosing this country.',
        'frontend.study_abroad.country_guide' => ' Learn admission timelines, visa process, living costs, and student transition essentials.',
        'test-preparation' => ' Explore test formats, class options, and score improvement plans for abroad admissions.',
        'test-preparation.details' => ' Understand syllabus, scoring, and preparation strategy for this exam.',
        'interview-preparation' => ' Practice with common visa interview questions and confidence-building coaching.',
        'interview-preparation.details' => ' Prepare with focused interview questions, answer frameworks, and embassy expectations.',
        'galleries.index' => ' View student events, counseling activities, and successful journey highlights from Global Journey.',
        'gallery.details' => ' Explore event highlights and student moments that reflect real study abroad preparation journeys.',
        'terms-and-conditions' => ' Review terms, responsibilities, and service conditions for using Global Journey services.',
        'privacy-policy' => ' Learn how Global Journey collects, uses, and protects personal information and user data.',
    ];

    $cleanMetaText = static function ($value) {
        $text = strip_tags((string) $value);
        $text = html_entity_decode((string) $text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = preg_replace('/\s+/u', ' ', $text);

        return trim((string) $text);
    };

    $truncateMetaText = static function ($value, $limit = 154) use ($cleanMetaText) {
        $clean = $cleanMetaText($value);

        if ($clean === '' || mb_strlen($clean) <= $limit) {
            return $clean;
        }

        $slice = trim(mb_substr($clean, 0, max(0, $limit - 3)));
        $wordSafeSlice = preg_replace('/\s+\S*$/u', '', $slice);

        if (is_string($wordSafeSlice) && trim($wordSafeSlice) !== '') {
            $slice = trim($wordSafeSlice);
        }

        $result = $slice . '...';

        return mb_strlen($result) > $limit ? trim(mb_substr($result, 0, $limit)) : $result;
    };

    $limitMetaText = static function ($value, $limit = 154) use ($truncateMetaText) {
        return $truncateMetaText($value, $limit);
    };

    $normalizeMetaTitle = static function ($value, $fallbackTitle = '', $routeName = '') use ($cleanMetaText, $metaTitleSuffix, $metaTitleMinimumSuffixMap) {
        $title = $cleanMetaText($value);

        if ($title === '') {
            $title = $cleanMetaText($fallbackTitle);
        }

        if ($title !== '' && mb_strlen($title) < 43) {
            $contextSuffix = $metaTitleMinimumSuffixMap[$routeName] ?? ' | Study Abroad Guidance';
            $candidate = $cleanMetaText($title . $contextSuffix);
            $title = mb_strlen($candidate) <= 60 ? $candidate : $title;
        }

        if ($title !== '' && mb_strlen($title) < 43) {
            $candidate = $cleanMetaText($title . $metaTitleSuffix);
            $title = mb_strlen($candidate) <= 60 ? $candidate : $title;
        }

        if ($title !== '' && mb_strlen($title) < 43) {
            $candidate = $cleanMetaText($title . ' | Student Support Nepal');
            $title = mb_strlen($candidate) <= 60 ? $candidate : $title;
        }

        if ($title !== '' && mb_strlen($title) < 43) {
            $baseTitle = trim((string) \Illuminate\Support\Str::before($title, '|'));
            $minimumBridgeMap = [
                'frontend.study_abroad.why_country' => ' Guide',
                'study-abroad.details' => ' Overview',
                'test-preparation.details' => ' Guide',
                'interview-preparation.details' => ' Guide',
                'blog.details' => ' Insights',
            ];
            $minimumBridge = $minimumBridgeMap[$routeName] ?? ' Guide';

            if ($baseTitle !== '') {
                $candidate = $cleanMetaText($baseTitle . $minimumBridge . ' | Global Journey');
                $title = mb_strlen($candidate) <= 60 ? $candidate : $title;
            }
        }

        if ($title !== '' && mb_strlen($title) < 43) {
            $needed = 43 - mb_strlen($title);
            $tail = ' Guide and Tips';

            if ($needed > 0) {
                $candidate = $cleanMetaText($title . mb_substr($tail, 0, $needed));
                $title = mb_strlen($candidate) <= 60 ? $candidate : $title;
            }
        }

        if (mb_strlen($title) > 60) {
            $title = trim(mb_substr($title, 0, 60));
        }

        return $title;
    };

    $normalizeMetaDescription = static function ($value, $fallbackDescription = '', $routeName = '') use ($cleanMetaText, $metaDescriptionSuffixMap, $truncateMetaText) {
        $description = $cleanMetaText($value);

        if ($description === '') {
            $description = $cleanMetaText($fallbackDescription);
        }

        if ($description !== '' && mb_strlen($description) < 150) {
            $contextSuffix = $metaDescriptionSuffixMap[$routeName] ?? ' Get counseling, admission, and visa support from Global Journey Nepal.';
            $description = $cleanMetaText($description . $contextSuffix);
        }

        return $truncateMetaText($description, 154);
    };

    $rawMetaTitle = trim($__env->yieldContent('meta_title'));
    $rawFallbackTitle = trim($__env->yieldContent('title'));
    $rawMetaDescription = trim($__env->yieldContent('meta_description'));

    $hasExplicitMetaTitle = $rawMetaTitle !== '' || $rawFallbackTitle !== '';
    $hasExplicitMetaDescription = $rawMetaDescription !== '';

    $pageMetaTitle = $cleanMetaText($rawMetaTitle !== '' ? $rawMetaTitle : $rawFallbackTitle);
    $pageMetaDescription = $cleanMetaText($rawMetaDescription);

    if ($pageMetaTitle === '') {
        if ($routeName === 'study-abroad.details' && isset($study)) {
            $pageMetaTitle = $cleanMetaText(($study->title ?? 'Study Abroad Details') . ' | ' . $defaultSiteTitle);
            $pageMetaDescription = $pageMetaDescription !== '' ? $pageMetaDescription : $limitMetaText($study->short_description ?? '', 154);
        } elseif ($routeName === 'test-preparation.details' && isset($testpreparation)) {
            $pageMetaTitle = $cleanMetaText(($testpreparation->title ?? 'Test Preparation Details') . ' | ' . $defaultSiteTitle);
            $pageMetaDescription = $pageMetaDescription !== '' ? $pageMetaDescription : $limitMetaText($testpreparation->short_description ?? '', 154);
        } elseif ($routeName === 'blog.details' && isset($blog)) {
            $pageMetaTitle = $cleanMetaText(($blog->title ?? 'Blog Details') . ' | ' . $defaultSiteTitle);
            $pageMetaDescription = $pageMetaDescription !== '' ? $pageMetaDescription : $limitMetaText($blog->short_description ?? '', 154);
        } elseif ($routeName === 'interview-preparation.details' && isset($interviewPreparation)) {
            $pageMetaTitle = $cleanMetaText(($interviewPreparation->title ?? 'Interview Preparation Details') . ' | ' . $defaultSiteTitle);
            $pageMetaDescription = $pageMetaDescription !== '' ? $pageMetaDescription : $limitMetaText($interviewPreparation->description ?? '', 154);
        } else {
            $routeTitleMap = [
                'home' => 'Home',
                'about-us' => 'About Us',
                'contact-us' => 'Contact Us',
                'enquiry-us' => 'Enquiry',
                'enrollNow' => 'Enroll Now',
                'blogs' => 'Blogs',
                'blog.profile' => 'Author Profile',
                'study-abroad' => 'Study Abroad',
                'frontend.study_abroad.document_checklist' => 'Document Checklist',
                'frontend.study_abroad.college_and_university' => 'Colleges and Universities',
                'frontend.study_abroad.why_country' => 'Why This Country',
                'frontend.study_abroad.country_guide' => 'Country Guide',
                'test-preparation' => 'Test Preparation',
                'interview-preparation' => 'Interview Preparation',
                'galleries.index' => 'Gallery',
                'gallery.details' => 'Gallery Details',
                'terms-and-conditions' => 'Terms and Conditions',
                'privacy-policy' => 'Privacy Policy',
            ];

            $routeDescriptionMap = [
                'home' => 'Trusted guidance for study abroad, test preparation, interviews, and admissions support with Global Journey.',
                'about-us' => 'Learn about Global Journey, our counseling approach, and how we support students in every step of their abroad journey.',
                'contact-us' => 'Contact Global Journey for counseling, admissions guidance, visa documentation support, and appointment booking.',
                'enquiry-us' => 'Send your study abroad enquiry and get personalized guidance based on your destination, budget, and timeline.',
                'enrollNow' => 'Start your enrollment with Global Journey and receive step-by-step support for documents, tests, and admissions.',
                'blogs' => 'Read the latest Global Journey insights on study destinations, admission tips, visa guidance, and student success strategies.',
                'blog.profile' => 'Explore expert articles and destination insights shared by this Global Journey author.',
                'study-abroad' => 'Explore study abroad destinations, admission pathways, visa support, and planning resources from Global Journey.',
                'frontend.study_abroad.document_checklist' => 'Review the required checklist for academic, identity, and financial documents for this country.',
                'frontend.study_abroad.college_and_university' => 'Find suitable colleges and universities with program details and admission requirements.',
                'frontend.study_abroad.why_country' => 'Understand why this country is a strong choice for education, lifestyle, and future opportunities.',
                'frontend.study_abroad.country_guide' => 'Get a complete country guide with application process, visa steps, and student living insights.',
                'test-preparation' => 'Find expert-led test preparation resources, score strategies, and class options for your study abroad goals.',
                'interview-preparation' => 'Get interview preparation guidance with common questions, visa conditions, and confidence-building strategies.',
                'galleries.index' => 'Browse Global Journey events, activities, and student success moments in our gallery.',
                'gallery.details' => 'View detailed photos and highlights from specific Global Journey events and student activities.',
                'terms-and-conditions' => 'Read the terms and conditions governing Global Journey counseling and service usage.',
                'privacy-policy' => 'Read the privacy policy on how Global Journey handles personal information and user data securely.',
            ];

            $resolvedRouteTitle = $routeTitleMap[$routeName] ?? null;

            if (!$resolvedRouteTitle && request()->path() === '/') {
                $resolvedRouteTitle = 'Home';
            }

            if (!$resolvedRouteTitle && $routeName !== '') {
                $resolvedRouteTitle = \Illuminate\Support\Str::title(str_replace(['.', '-'], ' ', $routeName));
            }

            $pageMetaTitle = $resolvedRouteTitle ? $cleanMetaText($resolvedRouteTitle . ' | ' . $defaultSiteTitle) : $cleanMetaText($defaultSiteTitle);

            if ($pageMetaDescription === '') {
                $pageMetaDescription = $limitMetaText($routeDescriptionMap[$routeName] ?? '', 154);
            }
        }
    }

    $defaultMetaDescription =
        $cleanMetaText($setting->meta_description ?? '') ?: $cleanMetaText($setting->description ?? '');

    if ($routeName === 'home' && $hasExplicitMetaTitle) {
        // Keep exact home meta title from the page without auto suffixes.
        $pageMetaTitle = $cleanMetaText($pageMetaTitle);
    } else {
        $pageMetaTitle = $normalizeMetaTitle($pageMetaTitle, $defaultSiteTitle, $routeName);
    }

    if ($routeName === 'home' && $hasExplicitMetaDescription) {
        // Keep exact home meta description from the page without suffix/trim logic.
        $resolvedMetaDescription = $cleanMetaText($pageMetaDescription);
    } else {
        $resolvedMetaDescription = $normalizeMetaDescription(
            $pageMetaDescription,
            $defaultMetaDescription,
            $routeName,
        );
    }

    $canonicalUrl = trim($__env->yieldContent('canonical_url')) ?: url()->current();
@endphp

<title>{{ $pageMetaTitle !== '' ? $pageMetaTitle : $defaultSiteTitle }}</title>
@if ($resolvedMetaDescription !== '')
    <meta name="description" content="{{ $resolvedMetaDescription }}">
@endif
<link rel="canonical" href="{{ $canonicalUrl }}">

@if (is_object($setting) && isset($setting['favicon']))
    <link rel="icon" href="{{ asset('uploaded-images/site-setting-images/' . $setting->favicon) }}" />
@else
    <link rel="icon" href="{{ asset('frontend/assets/img/global-icon-only.png') }}">
@endif

<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery.fancybox.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/swiper.css') }}">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/color.css') }}">

<style>
    :root {
        --gj-ink-900: #081a42;
        --gj-ink-800: #0f2454;
        --gj-ink-700: #203a6b;
        --gj-muted-700: #4b5f82;
        --gj-muted-500: #7f91b2;
        --gj-line: rgba(110, 146, 206, 0.18);
        --gj-line-strong: rgba(110, 146, 206, 0.28);
        --gj-surface: #ffffff;
        --gj-surface-soft: linear-gradient(180deg, #f6f9ff 0%, #eef4ff 100%);
        --gj-surface-blue: linear-gradient(180deg, #edf4ff 0%, #f8fbff 100%);
        --gj-brand: #1d4ed8;
        --gj-brand-strong: #0c3fbb;
        --gj-brand-soft: rgba(96, 165, 250, 0.18);
        --gj-hero-overlay: linear-gradient(115deg, rgba(4, 16, 46, 0.88) 0%, rgba(10, 36, 96, 0.74) 42%, rgba(5, 18, 55, 0.86) 100%);
        --gj-shadow-lg: 0 30px 70px rgba(8, 29, 71, 0.14);
        --gj-shadow-md: 0 20px 44px rgba(7, 34, 80, 0.1);
        --gj-radius-xl: 28px;
        --gj-radius-lg: 22px;
    }

    .splash-area-section,
    .splash-area-section * {
        font-family: "Poppins", sans-serif !important;
    }

    .splash-area-section {
        position: relative;
        background-size: cover;
        background-position: center;
        min-height: 520px;
        display: flex;
        align-items: center;
        padding: 96px 0 114px;
        overflow: hidden;
        isolation: isolate;
    }

    .splash-area-section::before {
        content: "";
        position: absolute;
        inset: 0;
        background: var(--gj-hero-overlay);
        z-index: 0;
    }

    .splash-area-section::after {
        content: "";
        position: absolute;
        inset: auto auto -120px -90px;
        width: 340px;
        height: 340px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(96, 165, 250, 0.22) 0%, transparent 70%);
        z-index: 0;
        pointer-events: none;
    }

    .splash-area-section .container {
        position: relative;
        z-index: 1;
    }

    .splash-area-section .splash-area {
        position: relative;
        max-width: 760px;
        padding-left: 40px;
        display: flex !important;
        flex-direction: column;
        align-items: flex-start;
        gap: 18px;
    }

    .splash-area-section .page-hero__eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 9px 16px;
        border-radius: 999px;
        border: 1px solid rgba(202, 220, 255, 0.22);
        background: rgba(255, 255, 255, 0.08);
        color: #e8f1ff;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        box-shadow: 0 18px 40px rgba(5, 18, 55, 0.2);
        backdrop-filter: blur(10px);
    }

    .splash-area-section .page-hero__eyebrow i {
        color: #8fc2ff;
        font-size: 13px;
    }

    .splash-area-section .splash-title {
        font-size: clamp(40px, 5.2vw, 72px) !important;
        font-weight: 800 !important;
        line-height: 1.03 !important;
        letter-spacing: -0.04em !important;
        color: #f7fbff !important;
        text-shadow: 0 6px 18px rgba(0, 9, 30, 0.26) !important;
        margin: 0 !important;
        display: block !important;
        white-space: normal !important;
        max-width: 13ch;
        padding-left: 0 !important;
    }

    .splash-area-section .splash-title .gradient-text {
        display: inline;
    }

    .splash-area-section .gradient-text,
    .splash-area-section .splash-title.gradient-text {
        background: linear-gradient(90deg, #9ad5ff 0%, #72b5ff 42%, #d0deff 100%) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
        background-clip: text !important;
        color: transparent !important;
    }

    .splash-area-section .page-hero__subtitle {
        max-width: 62ch;
        margin: 0;
        font-size: clamp(16px, 1.8vw, 20px);
        line-height: 1.8;
        color: rgba(233, 243, 255, 0.88);
    }

    .splash-area-section .page-hero__meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin: 4px 0 0;
        padding: 0;
        list-style: none;
    }

    .splash-area-section .page-hero__meta li {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(210, 226, 255, 0.16);
        color: #f1f6ff;
        font-size: 14px;
        font-weight: 500;
    }

    .splash-area-section .page-hero__meta li i {
        color: #9bc9ff;
    }

    .splash-area-section .page-hero__actions {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 8px;
    }

    .splash-area-section .page-hero__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-width: 198px;
        padding: 13px 24px;
        border-radius: 15px;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0.01em;
        line-height: 1.2;
        border: 1px solid transparent;
        text-decoration: none;
        transition: transform 0.24s ease, box-shadow 0.24s ease, background 0.24s ease, border-color 0.24s ease, color 0.24s ease;
    }

    .splash-area-section .page-hero__btn i {
        font-size: 19px;
        transition: transform 0.24s ease;
    }

    .splash-area-section .page-hero__btn--primary {
        color: #ffffff;
        background: linear-gradient(135deg, #2156e5 0%, #1d4ed8 45%, #103cac 100%);
        border-color: rgba(180, 210, 255, 0.28);
        box-shadow: 0 14px 34px rgba(13, 50, 155, 0.34), inset 0 1px 0 rgba(255, 255, 255, 0.22);
    }

    .splash-area-section .page-hero__btn--primary:hover,
    .splash-area-section .page-hero__btn--primary:focus-visible {
        transform: translateY(-2px);
        box-shadow: 0 18px 38px rgba(13, 50, 155, 0.42), inset 0 1px 0 rgba(255, 255, 255, 0.28);
        color: #ffffff;
    }

    .splash-area-section .page-hero__btn--primary:hover i,
    .splash-area-section .page-hero__btn--primary:focus-visible i {
        transform: translateX(2px);
    }

    .splash-area-section .page-hero__btn--ghost {
        color: #eef5ff;
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.09) 0%, rgba(255, 255, 255, 0.02) 100%);
        border-color: rgba(216, 228, 255, 0.32);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.12);
    }

    .splash-area-section .page-hero__btn--ghost:hover,
    .splash-area-section .page-hero__btn--ghost:focus-visible {
        transform: translateY(-2px);
        background: linear-gradient(145deg, rgba(255, 255, 255, 0.16) 0%, rgba(255, 255, 255, 0.08) 100%);
        border-color: rgba(216, 228, 255, 0.46);
        color: #ffffff;
        box-shadow: 0 12px 26px rgba(9, 26, 72, 0.26);
    }

    .splash-area-section .page-hero__btn--ghost:hover i,
    .splash-area-section .page-hero__btn--ghost:focus-visible i {
        transform: translateX(2px);
    }

    .splash-area-section .page-hero__btn:focus-visible {
        outline: 2px solid rgba(180, 219, 255, 0.9);
        outline-offset: 2px;
    }

    .gj-page-shell {
        position: relative;
        padding: 72px 0 84px;
        background: var(--gj-surface-soft);
        overflow: hidden;
    }

    .gj-page-shell--compact {
        padding-top: 52px;
    }

    .gj-page-shell--white {
        background: linear-gradient(180deg, #ffffff 0%, #f6f9ff 100%);
    }

    .gj-page-shell--blue {
        background: var(--gj-surface-blue);
    }

    .gj-page-shell::before {
        content: "";
        position: absolute;
        inset: 0 auto auto 0;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(96, 165, 250, 0.12) 0%, transparent 72%);
        transform: translate(-28%, -35%);
        pointer-events: none;
    }

    .gj-section-header {
        max-width: 760px;
        margin: 0 auto 44px;
        text-align: center;
    }

    .gj-section-header--left {
        margin-left: 0;
        margin-right: auto;
        text-align: left;
    }

    .gj-section-header__eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
        color: var(--gj-brand);
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }

    .gj-section-header h1,
    .gj-section-header h2,
    .gj-section-header h3 {
        margin: 0;
        color: var(--gj-ink-800);
        font-size: clamp(2rem, 3.4vw, 3.45rem);
        line-height: 1.1;
        letter-spacing: -0.03em;
        font-weight: 800;
    }

    .gj-section-header p {
        margin: 14px auto 0;
        max-width: 60ch;
        color: var(--gj-muted-700);
        font-size: clamp(1rem, 1.55vw, 1.12rem);
        line-height: 1.8;
    }

    .gj-section-header--left p {
        margin-left: 0;
    }

    .gj-surface-card,
    .gj-glass-card {
        position: relative;
        border-radius: var(--gj-radius-lg);
        border: 1px solid var(--gj-line);
        background: rgba(255, 255, 255, 0.96);
        box-shadow: var(--gj-shadow-md);
    }

    .gj-glass-card {
        background: rgba(255, 255, 255, 0.74);
        backdrop-filter: blur(12px);
    }

    .gj-prose-card {
        padding: clamp(22px, 3vw, 38px);
    }

    .gj-prose-card h3,
    .gj-prose-card h4,
    .gj-prose-card strong {
        color: var(--gj-ink-800);
    }

    .gj-prose-card p,
    .gj-prose-card li {
        color: var(--gj-muted-700);
        line-height: 1.85;
    }

    .gj-grid-card {
        height: 100%;
        padding: 28px;
        border-radius: var(--gj-radius-lg);
        border: 1px solid var(--gj-line);
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, #f8fbff 100%);
        box-shadow: 0 16px 36px rgba(8, 29, 71, 0.08);
        transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
    }

    .gj-grid-card:hover {
        transform: translateY(-8px);
        border-color: var(--gj-line-strong);
        box-shadow: var(--gj-shadow-lg);
    }

    .gj-grid-card__icon {
        width: 58px;
        height: 58px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        background: linear-gradient(135deg, #0f2454 0%, #1d4ed8 100%);
        color: #ffffff;
        font-size: 22px;
        box-shadow: 0 18px 34px rgba(29, 78, 216, 0.22);
    }

    .gj-grid-card h3,
    .gj-grid-card h4,
    .gj-grid-card h5 {
        margin: 18px 0 12px;
        color: var(--gj-ink-800);
        font-weight: 800;
        line-height: 1.25;
    }

    .gj-grid-card p,
    .gj-grid-card li {
        color: var(--gj-muted-700);
        line-height: 1.75;
    }

    .gj-meta-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(29, 78, 216, 0.08);
        border: 1px solid rgba(29, 78, 216, 0.12);
        color: var(--gj-ink-700);
        font-size: 13px;
        font-weight: 600;
    }

    .gj-divider-space {
        margin-top: 42px;
    }

    .gj-contact-band {
        position: relative;
        padding: 72px 0 84px;
        background: linear-gradient(180deg, #f6f9ff 0%, #eef4ff 100%);
        overflow: hidden;
    }

    .gj-contact-band::before {
        content: "";
        position: absolute;
        width: 340px;
        height: 340px;
        right: -110px;
        top: -110px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.14) 0%, transparent 72%);
        pointer-events: none;
    }

    .gj-contact-band__header {
        max-width: 760px;
        margin-bottom: 36px;
    }

    .gj-contact-band__panel,
    .gj-contact-band__details {
        border-radius: 24px;
    }

    .gj-contact-band__panel {
        padding: clamp(24px, 3vw, 34px);
    }

    .gj-contact-band__intro {
        margin-bottom: 22px;
    }

    .gj-contact-band__intro h3 {
        margin: 16px 0 10px;
        color: var(--gj-ink-800);
        font-size: clamp(1.55rem, 2vw, 2rem);
        font-weight: 800;
        line-height: 1.2;
    }

    .gj-contact-band__intro p,
    .gj-contact-band__details-copy {
        color: var(--gj-muted-700);
        line-height: 1.75;
        margin-bottom: 0;
    }

    .gj-contact-band__details {
        padding: 28px;
    }

    .gj-contact-band__details h4 {
        margin: 18px 0 12px;
        color: var(--gj-ink-800);
        font-weight: 800;
    }

    .gj-contact-band__details h5 {
        margin: 18px 0 12px;
        color: var(--gj-ink-800);
        font-weight: 700;
    }

    .gj-contact-band__details hr {
        border-color: rgba(148, 163, 184, 0.22);
        margin: 18px 0;
    }

    .gj-contact-band .contact-list,
    .gj-contact-band .social-links {
        list-style: none;
        padding: 0;
    }

    .gj-contact-band .contact-list {
        margin: 0;
        display: grid;
        gap: 12px;
    }

    .gj-contact-band .contact-list li a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        border-radius: 16px;
        color: var(--gj-ink-700);
        text-decoration: none;
        background: rgba(255, 255, 255, 0.75);
        border: 1px solid rgba(148, 163, 184, 0.18);
        transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease, color 0.22s ease;
    }

    .gj-contact-band .contact-list li a:hover,
    .gj-contact-band .contact-list li a:focus-visible {
        color: var(--gj-brand-strong);
        transform: translateY(-2px);
        border-color: rgba(59, 130, 246, 0.28);
        box-shadow: 0 12px 24px rgba(15, 36, 96, 0.08);
    }

    .gj-contact-band .contact-list i {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        background: linear-gradient(135deg, #0f2460, #1d4ed8);
        box-shadow: 0 10px 20px rgba(29, 78, 216, 0.2);
        flex-shrink: 0;
    }

    .gj-contact-band .social-links {
        margin: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .gj-contact-band .social-links a {
        width: 44px;
        height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        color: var(--gj-ink-700);
        background: rgba(255, 255, 255, 0.76);
        border: 1px solid rgba(148, 163, 184, 0.18);
        text-decoration: none;
        transition: transform 0.22s ease, color 0.22s ease, background 0.22s ease, border-color 0.22s ease;
    }

    .gj-contact-band .social-links a:hover,
    .gj-contact-band .social-links a:focus-visible {
        transform: translateY(-2px);
        color: #ffffff;
        background: linear-gradient(135deg, #0f2460, #1d4ed8);
        border-color: transparent;
    }

    @media (max-width: 991.98px) {
        .splash-area-section {
            min-height: 430px;
            padding: 84px 0 90px;
        }

        .splash-area-section .splash-area {
            padding-left: 0;
            padding-right: 0;
            max-width: min(760px, 100%);
            gap: 14px;
        }

        .splash-area-section .splash-title {
            font-size: clamp(2.2rem, 6.6vw, 3.2rem) !important;
            max-width: 16ch;
        }

        .splash-area-section .page-hero__subtitle {
            max-width: 56ch;
            font-size: clamp(0.98rem, 1.9vw, 1.12rem);
        }

        .gj-page-shell {
            padding: 56px 0 68px;
        }

        .gj-contact-band {
            padding: 56px 0 68px;
        }

        .gj-contact-band__details,
        .gj-contact-band__panel {
            padding: 24px;
        }
    }

    @media (max-width: 767.98px) {
        .splash-area-section {
            min-height: 380px;
            padding: 74px 0 78px;
        }

        .splash-area-section .splash-area {
            gap: 12px;
        }

        .splash-area-section .splash-title {
            font-size: clamp(1.9rem, 8.2vw, 2.55rem) !important;
            max-width: 16ch;
        }

        .splash-area-section .page-hero__subtitle {
            font-size: 0.95rem;
            line-height: 1.65;
        }

        .splash-area-section .page-hero__meta,
        .splash-area-section .page-hero__actions {
            gap: 10px;
        }

        .splash-area-section .page-hero__meta li,
        .splash-area-section .page-hero__btn {
            width: auto;
            justify-content: flex-start;
        }

        .splash-area-section .page-hero__btn {
            min-width: 172px;
            padding: 12px 18px;
        }

        .gj-grid-card,
        .gj-prose-card {
            padding: 22px;
        }
    }

    .hero-section-one {
        position: relative;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .hero-section-one video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
    }

    .hero-section-one .container {
        position: relative;
        z-index: 2;
        text-align: center;
    }
</style>
