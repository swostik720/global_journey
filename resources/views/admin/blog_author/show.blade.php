<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Status:</b>
    <span class="badge {{ $author->status == 1 ? 'bg-success' : 'bg-danger' }}">
        {{ $author->status == 1 ? 'Active' : 'Inactive' }}
    </span>
</div>
<hr>
<div class="row align-items-center">
    <div class="card-content mt-2 d-flex gap-3">
        <article class="post-details w-100">
            <div class="post-thumb mb-3">
                <img src="{{ $author->profile_picture_path }}" alt="{{ $author->name }}" />
            </div>
            <h2>{{ $author->name }}</h2>
            <p class="mb-1"><strong>Title:</strong> {{ $author->title ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Email:</strong> {{ $author->email ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Website:</strong> {{ $author->website ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Company:</strong> {{ $author->company ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Education:</strong> {{ $author->education ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Expertise:</strong> {{ $author->expertise ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Favourite Tool:</strong> {{ $author->favourite_tool ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Articles Written By Author:</strong> {{ $author->blogs_count }}</p>
            <p class="mb-1"><strong>LinkedIn:</strong> {{ $author->linkedin_url ?? 'N/A' }}</p>
            <p class="mb-1"><strong>X:</strong> {{ $author->x_url ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Facebook:</strong> {{ $author->facebook_url ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Instagram:</strong> {{ $author->instagram_url ?? 'N/A' }}</p>
            <p class="mb-3"><strong>Amazon:</strong> {{ $author->amazon_url ?? 'N/A' }}</p>
            <div>
                <strong>About Author:</strong>
                <p class="mt-2">{!! $author->about_author ?: 'N/A' !!}</p>
            </div>
        </article>
    </div>
</div>
