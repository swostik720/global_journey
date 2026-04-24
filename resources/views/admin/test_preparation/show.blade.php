<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Status:</b>
    <span class="badge {{ $test_preparation->status == 1 ? 'bg-success' : 'bg-danger' }}">
        {{ $test_preparation->status == 1 ? 'Active' : 'Inactive' }}
    </span>
</div>
<hr>
<div class="row align-items-center  ">
    <div class="card-content mt-2 d-flex gap-3">
        <div class="col-md-4">
            <x-table.show_modal_image name="{{ $test_preparation->image }}" url="{{ $test_preparation->image_path }}"
                class="rounded" />
        </div>
        <div class="col-md-8">
            <div class="card-content mt-2">
                <h1>{{ $test_preparation->title ?? '' }}</h1>
            </div>
        </div>
    </div>
    <div class="card-content mt-4">
        <b class="d-block text-uppercase text-14"></b><span>{!! $test_preparation->description ?? '' !!}</span>
    </div>

    @if (!empty($test_preparation->faqs))
        <div class="card-content mt-4">
            <h5 class="mb-3">FAQs</h5>
            <div class="accordion" id="testPreparationFaqAdmin">
                @foreach ($test_preparation->faqs as $index => $faq)
                    <div class="accordion-item mb-2">
                        <h2 class="accordion-header" id="adminFaqHead{{ $index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#adminFaqCollapse{{ $index }}" aria-expanded="false"
                                aria-controls="adminFaqCollapse{{ $index }}">
                                {{ $faq['question'] ?? 'Question' }}
                            </button>
                        </h2>
                        <div id="adminFaqCollapse{{ $index }}" class="accordion-collapse collapse"
                            aria-labelledby="adminFaqHead{{ $index }}" data-bs-parent="#testPreparationFaqAdmin">
                            <div class="accordion-body">
                                {!! $faq['answer'] ?? '' !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
