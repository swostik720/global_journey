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

    @if (!empty($test_preparation->quick_info_items))
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
                        @foreach ($test_preparation->quick_info_items as $item)
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

    @if (!empty($test_preparation->key_highlights))
        <div class="card-content mt-4">
            <h5 class="mb-3">Key Highlights</h5>
            <ul class="mb-0">
                @foreach ($test_preparation->key_highlights as $highlight)
                    <li>{{ $highlight['text'] ?? '' }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (!empty($test_preparation->cta_title) || !empty($test_preparation->cta_description) || !empty($test_preparation->cta_button_text) || !empty($test_preparation->cta_button_url))
        <div class="card-content mt-4">
            <h5 class="mb-3">CTA Block</h5>
            @if (!empty($test_preparation->cta_title))
                <p class="mb-1"><strong>Title:</strong> {{ $test_preparation->cta_title }}</p>
            @endif
            @if (!empty($test_preparation->cta_description))
                <p class="mb-1"><strong>Description:</strong> {{ $test_preparation->cta_description }}</p>
            @endif
            @if (!empty($test_preparation->cta_button_text))
                <p class="mb-1"><strong>Button Text:</strong> {{ $test_preparation->cta_button_text }}</p>
            @endif
            @if (!empty($test_preparation->cta_button_url))
                <p class="mb-0"><strong>Button URL:</strong> {{ $test_preparation->cta_button_url }}</p>
            @endif
        </div>
    @endif

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
