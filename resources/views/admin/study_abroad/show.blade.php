<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Status:</b>
    <span class="badge {{ $study_abroad->status == 1 ? 'bg-success' : 'bg-danger' }}">
        {{ $study_abroad->status == 1 ? 'Active' : 'Inactive' }}
    </span>
</div>
<hr>
<div class="row align-items-center  ">
    <div class="card-content mt-2 d-flex gap-3">
        <div class="col-md-4">
            <x-table.show_modal_image name="{{ $study_abroad->image }}" url="{{ $study_abroad->image_path }}"
                class="rounded" />
        </div>
        <div class="col-md-8">
            <div class="card-content mt-2">
                <h1>{{ $study_abroad->title ?? '' }}</h1>
            </div>

            @if (!empty($study_abroad->country->name))
                <div class="card-content mt-2">
                    <h5><strong>Country: </strong>{{ $study_abroad->country->name ?? '' }}</h5>
                </div>
            @endif
        </div>
    </div>
    <div class="card-content mt-4">
        <b class="d-block text-uppercase text-14"></b><span>{!! $study_abroad->description ?? '' !!}</span>
    </div>

    @if (!empty($study_abroad->quick_info_items))
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
                        @foreach ($study_abroad->quick_info_items as $item)
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

    @if (!empty($study_abroad->key_highlights))
        <div class="card-content mt-4">
            <h5 class="mb-3">Key Highlights</h5>
            <ul class="mb-0">
                @foreach ($study_abroad->key_highlights as $highlight)
                    <li>{{ $highlight['text'] ?? '' }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (!empty($study_abroad->cta_title) || !empty($study_abroad->cta_description) || !empty($study_abroad->cta_button_text) || !empty($study_abroad->cta_button_url))
        <div class="card-content mt-4">
            <h5 class="mb-3">CTA Block</h5>
            @if (!empty($study_abroad->cta_title))
                <p class="mb-1"><strong>Title:</strong> {{ $study_abroad->cta_title }}</p>
            @endif
            @if (!empty($study_abroad->cta_description))
                <p class="mb-1"><strong>Description:</strong> {{ $study_abroad->cta_description }}</p>
            @endif
            @if (!empty($study_abroad->cta_button_text))
                <p class="mb-1"><strong>Button Text:</strong> {{ $study_abroad->cta_button_text }}</p>
            @endif
            @if (!empty($study_abroad->cta_button_url))
                <p class="mb-0"><strong>Button URL:</strong> {{ $study_abroad->cta_button_url }}</p>
            @endif
        </div>
    @endif

    @if (!empty($study_abroad->faqs))
        <div class="card-content mt-4">
            <h5 class="mb-3">FAQs</h5>
            <div class="accordion" id="studyAbroadFaqAdmin">
                @foreach ($study_abroad->faqs as $index => $faq)
                    <div class="accordion-item mb-2">
                        <h2 class="accordion-header" id="adminFaqHead{{ $index }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#adminFaqCollapse{{ $index }}" aria-expanded="false"
                                aria-controls="adminFaqCollapse{{ $index }}">
                                {{ $faq['question'] ?? 'Question' }}
                            </button>
                        </h2>
                        <div id="adminFaqCollapse{{ $index }}" class="accordion-collapse collapse"
                            aria-labelledby="adminFaqHead{{ $index }}" data-bs-parent="#studyAbroadFaqAdmin">
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
