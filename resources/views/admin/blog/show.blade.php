<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Status:</b>
    <span class="badge {{ $blog->status == 1 ? 'bg-success' : 'bg-danger' }}">
        {{ $blog->status == 1 ? 'Active' : 'Inactive' }}
    </span>
</div>
<hr>
<div class="row align-items-center  ">
    <div class="card-content mt-2 d-flex gap-3">
        <article class="post-details">
            <div class="post-thumb">
                <img src="{{ $blog->image_path }}" alt="" />
            </div>
            <ul class="d-flex gap-3 mt-2">
                <span>
                    <i class="bx bxs-user"></i>
                    <span class="author vcard">{{ $blog->author->name ?? 'Admin' }}</span>
                </span>
                <span class="posted-on">
                    <i class="bx bxs-calendar"></i>
                    {{ \Carbon\Carbon::parse($blog->blog_date)->format('d F Y') }}
                </span>
            </ul>
            <h2>
                {{ $blog->title }}
            </h2>
            <p class="mb-1"><strong>Author Title:</strong> {{ $blog->author->title ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Author Email:</strong> {{ $blog->author->email ?? 'N/A' }}</p>
            <p>
                {!! $blog->description ?? '' !!}
            </p>
            @if (!empty($blog->quick_info_items))
                <div class="card-content mt-4">
                    <h5 class="mb-3">Quick Information Grid</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Title</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blog->quick_info_items as $item)
                                    <tr>
                                        <td>{{ $item['icon'] ?? '' }}</td>
                                        <td>{{ $item['title'] ?? '' }}</td>
                                        <td>{{ $item['value'] ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if (!empty($blog->key_highlights))
                <div class="card-content mt-4">
                    <h5 class="mb-3">Key Highlights</h5>
                    <ul class="mb-0">
                        @foreach ($blog->key_highlights as $highlight)
                            <li>{{ $highlight['text'] ?? '' }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (!empty($blog->cta_title) || !empty($blog->cta_description) || !empty($blog->cta_button_text) || !empty($blog->cta_button_url))
                <div class="card-content mt-4">
                    <h5 class="mb-3">CTA Block</h5>
                    @if (!empty($blog->cta_title))
                        <p class="mb-1"><strong>Title:</strong> {{ $blog->cta_title }}</p>
                    @endif
                    @if (!empty($blog->cta_description))
                        <p class="mb-1"><strong>Description:</strong> {{ $blog->cta_description }}</p>
                    @endif
                    @if (!empty($blog->cta_button_text))
                        <p class="mb-1"><strong>Button Text:</strong> {{ $blog->cta_button_text }}</p>
                    @endif
                    @if (!empty($blog->cta_button_url))
                        <p class="mb-0"><strong>Button URL:</strong> {{ $blog->cta_button_url }}</p>
                    @endif
                </div>
            @endif
            @if (!empty($blog->faqs))
                <div class="faq-section mt-4">
                    <h3>FAQs</h3>
                    @foreach ($blog->faqs as $faq)
                        <div class="faq-item mb-3">
                            <h5 class="faq-question">{{ $faq['question'] ?? '' }}</h5>
                            <p class="faq-answer">{{ $faq['answer'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </article>
    </div>
</div>
