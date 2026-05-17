<script type="application/ld+json">
{
 "@context": "https://schema.org",
 "@type": "BlogPosting",
 "headline": "{{ $blog->title }}",
 "image": "{{ $blog->image_path }}",
 "url": "{{ route('blog.details', $blog->slug) }}",
 "description": "{{ html_entity_decode(strip_tags($blog->short_description), ENT_QUOTES | ENT_HTML5, 'UTF-8') }}",
 "author": {
   "@type": "Person",
   "name": "{{ $blog->author->name ?? 'Admin' }}"
 },
 "publisher": {
   "@type": "Organization",
   "name": "{{ config('app.name') }}",
   "logo": {
     "@type": "ImageObject",
     "url": "{{ asset('frontend/assets/img/logo.png') }}"
   }
 },
 "datePublished": "{{ \Carbon\Carbon::parse($blog->blog_date)->toIso8601String() }}",
 "dateModified": "{{ $blog->updated_at->toIso8601String() }}"
}
</script>

@extends('frontend.layouts.includes.master')
@section('meta_title', ($blog->title ?? 'Blog Details') . ' | ' . ($setting->name ?? config('app.name')))
@section('meta_description', html_entity_decode(strip_tags($blog->short_description ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'))
@section('maincontent')

    {{-- ════════════════════════════════════════════════════════════
         HERO SPLASH  (identical markup to study-abroad details)
    ════════════════════════════════════════════════════════════ --}}
    @php
        $parts = explode(' ', $blog->title ?? '', 3);
        $firstPart = isset($parts[0], $parts[1]) ? $parts[0] . ' ' . $parts[1] : $parts[0] ?? '';
        $secondPart = $parts[2] ?? '';

        $descriptionHtml = $blog->description ?? '';
        $headingTocItems = [];
        $usedIds = [];
        $generatedHeadingIndex = 0;

        $quickInfoItems = collect($blog->quick_info_items ?? [])
            ->map(function ($item) {
                return [
                    'icon' => trim((string) ($item['icon'] ?? 'bi bi-info-circle')),
                    'title' => trim((string) ($item['title'] ?? '')),
                    'value' => trim((string) ($item['value'] ?? '')),
                ];
            })
            ->filter(fn($i) => $i['title'] !== '' || $i['value'] !== '')
            ->values();

        $keyHighlights = collect($blog->key_highlights ?? [])
            ->map(fn($i) => trim((string) ($i['text'] ?? '')))
            ->filter()
            ->values();

        $hasCta =
            filled($blog->cta_title) ||
            filled($blog->cta_description) ||
            (filled($blog->cta_button_text) && filled($blog->cta_button_url));

        $descriptionWithAnchors = preg_replace_callback(
            '/<h([1-6])([^>]*)>(.*?)<\/h\1>/is',
            function ($matches) use (&$headingTocItems, &$usedIds, &$generatedHeadingIndex) {
                $level = (int) $matches[1];
                $attributes = $matches[2] ?? '';
                $innerHtml = $matches[3] ?? '';
                $text = trim(strip_tags($innerHtml));

                if ($text === '') {
                    return $matches[0];
                }

                $existingId = null;
                if (preg_match('/\sid=["\']([^"\']+)["\']/i', $attributes, $idMatch)) {
                    $existingId = $idMatch[1];
                }

                $baseId = $existingId ?: \Illuminate\Support\Str::slug($text);
                if ($baseId === '') {
                    $generatedHeadingIndex++;
                    $baseId = 'blog-section-' . $generatedHeadingIndex;
                }

                $id = $baseId;
                $suffix = 2;
                while (in_array($id, $usedIds, true)) {
                    $id = $baseId . '-' . $suffix++;
                }
                $usedIds[] = $id;

                if (!$existingId) {
                    $attributes .= ' id="' . $id . '"';
                }

                $headingTocItems[] = ['id' => $id, 'text' => $text, 'level' => $level];

                return '<h' . $level . $attributes . '>' . $innerHtml . '</h' . $level . '>';
            },
            $descriptionHtml,
        );

        $contentBlocks = [];
        if (
            preg_match_all(
                '/(<h[1-6][^>]*>.*?<\/h[1-6]>.*?)(?=<h[1-6][^>]*>|$)/is',
                $descriptionWithAnchors,
                $headingBlocks,
            ) &&
            !empty($headingBlocks[1])
        ) {
            $contentBlocks = array_values(array_filter(array_map('trim', $headingBlocks[1])));
        } elseif (
                        preg_match_all(
                            '/(<p\b[^>]*>.*?<\/p>|<ul\b[^>]*>.*?<\/ul>|<ol\b[^>]*>.*?<\/ol>|<table\b[^>]*>.*?<\/table>|<blockquote\b[^>]*>.*?<\/blockquote>)/is',
                            $descriptionWithAnchors,
                            $genericBlocks,
                        ) &&
                        !empty($genericBlocks[1])
                    ) {
                        $contentBlocks = array_values(array_filter(array_map('trim', $genericBlocks[1])));
                    } elseif (trim(strip_tags($descriptionWithAnchors)) !== '') {
                        $contentBlocks = [trim($descriptionWithAnchors)];
                    }

                    $articleSections = [];
                    $currentSection = null;

                    foreach ($contentBlocks as $contentBlock) {
                        $headingMeta = null;
                        if (
                            preg_match(
                                '/<h([1-6])[^>]*\sid=["\']([^"\']+)["\'][^>]*>(.*?)<\/h\1>/is',
                                $contentBlock,
                                $headingMatch,
                            )
                        ) {
                            $headingMeta = [
                                'id' => $headingMatch[2],
                                'text' => trim(strip_tags($headingMatch[3])),
                                'level' => (int) $headingMatch[1],
                            ];
                        }

                        $startsTopLevelSection = $headingMeta && $headingMeta['level'] <= 2;

                        if ($currentSection === null || $startsTopLevelSection) {
                            if ($currentSection !== null) {
                                $articleSections[] = $currentSection;
                            }
                            $currentSection = [
                                'blocks' => [$contentBlock],
                                'headings' => $headingMeta ? [$headingMeta] : [],
                            ];
                        } else {
                            $currentSection['blocks'][] = $contentBlock;
                            if ($headingMeta) {
                                $currentSection['headings'][] = $headingMeta;
                            }
                        }
                    }
                    if ($currentSection !== null) {
                        $articleSections[] = $currentSection;
                    }

                    $dynamicSections = array_values(
                        array_filter([
                            $hasCta ? 'cta' : null,
                        ]),
                    );

                    $dynamicSectionPositions = [];
                    $sectionCountBase = count($articleSections);
                    $ctaInsertPosition = min(2, max($sectionCountBase, 1));

                    if ($hasCta) {
                        $dynamicSectionPositions[$ctaInsertPosition][] = 'cta';
                    }

                    $dynamicSectionTocLabels = [
                        'quick-info' => [
                            'id' => 'quick-information-guide',
                            'text' => 'Quick Information Guide',
                            'level' => 2,
                        ],
                        'highlights' => ['id' => 'key-highlights', 'text' => 'Key Highlights', 'level' => 2],
                        'cta' => [
                            'id' => 'blog-cta',
                            'text' => filled($blog->cta_title) ? $blog->cta_title : 'Next Step',
                            'level' => 2,
                        ],
                    ];

                    $tocItems = [];

                    if ($quickInfoItems->isNotEmpty()) {
                        $tocItems[] = $dynamicSectionTocLabels['quick-info'];
                    }

                    if ($keyHighlights->isNotEmpty()) {
                        $tocItems[] = $dynamicSectionTocLabels['highlights'];
                    }

                    foreach ($articleSections as $sectionIndex => $articleSection) {
                        foreach ($articleSection['headings'] as $hm) {
                            if ($hm['level'] <= 2) {
                                $tocItems[] = $hm;
                            }
                        }
                        foreach ($dynamicSectionPositions[$sectionIndex + 1] ?? [] as $ds) {
                            $tocItems[] = $dynamicSectionTocLabels[$ds];
                        }
                    }
                    if (empty($tocItems) && $hasCta) {
                        $tocItems[] = $dynamicSectionTocLabels['cta'];
                    }
                    $tocItems = array_values($tocItems);
                @endphp

    @include('frontend.layouts.includes.page_hero', [
        'eyebrow' => 'Global Journey Blog',
        'title' => trim($firstPart) . ' ',
        'accent' => $secondPart ?: null,
        'subtitle' => \Illuminate\Support\Str::words(html_entity_decode(strip_tags($blog->short_description ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'), 24, '...'),
        'meta' => [
            optional($blog->author)->name ?: 'Global Journey Team',
            optional($blog->category)->name ?: 'General',
            \Carbon\Carbon::parse($blog->blog_date)->format('M d, Y'),
        ],
    ])

    {{-- ════════════════════════════════════════════════════════════
         MAIN CONTENT  (2-col identical to study-abroad: TOC | Article)
    ════════════════════════════════════════════════════════════ --}}
    <section data-aos="fade-up" class="sa-main mt-10">
        <div class="container">
            <div class="sa-layout {{ empty($tocItems) ? 'sa-layout--no-toc' : '' }}">

                {{-- ── TOC (identical sa-toc markup to study-abroad) ── --}}
                @if (!empty($tocItems))
                    <aside class="sa-toc-col">
                        <div class="sa-toc" id="saToc">
                            <div class="sa-toc__head">
                                <div class="sa-toc__icon">
                                    <i class="bi bi-journal-bookmark-fill"></i>
                                </div>
                                <div>
                                    <div class="sa-toc__title">Contents</div>
                                    <div class="sa-toc__sub">Jump to section</div>
                                </div>
                            </div>
                            <ul class="sa-toc__list">
                                @foreach ($tocItems as $i => $tocItem)
                                    <li class="sa-toc__item sa-toc__item--l{{ $tocItem['level'] }}">
                                        <a href="#{{ $tocItem['id'] }}" class="sa-toc__link"
                                            data-toc-id="{{ $tocItem['id'] }}">
                                            <span class="sa-toc__dot sa-toc__dot--{{ ($i % 3) + 1 }}"></span>
                                            <span class="sa-toc__text">{{ $tocItem['text'] }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                @endif

                {{-- ── Article (sa-article with blog-specific elements) ── --}}
                <article class="sa-article">

                    {{-- Meta chips: author · date · categories --}}
                    <div data-aos="zoom-in-up" data-aos-delay="140" class="sa-meta">
                        @if ($blog->author)
                            <a href="{{ route('blog.profile', $blog->author->profile_slug) }}"
                                class="sa-chip sa-chip--author">
                                <span class="sa-chip__avatar">
                                    {{ strtoupper(substr($blog->author->name ?? 'A', 0, 1)) }}
                                </span>
                                <span class="sa-chip__name-link">
                                    {{ $blog->author->name }}
                                </span>
                            </a>
                        @else
                            <span class="sa-chip sa-chip--author">
                                <span class="sa-chip__avatar">A</span>
                                <span>Admin</span>
                            </span>
                        @endif
                        <span class="sa-chip">
                            <i class="bi bi-calendar3"></i>
                            {{ \Carbon\Carbon::parse($blog->blog_date)->format('M d, Y') }}
                        </span>
                        @foreach ($categories as $category)
                            <span class="sa-chip sa-chip--cat">
                                <i class="bi bi-tag-fill"></i>
                                {{ $category->name ?? '' }}
                            </span>
                        @endforeach
                    </div>

                    {{-- Reading progress bar --}}
                    <div class="bds-progress-wrap">
                        <div class="bds-progress-fill" id="bdsProgress"></div>
                    </div>

                    {{-- Audio player (same dark-blue sa-voice gradient as study-abroad) --}}
                    <div class="sa-voice" id="bdsVoicePlayer">
                        <div class="sa-voice__title">Listen to Article <span>Audio</span></div>
                        <div class="sa-voice__controls">
                            <button type="button" class="sa-voice__play" id="bdsVoicePlay" aria-label="Play audio">
                                <i class="bi bi-play-fill" id="bdsVoicePlayIcon"></i>
                            </button>
                            <div class="sa-voice__time" id="bdsVoiceTime">0:00</div>
                            <input type="range" id="bdsVoiceProgress" class="sa-voice__progress" min="0"
                                max="100" value="0">
                            <select id="bdsVoiceRate" class="sa-voice__rate" aria-label="Speech speed">
                                <option value="0.5">0.5x</option>
                                <option value="0.75">0.75x</option>
                                <option value="1" selected>1x</option>
                                <option value="1.25">1.25x</option>
                                <option value="1.5">1.5x</option>
                            </select>
                            <i class="bi bi-volume-up-fill sa-voice__vol-icon"></i>
                            <input type="range" id="bdsVoiceVolume" class="sa-voice__volume" min="0" max="1"
                                step="0.1" value="1">
                            <div class="sa-voice__total" id="bdsVoiceTotal">0:00</div>
                        </div>
                    </div>

                    {{-- Featured image --}}
                    @if ($blog->image_path)
                        <div class="sa-heroimg">
                            <img src="{{ $blog->image_path }}" alt="{{ $blog->title }}" loading="eager">
                        </div>
                    @endif

                    @if ($quickInfoItems->isNotEmpty())
                        <section class="sa-mid-section sa-quickinfo" id="quick-information-guide">
                            <h2 class="sa-mid-section__title">Quick Information Guide</h2>
                            <div class="sa-quickinfo__grid">
                                @foreach ($quickInfoItems as $item)
                                    <div class="sa-quickinfo__card">
                                        <div class="sa-quickinfo__icon">
                                            <i class="{{ $item['icon'] ?: 'bi bi-info-circle' }}"></i>
                                        </div>
                                        <div class="sa-quickinfo__content">
                                            <h3>{{ $item['title'] }}</h3>
                                            <p>{{ $item['value'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    @if ($keyHighlights->isNotEmpty())
                        <section class="sa-mid-section sa-highlights" id="key-highlights">
                            <h2 class="sa-mid-section__title">Key Highlights</h2>
                            <ul class="sa-highlights__list">
                                @foreach ($keyHighlights as $highlight)
                                    <li>
                                        <span class="sa-highlights__icon"><i class="bi bi-check2-circle"></i></span>
                                        <span>{{ $highlight }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endif

                    {{-- Article prose with dynamic sections --}}
                    <div class="sa-prose" id="bdsArticleProse">
                        @forelse ($articleSections as $sectionIndex => $articleSection)
                            {!! implode("\n", $articleSection['blocks']) !!}

                            @foreach ($dynamicSectionPositions[$sectionIndex + 1] ?? [] as $dynamicSection)
                                @if ($dynamicSection === 'cta')
                                    <section class="sa-mid-section bds-cta" id="blog-cta">
                                        <div class="bds-cta__tag">Expert Guidance</div>
                                        @if (filled($blog->cta_title))
                                            <h2 class="bds-cta__title">{{ $blog->cta_title }}</h2>
                                        @endif
                                        @if (filled($blog->cta_description))
                                            <p class="bds-cta__body">{{ $blog->cta_description }}</p>
                                        @endif
                                        <div class="bds-cta__actions">
                                            @if (filled($blog->cta_button_text) && filled($blog->cta_button_url))
                                                <a href="{{ $blog->cta_button_url }}" target="_blank"
                                                    rel="noopener noreferrer" class="bds-cta__btn bds-cta__btn--primary">
                                                    {{ $blog->cta_button_text }} <i
                                                        class="bi bi-arrow-up-right-circle ms-1"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </section>
                                @endif
                            @endforeach
                        @empty
                            @foreach ($dynamicSections as $dynamicSection)
                                @if ($dynamicSection === 'cta')
                                    <section class="sa-mid-section bds-cta" id="blog-cta">
                                        <div class="bds-cta__tag">Expert Guidance</div>
                                        @if (filled($blog->cta_title))
                                            <h2 class="bds-cta__title">{{ $blog->cta_title }}</h2>
                                        @endif
                                        @if (filled($blog->cta_description))
                                            <p class="bds-cta__body">{{ $blog->cta_description }}</p>
                                        @endif
                                        <div class="bds-cta__actions">
                                            @if (filled($blog->cta_button_text) && filled($blog->cta_button_url))
                                                <a href="{{ $blog->cta_button_url }}" target="_blank"
                                                    rel="noopener noreferrer" class="bds-cta__btn bds-cta__btn--primary">
                                                    {{ $blog->cta_button_text }} <i
                                                        class="bi bi-arrow-up-right-circle ms-1"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </section>
                                @endif
                            @endforeach
                        @endforelse
                    </div>

                    {{-- Stats strip: read-time · share · print --}}
                    <div class="bds-stats">
                        <div class="bds-stats__cell">
                            <div class="bds-stats__num" id="bdsOpenCount">
                                {{ number_format((int) ($blog->open_count ?? 0)) }}</div>
                            <div class="bds-stats__lbl">Views</div>
                        </div>
                        <button type="button" class="bds-stats__cell bds-stats__cell--btn" id="bdsShareBtn"
                            title="Share this article">
                            <i class="bi bi-share bds-stats__icon"></i>
                            <div class="bds-stats__lbl">Share</div>
                        </button>
                        <button type="button" class="bds-stats__cell bds-stats__cell--btn" onclick="bdsPrintArticle()"
                            title="Print this article">
                            <i class="bi bi-printer bds-stats__icon"></i>
                            <div class="bds-stats__lbl">Print</div>
                        </button>
                    </div>

                    {{-- Prev / Next navigation --}}
                    <div class="bds-nav">
                        @if ($previousBlog)
                            <a href="{{ route('blog.details', $previousBlog->slug) }}"
                                class="bds-nav__btn bds-nav__btn--prev">
                                <i class="bi bi-arrow-left-circle-fill"></i>
                                <div>
                                    <span class="bds-nav__label">Previous</span>
                                    <span
                                        class="bds-nav__title">{{ \Illuminate\Support\Str::limit($previousBlog->title, 34) }}</span>
                                </div>
                            </a>
                        @else
                            <div></div>
                        @endif
                        @if ($nextBlog)
                            <a href="{{ route('blog.details', $nextBlog->slug) }}"
                                class="bds-nav__btn bds-nav__btn--next">
                                <div>
                                    <span class="bds-nav__label">Next</span>
                                    <span
                                        class="bds-nav__title">{{ \Illuminate\Support\Str::limit($nextBlog->title, 34) }}</span>
                                </div>
                                <i class="bi bi-arrow-right-circle-fill"></i>
                            </a>
                        @endif
                    </div>

                    <div class="bds-back">
                        <a href="{{ route('blogs') }}" class="themebtu">
                            <i class="bi bi-arrow-left"></i> Back to Blog
                        </a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    @if (!empty($blog->faqs))
        <section data-aos="fade-up" class="sa-faq-section">
            <div class="container">
                <div data-aos="zoom-in-up" data-aos-delay="140" class="sa-faq-wrap">
                    <div data-aos="fade-up" data-aos-delay="100" class="heading mb-4 text-center text-md-start">
                        <h6 class="text-primary">Common Questions</h6>
                        <h2 class="fw-bold">Blog FAQs</h2>
                        <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}"
                            class="img-fluid mt-2">
                    </div>
                    <div class="accordion sa-faq" id="blogFaqAccordion">
                        @foreach ($blog->faqs as $index => $faq)
                            <div data-aos="zoom-in-up" data-aos-delay="140" class="accordion-item sa-faq__item">
                                <h2 class="accordion-header" id="blogFaqHead{{ $index }}">
                                    <button class="accordion-button collapsed sa-faq__btn" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#blogFaqBody{{ $index }}"
                                        aria-expanded="false" aria-controls="blogFaqBody{{ $index }}">
                                        {{ $faq['question'] ?? 'Question' }}
                                    </button>
                                </h2>
                                <div id="blogFaqBody{{ $index }}" class="accordion-collapse collapse"
                                    aria-labelledby="blogFaqHead{{ $index }}" data-bs-parent="#blogFaqAccordion">
                                    <div class="accordion-body sa-faq__body">
                                        {!! $faq['answer'] ?? '' !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @include('frontend.layouts.includes.faq_schema', ['faqs' => $blog->faqs ?? []])



    {{-- ════════════════════════════════════════════════════════════
         RELATED POSTS
    ════════════════════════════════════════════════════════════ --}}
    @if ($relatedPosts->isNotEmpty())
        <section data-aos="fade-up" class="bds-related">
            <div class="container">
                <div data-aos="fade-up" data-aos-delay="100" class="heading mb-4">
                    <h6>Related Posts</h6>
                    <h2>You Might Also Like</h2>
                    <img alt="line" src="{{ asset('frontend/assets/img/headingline.png') }}">
                </div>
                <div class="row g-4">
                    @foreach ($relatedPosts as $relatedPost)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('blog.details', $relatedPost->slug) }}"
                                class="blog-card-link d-block h-100" aria-label="Read blog: {{ $relatedPost->title }}">
                                <div data-aos="zoom-in-up" data-aos-delay="140"
                                    class="card blog-card h-100 border-0 shadow-sm rounded-4 overflow-hidden d-flex flex-column">
                                    @if ($relatedPost->image_path)
                                        <img src="{{ $relatedPost->image_path }}" class="card-img-top"
                                            alt="{{ $relatedPost->title }}" loading="lazy">
                                    @endif
                                    <div data-aos="zoom-in-up" data-aos-delay="140" class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-bold">{{ $relatedPost->title ?? '' }}</h5>
                                        <p class="card-text text-muted">
                                            {{ \Illuminate\Support\Str::words(html_entity_decode(strip_tags($relatedPost->short_description), ENT_QUOTES | ENT_HTML5, 'UTF-8'), 25, '...') }}
                                        </p>
                                        <div class="mb-2">
                                            <span class="badge rounded-pill bg-light text-dark border">
                                                {{ $relatedPost->category->name ?? 'General' }}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between text-muted small mb-2">
                                            <div>
                                                <i class="bi bi-calendar-event me-1"></i>
                                                {{ \Carbon\Carbon::parse($relatedPost->blog_date)->format('M d, Y') }}
                                            </div>
                                            <div>
                                                <i class="bi bi-person-circle me-1"></i>
                                                <strong>{{ $relatedPost->author->name ?? 'Admin' }}</strong>
                                            </div>
                                        </div>
                                        <span class="themebtu mt-auto">Read More</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ════════════════════════════════════════════════════════════
         CONTACT SECTION
    ════════════════════════════════════════════════════════════ --}}
    @include('frontend.layouts.includes.contact_band', [
        'eyebrow' => 'Start Your Project With Us',
        'title' => "Let's Plan Your Next Move",
        'subtitle' => 'Get tailored guidance on study destinations, applications, documentation, and the next best step for your journey.',
    ])
    {{-- ════════════════════════════════════════════════════════════
         EXTRA CTAs
    ════════════════════════════════════════════════════════════ --}}
    @include('frontend.layouts.take_next_step')

    {{-- ════════════════════════════════════════════════════════════
         STAY UPDATED
    ════════════════════════════════════════════════════════════ --}}
    @include('frontend.layouts.stay_updated')

    {{-- ════════════════════════════════════════════════════════════
         STYLES
    ════════════════════════════════════════════════════════════ --}}
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        /* ── Font scope ─────────────────────────────────────────── */
        .splash-area-section *,
        .sa-main *,
        .sa-faq-section *,
        .sa-contact-section *,
        .bds-related * {
            font-family: "Poppins", sans-serif !important;
        }

        /* ── Hero (identical to study-abroad splash) ────────────── */
        .splash-title {
            font-size: 70px;
            line-height: 1.1;
            margin: 0;
            padding-left: 50px;
            white-space: nowrap;
        }

        .gradient-text {
            background: linear-gradient(90deg, #0026cc, #001a80, #000d40);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .splash-area-section .container {
            max-width: 100%;
            padding: 0 15px;
        }

        /* ── Main section ────────────────────────────────────────── */
        .sa-main {
            padding: 52px 0 36px;
            background: #f4f7fb;
        }

        /* ── 2-column layout ─────────────────────────────────────── */
        .sa-layout {
            display: grid;
            grid-template-columns: 340px 1fr;
            gap: 32px;
            align-items: start;
        }

        .sa-layout--no-toc {
            grid-template-columns: minmax(0, 1fr);
        }

        /* ── TOC column ──────────────────────────────────────────── */
        .sa-toc-col {
            position: sticky;
            top: 120px;
            width: 100%;
            z-index: 10;
        }

        .sa-toc {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(15, 36, 96, 0.08);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(15, 36, 96, 0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .sa-toc:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(15, 36, 96, 0.12);
        }

        .sa-toc__head {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            background: linear-gradient(135deg, #0f2460 0%, #1d4ed8 100%);
            border-bottom: 1px solid rgba(29, 78, 216, 0.2);
        }

        .sa-toc__icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 15px;
            flex-shrink: 0;
        }

        .sa-toc__title {
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }

        .sa-toc__sub {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 2px;
        }

        .sa-toc__list {
            list-style: none;
            margin: 0;
            padding: 10px 0;
        }

        .sa-toc__item {
            margin: 0;
        }

        .sa-toc__link {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 500;
            color: #475569;
            text-decoration: none;
            border-left: 3px solid transparent;
            transition: all 0.15s ease;
            line-height: 1.35;
        }

        .sa-toc__link:hover,
        .sa-toc__link.is-active {
            color: #0f2460;
            border-left-color: #1d4ed8;
            background: rgba(29, 78, 216, 0.08);
        }

        .sa-toc__dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 4px;
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 0 2px rgba(29, 78, 216, 0.18);
        }

        .sa-toc__dot--1 {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        }

        .sa-toc__dot--2 {
            background: linear-gradient(135deg, #2563eb, #1e40af);
        }

        .sa-toc__dot--3 {
            background: linear-gradient(135deg, #1d4ed8, #0f2460);
        }

        .sa-toc__link.is-active .sa-toc__dot {
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.25), 0 0 10px rgba(29, 78, 216, 0.22);
        }

        .sa-toc__text {
            display: block;
        }

        .sa-toc__item--l3,
        .sa-toc__item--l4,
        .sa-toc__item--l5,
        .sa-toc__item--l6 {
            display: none;
        }

        /* ── Article card ────────────────────────────────────────── */
        .sa-article {
            background: #fff;
            border: 1px solid #e4ebf7;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(15, 41, 95, 0.08);
            padding: 28px 30px;
        }

        /* ── Meta chips ──────────────────────────────────────────── */
        .sa-meta {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 16px;
            align-items: center;
        }

        .sa-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: #1e3a8a;
            background: #f2f7ff;
            border: 1px solid #d6e5ff;
            padding: 5px 11px;
            border-radius: 20px;
            font-weight: 500;
        }

        .sa-chip--cat {
            color: #1e40af;
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        .sa-chip--author {
            background: linear-gradient(135deg, #0f2460, #1d4ed8);
            border-color: transparent;
            color: #fff;
            gap: 8px;
        }

        .sa-chip__avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .sa-chip__name-link {
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            transition: opacity 0.18s;
        }

        .sa-chip__name-link:hover {
            opacity: 0.85;
        }

        /* ── Reading progress bar ────────────────────────────────── */
        .bds-progress-wrap {
            height: 3px;
            background: #eef2ff;
            margin: 0 -30px 0;
        }

        .bds-progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #0f2460, #1d4ed8);
            width: 0%;
            transition: width 0.15s linear;
        }

        /* ── Audio player (same sa-voice dark-blue gradient) ─────── */
        .sa-voice {
            border-radius: 12px;
            padding: 14px 16px;
            background: linear-gradient(110deg, #12306f 0%, #1d4ed8 100%);
            margin-bottom: 18px;
            color: #fff;
            margin-top: 18px;
        }

        .sa-voice__title {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .sa-voice__title span {
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            margin-left: 6px;
        }

        .sa-voice__controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sa-voice__play {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: none;
            background: #4f8dff;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
            cursor: pointer;
        }

        .sa-voice__time,
        .sa-voice__total {
            font-size: 12px;
            min-width: 36px;
            color: #fff;
            font-weight: 500;
        }

        .sa-voice__progress,
        .sa-voice__volume {
            -webkit-appearance: none;
            appearance: none;
            height: 4px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 999px;
            outline: none;
        }

        .sa-voice__progress {
            flex: 1;
        }

        .sa-voice__volume {
            width: 90px;
        }

        .sa-voice__progress::-webkit-slider-thumb,
        .sa-voice__volume::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #ff3b30;
            cursor: pointer;
        }

        .sa-voice__rate {
            border: none;
            border-radius: 8px;
            padding: 6px 8px;
            background: rgba(255, 255, 255, 0.24);
            color: #fff;
            font-weight: 600;
            font-size: 13px;
            min-width: 70px;
        }

        .sa-voice__rate option {
            background: #15306d;
            color: #fff;
        }

        .sa-voice__vol-icon {
            color: rgba(255, 255, 255, 0.95);
        }

        /* ── Featured image ──────────────────────────────────────── */
        .sa-heroimg img {
            width: 100%;
            height: 360px;
            object-fit: cover;
            border-radius: 14px;
            border: 1px solid #d7e3f6;
            margin-bottom: 20px;
            box-shadow: 0 10px 22px rgba(15, 41, 95, 0.1);
        }

        /* ── Prose ───────────────────────────────────────────────── */
        .sa-prose {
            font-size: 1.03rem;
            line-height: 1.95;
            color: #334155;
        }

        .sa-prose h1,
        .sa-prose h2 {
            font-size: 1.28rem;
            font-weight: 700;
            color: #0f172a;
            margin: 2.2rem 0 0.85rem;
            padding-bottom: 8px;
            border-bottom: 1px solid #f1f5f9;
            scroll-margin-top: 30px;
        }

        .sa-prose h3 {
            font-size: 1.06rem;
            font-weight: 700;
            color: #1e293b;
            margin: 1.6rem 0 0.75rem;
            scroll-margin-top: 30px;
        }

        .sa-prose h4,
        .sa-prose h5,
        .sa-prose h6 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #334155;
            margin: 1.3rem 0 0.6rem;
            scroll-margin-top: 30px;
        }

        .sa-prose p {
            margin-bottom: 1.35rem;
            text-align: left;
        }

        .sa-prose ul,
        .sa-prose ol {
            padding-left: 1.5rem !important;
            margin-bottom: 1.2rem;
            color: #374151;
            list-style-position: outside;
        }

        .sa-prose ul {
            list-style-type: disc !important;
        }

        .sa-prose ol {
            list-style-type: decimal !important;
        }

        .sa-prose li {
            margin-bottom: 0.5rem;
        }

        .sa-prose blockquote {
            background: #f8faff;
            border-left: 3px solid #3b82f6;
            border-radius: 0 10px 10px 0;
            padding: 14px 20px;
            margin: 1.8rem 0;
            font-style: italic;
            color: #475569;
            font-size: 0.98rem;
            line-height: 1.7;
        }

        .sa-prose img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 1.5rem 0;
            box-shadow: 0 6px 20px rgba(10, 30, 80, 0.1);
            border: 1px solid #e2e8f3;
        }

        .sa-prose a {
            color: #1d4ed8;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .sa-prose table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            border: 1px solid #e2eaf8;
            border-radius: 10px;
            overflow: hidden;
            font-size: 14px;
            display: block;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .sa-prose table th {
            background: #f0f6ff;
            font-weight: 700;
            color: #1e3a8a;
            padding: 10px 14px;
            text-align: left;
            border-bottom: 1px solid #dde9f8;
        }

        .sa-prose table td {
            padding: 9px 14px;
            border-bottom: 1px solid #eef2fb;
            color: #374151;
        }

        .sa-prose table tr:last-child td {
            border-bottom: none;
        }

        .sa-prose code {
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 0.88em;
            padding: 2px 7px;
            border-radius: 5px;
        }

        /* ── Dynamic mid-sections ────────────────────────────────── */
        .sa-mid-section {
            margin: 1.75rem 0 1.9rem;
            border: 1px solid #d3deef;
            border-radius: 14px;
            background: linear-gradient(180deg, #eef4ff 0%, #e8effb 100%);
            padding: 18px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .sa-mid-section__title {
            font-size: 1.08rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 14px;
        }

        /* Quick info */
        .sa-quickinfo__grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .sa-quickinfo__card {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            background: linear-gradient(180deg, #ffffff 0%, #f7faff 100%);
            border: 1px solid #dbe4f5;
            border-radius: 14px;
            padding: 16px;
            transition: all 0.2s ease;
        }

        .sa-quickinfo__card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(29, 78, 216, 0.12);
        }

        .sa-quickinfo__icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #2349b7, #4458d8);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .sa-quickinfo__content {
            min-width: 0;
        }

        .sa-quickinfo__content h3 {
            font-size: 0.84rem;
            line-height: 1.35;
            margin: 0 0 6px;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .sa-quickinfo__content p {
            margin: 0;
            color: #0f172a;
            line-height: 1.55;
            font-size: 1rem;
            font-weight: 700;
            word-break: break-word;
        }

        /* Key highlights */
        .sa-highlights__list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 10px;
        }

        .sa-highlights__list li {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            color: #1e293b;
            line-height: 1.7;
            padding: 12px 14px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid #dde6f5;
        }

        .sa-highlights__icon {
            color: #2563eb;
            font-size: 20px;
            line-height: 1;
            margin-top: 2px;
            flex-shrink: 0;
        }

        /* Inline CTA card */
        .bds-cta {
            position: relative;
            border-radius: 16px;
            padding: 22px 20px;
            background: linear-gradient(135deg, #0f2460 0%, #1d4ed8 100%);
            color: #fff;
            box-shadow: 0 12px 30px rgba(15, 36, 96, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.22);
            overflow: hidden;
            transition: transform 0.24s ease, box-shadow 0.24s ease;
        }

        .bds-cta::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(120deg, rgba(255, 255, 255, 0.22) 0%, rgba(255, 255, 255, 0.06) 38%, rgba(255, 255, 255, 0) 70%);
            pointer-events: none;
        }

        .bds-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 36px rgba(15, 36, 96, 0.33);
        }

        .bds-cta>* {
            position: relative;
            z-index: 1;
        }

        .bds-cta__tag {
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 4px 12px;
            margin-bottom: 14px;
            color: rgba(255, 255, 255, 0.9);
        }

        .bds-cta__title,
        .sa-prose .bds-cta__title {
            color: #ffffff !important;
            font-size: 1.2rem;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 10px;
            text-shadow: 0 2px 8px rgba(15, 36, 96, 0.28);
        }

        .bds-cta__body {
            font-size: 12.5px;
            line-height: 1.65;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 18px;
        }

        .bds-cta__actions {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .bds-cta__btn {
            display: block;
            text-align: center;
            border-radius: 10px;
            padding: 11px 12px;
            font-size: 12.5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.18s;
        }

        .bds-cta__btn--primary {
            background: #ffffff;
            color: #1e3a8a;
        }

        .bds-cta__btn--primary:hover {
            background: #eff6ff;
            color: #1e3a8a;
        }

        /* ── Stats strip ─────────────────────────────────────────── */
        .bds-stats {
            display: flex;
            border-top: 1px solid #f1f5f9;
            border-bottom: 1px solid #f1f5f9;
            margin: 0 -30px;
        }

        .bds-stats__cell {
            flex: 1;
            padding: 13px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            border-right: 1px solid #f1f5f9;
            background: none;
            cursor: default;
        }

        .bds-stats__cell:last-child {
            border-right: none;
        }

        .bds-stats__cell--btn {
            cursor: pointer;
            border: none;
            transition: background 0.18s;
        }

        .bds-stats__cell--btn:hover {
            background: #f0f6ff;
        }

        .bds-stats__cell--btn:hover .bds-stats__icon {
            color: #1d4ed8;
        }

        .bds-stats__num {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
        }

        .bds-stats__icon {
            font-size: 17px;
            color: #64748b;
        }

        .bds-stats__lbl {
            font-size: 11px;
            color: #94a3b8;
        }

        /* ── Prev / Next ─────────────────────────────────────────── */
        .bds-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 20px 0 10px;
        }

        .bds-nav__btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border: 1px solid #e2e8f3;
            border-radius: 11px;
            background: #f8faff;
            text-decoration: none;
            color: #374151;
            transition: all 0.2s;
            max-width: 46%;
            font-size: 13px;
        }

        .bds-nav__btn:hover {
            background: #fff;
            border-color: #93c5fd;
            color: #1e3a8a;
            box-shadow: 0 4px 14px rgba(59, 130, 246, 0.1);
            transform: translateY(-1px);
        }

        .bds-nav__btn i {
            font-size: 20px;
            color: #3b82f6;
            flex-shrink: 0;
        }

        .bds-nav__btn--next>div {
            text-align: right;
        }

        .bds-nav__label {
            display: block;
            font-size: 10.5px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .bds-nav__title {
            display: block;
            font-weight: 600;
            font-size: 12.5px;
            color: #1e293b;
            margin-top: 2px;
        }

        .bds-back {
            padding: 8px 0 4px;
        }

        /* ── FAQ section ─────────────────────────────────────────── */
        .sa-faq-section {
            padding: 8px 0 30px;
            background: #f4f7fb;
        }

        .sa-faq-wrap {
            border: 1px solid #e2e8f3;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(10, 30, 80, 0.07);
            padding: 24px;
        }

        .sa-faq__item {
            border: 1px solid #e2e8f3;
            border-radius: 12px !important;
            overflow: hidden;
            margin-bottom: 12px;
            background: #fff;
        }

        .sa-faq__item:last-child {
            margin-bottom: 0;
        }

        .sa-faq__btn {
            font-weight: 600;
            color: #1e3a8a;
            background: #fff;
            padding: 16px 18px;
            box-shadow: none !important;
        }

        .sa-faq__btn:not(.collapsed) {
            color: #1d4ed8;
            background: #eff6ff;
        }

        .sa-faq__body {
            color: #475569;
            line-height: 1.75;
            background: #f8fbff;
            padding: 16px 18px;
        }

        /* ── Enroll Now section (re-uses sa-contact-section) ─────── */
        .sa-contact-section {
            padding: 0 0 58px;
            background: #f4f7fb;
            --grad: linear-gradient(135deg, #0038A6, #0046C4, #0058E8, #003070, #001F50);
        }

        .sa-contact-wrap {
            border-radius: 16px;
            border: 1px solid #dde7f5;
            background: #f6f8fc;
            box-shadow: 0 10px 28px rgba(15, 41, 95, 0.08);
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 0.95fr);
            gap: 28px;
            padding: 26px;
        }

        .sa-contact-form-col {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .sa-contact__line {
            max-width: 80px;
            margin-top: 2px;
        }

        .sa-contact__badge {
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #1e40af;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 20px;
            padding: 4px 10px;
            margin-bottom: 10px;
        }

        .sa-contact__title {
            font-size: 2.2rem;
            margin-bottom: 10px;
            font-weight: 700;
            color: #1f2937;
        }

        .sa-contact {
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid #dbe6f6;
            padding: 22px;
        }

        .bds-contact-form-wrap .contact-form__form {
            border: none;
            border-radius: 0;
            padding: 0;
            background: transparent;
            box-shadow: none;
            width: 100%;
        }

        .bds-contact-form-wrap input,
        .bds-contact-form-wrap select,
        .bds-contact-form-wrap textarea {
            border-radius: 10px;
            border: 1px solid #d6e1f3;
            background: #ffffff;
            padding: 10px 12px;
        }

        .bds-contact-form-wrap button.themebtu,
        .bds-contact-form-wrap .themebtu {
            width: 100%;
            text-align: center;
            margin-top: 6px;
        }

        .sa-contact-section .details-card {
            background: #fff;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transition: all .3s ease;
            align-self: flex-start;
            margin-top: 96px;
        }

        .sa-contact-section .details-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }

        .sa-contact-section .details-card h4 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 16px;
            color: #1f2937;
        }

        .sa-contact-section .details-card h5 {
            font-size: 1.15rem;
            font-weight: 700;
            margin: 14px 0 10px;
            color: #1f2937;
        }

        .sa-contact-section .details-card hr {
            border-color: #e5eaf2;
            margin: 16px 0;
        }

        .sa-contact-section .contact-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sa-contact-section .contact-list li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            text-decoration: none;
            color: #333;
            font-size: 15px;
            transition: all .3s ease;
        }

        .sa-contact-section .contact-list li a:hover {
            color: #0038A6;
        }

        .sa-contact-section .contact-list i {
            width: 40px;
            height: 40px;
            background: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            transition: all .4s ease;
        }

        .sa-contact-section .contact-list li:hover i {
            background: var(--grad);
            color: #fff;
            box-shadow: 0 0 12px rgba(0, 56, 166, 0.5);
        }

        .sa-contact-section .social-links {
            list-style: none;
            display: flex;
            gap: 12px;
            padding: 0;
            margin: 12px 0 0;
        }

        .sa-contact-section .social-links li {
            list-style: none;
        }

        .sa-contact-section .social-links a {
            display: grid;
            place-content: center;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f3f3f3;
            color: #333;
            font-size: 16px;
            transition: all .5s ease;
        }

        .sa-contact-section .social-links a:hover {
            background: var(--grad);
            color: #fff;
            transform: rotate(10deg) scale(1.1);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        }

        @media print {

            .bds-progress-wrap,
            .bds-stats,
            .bds-nav,
            .bds-back,
            .sa-voice {
                display: none !important;
            }
        }

        /* ── Related posts ───────────────────────────────────────── */
        .bds-related {
            padding: 60px 0 72px;
            background: #f4f7fb;
            border-top: 1px solid #e2e8f3;
        }

        .bds-related .themebtu {
            width: 100%;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .bds-related .themebtu:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(0, 73, 255, 0.16);
        }

        .bds-related .blog-card-link {
            text-decoration: none;
            color: inherit;
        }

        .bds-related .blog-card {
            transition: transform 0.28s ease, box-shadow 0.28s ease;
        }

        .bds-related .blog-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 16px 34px rgba(10, 30, 80, 0.16);
        }

        .bds-related .card-img-top {
            transition: transform 0.4s ease;
        }

        .bds-related .blog-card:hover .card-img-top {
            transform: scale(1.05);
        }

        /* ── Scroll anchors ──────────────────────────────────────── */
        #quick-information-guide,
        #key-highlights,
        #blog-cta {
            scroll-margin-top: 30px;
        }

        /* ── Responsive ──────────────────────────────────────────── */
        @media (max-width: 1100px) {
            .sa-layout {
                grid-template-columns: 300px 1fr;
            }

            .sa-quickinfo__grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 992px) {
            .sa-layout {
                grid-template-columns: 1fr;
            }

            .sa-toc-col {
                position: static;
                order: -1;
            }

            .sa-article {
                order: 0;
            }

            .sa-contact-wrap {
                grid-template-columns: 1fr;
            }

            .sa-contact-section .details-card {
                margin-top: 0;
            }
        }

        @media (max-width: 576px) {
            .splash-title {
                font-size: 52px;
                padding-left: 10px;
                white-space: normal;
            }

            .sa-main {
                padding: 28px 0 20px;
            }

            .sa-article {
                padding: 18px;
            }

            .sa-heroimg img {
                height: 240px;
            }

            .sa-quickinfo__grid {
                grid-template-columns: 1fr;
            }

            .bds-stats {
                margin: 0 -18px;
            }

            .bds-progress-wrap {
                margin: 0 -18px 0;
            }

            .bds-nav {
                flex-direction: column;
                align-items: stretch;
            }

            .bds-nav__btn {
                max-width: 100%;
            }

            .sa-voice__controls {
                flex-wrap: wrap;
                gap: 8px;
            }

            .sa-voice__progress {
                order: 3;
                width: calc(100% - 56px);
                flex: none;
            }

            .bds-stay-updated__form {
                flex-direction: column;
            }

            .bds-stay-updated__form button {
                width: 100%;
            }
        }
    </style>

    @push('custom_js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                /* ── Reading progress bar ── */
                var progressFill = document.getElementById('bdsProgress');
                var articleEl = document.querySelector('.sa-article');
                if (progressFill && articleEl) {
                    window.addEventListener('scroll', function() {
                        var rect = articleEl.getBoundingClientRect();
                        var total = articleEl.offsetHeight - window.innerHeight;
                        if (total <= 0) {
                            progressFill.style.width = '100%';
                            return;
                        }
                        var done = Math.max(0, -rect.top);
                        progressFill.style.width = Math.min(100, (done / total) * 100) + '%';
                    }, {
                        passive: true
                    });
                }

                /* ── TOC active-link (IntersectionObserver) ── */
                var tocLinks = document.querySelectorAll('.sa-toc__link');
                if (tocLinks.length) {
                    var headings = Array.from(document.querySelectorAll(
                        '.sa-prose h1, .sa-prose h2, .sa-prose h3, #quick-information-guide, #key-highlights, #blog-cta'
                    ));

                    function updateTocActive(id) {
                        tocLinks.forEach(function(l) {
                            l.classList.remove('is-active');
                        });
                        var active = document.querySelector('.sa-toc__link[data-toc-id="' + id + '"]');
                        if (active) active.classList.add('is-active');
                    }

                    var observer = new IntersectionObserver(function(entries) {
                        entries.forEach(function(entry) {
                            if (entry.isIntersecting) updateTocActive(entry.target.id);
                        });
                    }, {
                        rootMargin: '0px 0px -60% 0px',
                        threshold: 0
                    });

                    headings.forEach(function(h) {
                        if (h.id) observer.observe(h);
                    });

                    tocLinks.forEach(function(link) {
                        link.addEventListener('click', function(e) {
                            var id = this.getAttribute('data-toc-id');
                            var target = document.getElementById(id);
                            if (target) {
                                e.preventDefault();
                                updateTocActive(id);
                                target.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }
                        });
                    });

                    if (tocLinks[0]) updateTocActive(tocLinks[0].getAttribute('data-toc-id'));
                }

                /* ── Share button ── */
                var shareBtn = document.getElementById('bdsShareBtn');
                if (shareBtn) {
                    shareBtn.addEventListener('click', function() {
                        if (navigator.share) {
                            navigator.share({
                                title: document.title,
                                url: window.location.href
                            });
                        } else {
                            navigator.clipboard.writeText(window.location.href).then(function() {
                                var lbl = shareBtn.querySelector('.bds-stats__lbl');
                                lbl.textContent = 'Copied!';
                                setTimeout(function() {
                                    lbl.textContent = 'Share';
                                }, 2000);
                            });
                        }
                    });
                }

                /* ── Print article ── */
                window.bdsPrintArticle = function() {
                    var a = document.querySelector('.sa-article');
                    if (!a) {
                        window.print();
                        return;
                    }
                    var printArticle = a.cloneNode(true);
                    printArticle.querySelectorAll('.bds-progress-wrap, .bds-stats, .bds-nav, .bds-back, .sa-voice')
                        .forEach(function(node) {
                            node.remove();
                        });
                    var pw = window.open('', '_blank', 'width=900,height=700');
                    var styles = Array.from(document.querySelectorAll('link[rel="stylesheet"], style'))
                        .map(function(el) {
                            return el.outerHTML;
                        }).join('\n');
                    pw.document.write(
                        '<!DOCTYPE html><html><head><title>' + document.title + '</title>' +
                        styles + '</head><body style="padding:30px;font-family:Poppins,sans-serif">' +
                        printArticle.outerHTML + '</body></html>'
                    );
                    pw.document.close();
                    pw.focus();
                    pw.onload = function() {
                        pw.print();
                        pw.close();
                    };
                };

                /* ── Voice player (identical logic to study-abroad) ── */
                initVoicePlayer('bdsVoice', '#bdsArticleProse');

                function initVoicePlayer(prefix, textSelector) {
                    var synth = window.speechSynthesis;
                    if (!synth) return;

                    var textEl = document.querySelector(textSelector);
                    var playBtn = document.getElementById(prefix + 'Play');
                    var playIcon = document.getElementById(prefix + 'PlayIcon');
                    var progress = document.getElementById(prefix + 'Progress');
                    var timeEl = document.getElementById(prefix + 'Time');
                    var totalEl = document.getElementById(prefix + 'Total');
                    var rateEl = document.getElementById(prefix + 'Rate');
                    var volumeEl = document.getElementById(prefix + 'Volume');

                    if (!textEl || !playBtn || !playIcon || !progress || !timeEl || !totalEl || !rateEl || !volumeEl)
                        return;

                    var text = (textEl.innerText || '').trim();
                    if (!text) return;

                    var utterance = null;
                    var isPaused = false;
                    var currentCharIndex = 0;
                    var isRestarting = false;
                    var totalSeconds = Math.max(30, Math.ceil(text.split(/\s+/).length / 160 * 60));
                    totalEl.textContent = formatTime(totalSeconds);

                    function speakFrom(charIndex) {
                        synth.cancel();
                        utterance = new SpeechSynthesisUtterance(text.slice(charIndex));
                        utterance.rate = parseFloat(rateEl.value || '1');
                        utterance.volume = parseFloat(volumeEl.value || '1');

                        utterance.onstart = function() {
                            playIcon.className = 'bi bi-pause-fill';
                            isPaused = false;
                        };
                        utterance.onboundary = function(event) {
                            if (!event || typeof event.charIndex !== 'number') return;
                            currentCharIndex = Math.min(text.length, charIndex + event.charIndex);
                            var pct = Math.min(100, (currentCharIndex / text.length) * 100);
                            progress.value = pct;
                            timeEl.textContent = formatTime(Math.floor((pct / 100) * totalSeconds));
                        };
                        utterance.onend = function() {
                            if (isRestarting) return;
                            playIcon.className = 'bi bi-play-fill';
                            progress.value = 100;
                            timeEl.textContent = totalEl.textContent;
                            isPaused = false;
                            currentCharIndex = text.length;
                        };
                        utterance.onerror = function() {
                            if (isRestarting) return;
                            playIcon.className = 'bi bi-play-fill';
                            isPaused = false;
                        };
                        synth.speak(utterance);
                    }

                    function restartFromCurrentPosition() {
                        if ((!synth.speaking && !isPaused) || currentCharIndex >= text.length) return;
                        isRestarting = true;
                        var resumeIndex = currentCharIndex;
                        synth.cancel();
                        window.setTimeout(function() {
                            isRestarting = false;
                            speakFrom(resumeIndex);
                        }, 40);
                    }

                    playBtn.addEventListener('click', function() {
                        if (synth.speaking && !isPaused) {
                            synth.pause();
                            isPaused = true;
                            playIcon.className = 'bi bi-play-fill';
                            return;
                        }
                        if (synth.speaking && isPaused) {
                            synth.resume();
                            isPaused = false;
                            playIcon.className = 'bi bi-pause-fill';
                            return;
                        }
                        if (currentCharIndex >= text.length) currentCharIndex = 0;
                        progress.value = 0;
                        timeEl.textContent = formatTime(Math.floor((currentCharIndex / text.length) *
                            totalSeconds));
                        speakFrom(currentCharIndex);
                    });

                    rateEl.addEventListener('change', restartFromCurrentPosition);
                    volumeEl.addEventListener('input', restartFromCurrentPosition);

                    function formatTime(seconds) {
                        return Math.floor(seconds / 60) + ':' + String(seconds % 60).padStart(2, '0');
                    }
                }
            });
        </script>
    @endpush
@endsection
