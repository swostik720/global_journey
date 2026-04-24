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
