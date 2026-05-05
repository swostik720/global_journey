@extends('layouts.master')
@section('title', 'Edit - ' . $study_abroad->title)
<link href="{{ asset('vendor/summernote/summernote.min.css') }}" rel="stylesheet">
@section('content')
    <div class="container-xxl">

        <x-breadcrumb listRoute="{{ route('admin.study-abroads.index') }}" model="StudyAbroad" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{ route('admin.study-abroads.update', $study_abroad->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PATCH')

                    <x-form.row>
                        <x-form.input type="file" label="Image" col="6" id="image" name="image"
                            alt="image" accept="image/*" onchange="previewThumb('image','image-thumb')" />
                        <x-form.preview for="image" col="6" id="image-thumb"
                            url="{{ $study_abroad->image_path }}" />
                    </x-form.row>

                    <x-form.row>
                        <x-form.select label="countries" :col="12" :req="true" :model="$study_abroad->country_id"
                            :options="$countries" name="country_id"></x-form.select>
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" label="Title" id="title" name="title"
                            value="{{ $study_abroad->title }}" :req="true" :col="6" />
                        <x-form.input type="text" label="Slug" id="slug" name="slug"
                            value="{{ $study_abroad->slug }}" :col="6" />
                    </x-form.row>

                    <x-form.textarea label="Short description" id="short_description" name="short_description"
                        value="{{ $study_abroad->short_description }}" rows="5" cols="5" />
                    <div class="mt-4">
                        <label for="description" class="col-form-label">DESCRIPTION</label>
                        <textarea name="description" id="description" class="form-control" placeholder=" description">{!! $study_abroad->description !!}</textarea>
                    </div>

                    <hr>
                    <h5 class="mt-4">Quick Information Grid</h5>
                    <p class="text-muted mb-2">Add key country facts (icon class, label and value). Icon example: <code>bi bi-globe</code></p>
                    @php
                        $quickInfos = old('quick_info_items', $study_abroad->quick_info_items ?? [['icon' => 'bi bi-globe', 'title' => '', 'value' => '']]);
                    @endphp
                    <div id="quick-info-wrapper">
                        @foreach ($quickInfos as $index => $item)
                            <div class="quick-info-item mb-3 border rounded p-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong>Info Item {{ $index + 1 }}</strong>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeQuickInfo(this)">Remove</button>
                                </div>
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <input type="text" name="quick_info_items[{{ $index }}][icon]" class="form-control"
                                            placeholder="Icon class (e.g. bi bi-globe)" value="{{ $item['icon'] ?? '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="quick_info_items[{{ $index }}][title]" class="form-control"
                                            placeholder="Title" value="{{ $item['title'] ?? '' }}">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="quick_info_items[{{ $index }}][value]" class="form-control"
                                            placeholder="Value / Description" value="{{ $item['value'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary my-2" onclick="addQuickInfo()">Add Quick Info</button>

                    <hr>
                    <h5 class="mt-4">Key Highlights</h5>
                    @php
                        $highlights = old('key_highlights', $study_abroad->key_highlights ?? [['text' => '']]);
                    @endphp
                    <div id="highlights-wrapper">
                        @foreach ($highlights as $index => $highlight)
                            <div class="highlight-item mb-3 border rounded p-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong>Highlight {{ $index + 1 }}</strong>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeHighlight(this)">Remove</button>
                                </div>
                                <input type="text" name="key_highlights[{{ $index }}][text]" class="form-control"
                                    placeholder="Highlight text" value="{{ $highlight['text'] ?? '' }}">
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary my-2" onclick="addHighlight()">Add Highlight</button>

                    <hr>
                    <h5 class="mt-4">Call To Action (CTA)</h5>
                    <x-form.row>
                        <x-form.input type="text" label="CTA Title" id="cta_title" name="cta_title"
                            value="{{ old('cta_title', $study_abroad->cta_title) }}" col="6" />
                        <x-form.input type="text" label="CTA Button Text" id="cta_button_text" name="cta_button_text"
                            value="{{ old('cta_button_text', $study_abroad->cta_button_text) }}" col="6" />
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="url" label="CTA Button URL" id="cta_button_url" name="cta_button_url"
                            value="{{ old('cta_button_url', $study_abroad->cta_button_url) }}" col="12" />
                    </x-form.row>
                    <x-form.textarea label="CTA Description" id="cta_description" name="cta_description"
                        value="{{ old('cta_description', $study_abroad->cta_description) }}" rows="4" cols="5" />

                    <hr>
                    <h5 class="mt-4">FAQ Section</h5>

                    @php
                        $faqs = old('faqs', $study_abroad->faqs ?? [['question' => '', 'answer' => '']]);
                    @endphp
                    <div id="faq-wrapper">
                        @foreach ($faqs as $index => $faq)
                            <div class="faq-item mb-3 border rounded p-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <strong>FAQ {{ $index + 1 }}</strong>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFaq(this)">Remove</button>
                                </div>
                                <input type="text" name="faqs[{{ $index }}][question]" class="form-control mb-2"
                                    placeholder="Question" value="{{ $faq['question'] ?? '' }}">

                                <textarea name="faqs[{{ $index }}][answer]" class="form-control" placeholder="Answer">{{ $faq['answer'] ?? '' }}</textarea>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-sm btn-secondary my-2" onclick="addFaq()">Add FAQ</button>

                    <div class="mt-2">
                        <x-form.checkbox label="Status" id="status" name="status" value="1"
                            class="form-check-input" isEditMode="yes" :isChecked="$study_abroad->status ? 'checked' : ''" />
                    </div>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                        Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>
@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StudyAbroadUpdateRequest') !!}
    @include('_helpers.new_image_preview')
    @include('_helpers.slugify', ['name' => 'title'])
    @include('_helpers.summernote_editor')

    <script>
        let faqIndex = document.querySelectorAll('#faq-wrapper .faq-item').length;
        let quickInfoIndex = document.querySelectorAll('#quick-info-wrapper .quick-info-item').length;
        let highlightIndex = document.querySelectorAll('#highlights-wrapper .highlight-item').length;

        function addFaq() {
            const html = `
                <div class="faq-item mb-3 border rounded p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong>FAQ ${faqIndex + 1}</strong>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFaq(this)">Remove</button>
                    </div>
                    <input type="text" name="faqs[${faqIndex}][question]" class="form-control mb-2" placeholder="Question">
                    <textarea name="faqs[${faqIndex}][answer]" class="form-control" placeholder="Answer"></textarea>
                </div>`;

            document.getElementById('faq-wrapper').insertAdjacentHTML('beforeend', html);
            faqIndex++;
        }

        function removeFaq(button) {
            button.closest('.faq-item').remove();
        }

        function addQuickInfo() {
            const html = `
                <div class="quick-info-item mb-3 border rounded p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong>Info Item ${quickInfoIndex + 1}</strong>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeQuickInfo(this)">Remove</button>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="quick_info_items[${quickInfoIndex}][icon]" class="form-control" placeholder="Icon class (e.g. bi bi-globe)">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="quick_info_items[${quickInfoIndex}][title]" class="form-control" placeholder="Title">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="quick_info_items[${quickInfoIndex}][value]" class="form-control" placeholder="Value / Description">
                        </div>
                    </div>
                </div>`;

            document.getElementById('quick-info-wrapper').insertAdjacentHTML('beforeend', html);
            quickInfoIndex++;
        }

        function removeQuickInfo(button) {
            button.closest('.quick-info-item').remove();
        }

        function addHighlight() {
            const html = `
                <div class="highlight-item mb-3 border rounded p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <strong>Highlight ${highlightIndex + 1}</strong>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeHighlight(this)">Remove</button>
                    </div>
                    <input type="text" name="key_highlights[${highlightIndex}][text]" class="form-control" placeholder="Highlight text">
                </div>`;

            document.getElementById('highlights-wrapper').insertAdjacentHTML('beforeend', html);
            highlightIndex++;
        }

        function removeHighlight(button) {
            button.closest('.highlight-item').remove();
        }
    </script>
@endpush
