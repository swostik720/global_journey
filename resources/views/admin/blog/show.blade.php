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
                    <span class="author vcard">{{ $blog->user->name ?? 'Admin' }}</span>
                </span>
                <span class="posted-on">
                    <i class="bx bxs-calendar"></i>
                    {{ \Carbon\Carbon::parse($blog->blog_date)->format('d F Y') }}
                </span>
            </ul>
            <h2>
                {{ $blog->title }}
            </h2>
            <p>
                {!! $blog->description ?? '' !!}
            </p>
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
