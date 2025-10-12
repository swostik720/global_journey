<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Gallery Details:</b>
</div>
<hr>

<div class="row">
    <div class="col-12 mb-2">
        <h5><b>Title:</b> {{ $gallery->title }}</h5>
    </div>

    <div class="col-12 mb-2">
        <h5><b>Category:</b> {{ $gallery->galleryCategory->title ?? '-' }}</h5>
    </div>

    <div class="col-12 mb-2">
        <h5><b>Images:</b></h5>
        <div class="d-flex flex-wrap">
            @if($gallery->images)
                @foreach($gallery->images as $img)
                    <img src="{{ asset('uploaded-images/gallery/' . $img) }}" width="80" class="me-1 mb-1">
                @endforeach
            @else
                <span>No images uploaded.</span>
            @endif
        </div>
    </div>
</div>
