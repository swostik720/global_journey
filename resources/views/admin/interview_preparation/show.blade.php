<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Status:</b>
    <span class="badge {{ $item->status == 1 ? 'bg-success' : 'bg-danger' }}">
        {{ $item->status == 1 ? 'Active' : 'Inactive' }}
    </span>
</div>
<hr>

<div class="row align-items-center">
    <div class="card-content mt-2 d-flex gap-3">
        <div class="col-md-4">
            <x-table.show_modal_image name="{{ $item->image }}" url="{{ $item->image_path }}" class="rounded" />
        </div>
        <div class="col-md-8">
            <div class="card-content mt-2">
                <h1>{{ $item->title ?? '' }}</h1>
            </div>
        </div>
    </div>

    <div class="card-content mt-4">
        <b class="d-block text-uppercase text-14">Description:</b>
        <span>{!! $item->description ?? '' !!}</span>
    </div>

    {{-- Visa Conditions --}}
    <div class="card-content mt-4">
        <b class="d-block text-uppercase text-14">Visa Conditions:</b>
        <ul>
            @foreach ($item->visa_conditions ?? [] as $condition)
                <li>{{ $condition }}</li>
            @endforeach
        </ul>
    </div>

    {{-- Interview Questions --}}
    <div class="card-content mt-4">
        <b class="d-block text-uppercase text-14">Interview Questions & Answers:</b>
        @foreach ($item->interview_questions ?? [] as $iq)
            <p><strong>Q: {{ $iq['question'] }}</strong></p>
            <p>A: {{ $iq['answer'] }}</p>
        @endforeach
    </div>


    {{-- FAQs --}}
    <div class="card-content mt-4">
        <b class="d-block text-uppercase text-14">FAQs:</b>
        @foreach ($item->faqs ?? [] as $faq)
            <p><strong>Q: {{ $faq['question'] }}</strong></p>
            <p>A: {{ $faq['answer'] }}</p>
        @endforeach
    </div>
</div>
