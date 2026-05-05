<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Status:</b>
    <span class="badge {{ $faq->status == 1 ? 'bg-success' : 'bg-danger' }}">
        {{ $faq->status == 1 ? 'Active' : 'Inactive' }}
    </span>
</div>
<hr>
<div class="row align-items-center">
    <div class="card-content mt-2">
        <h4 class="mb-3"><b class="text-uppercase">question: </b>{{ $faq->question }}</h4>
        <h6 class="mb-2"><b class="text-uppercase">sort order: </b>{{ $faq->sort_order }}</h6>
        <div>
            <b class="text-uppercase d-block mb-2">answer:</b>
            <p class="mb-0">{{ $faq->answer }}</p>
        </div>
    </div>
</div>
