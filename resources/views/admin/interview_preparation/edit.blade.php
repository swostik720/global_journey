@extends('layouts.master')
@section('title', 'Edit - ' . $item->title)
<link href="{{ asset('vendor/summernote/summernote.min.css') }}" rel="stylesheet">

@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.interview_preparation.index') }}" model="InterviewPreparation"
            item="Edit" />

        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.interview_preparation.update', $item) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    <x-form.row>
                        <x-form.input type="file" label="Image" col="6" id="image" name="image"
                            alt="image" accept="image/*" onchange="previewThumb('image','image-thumb')" />
                        <x-form.preview for="image" col="6" id="image-thumb" url="{{ $item->image_path }}" />
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="text" label="Slug" id="slug" name="slug"
                            value="{{ $item->slug }}" col="6" readonly />
                        <x-form.input type="text" label="Title" id="title" name="title"
                            value="{{ $item->title }}" :req="true" col="6" />
                    </x-form.row>
                    <div class="mb-3">
                        <label for="country_id" class="form-label">Country</label>
                        <select name="country_id" id="country_id" class="form-control" required>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" @if ($item->country_id == $country->id) selected @endif>
                                    {{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-form.textarea label="Description" id="description" name="description"
                        value="{{ $item->description }}" rows="5" cols="5" />
                    {{-- Visa Conditions --}}
                    <div class="mt-4">
                        <label class="col-form-label">Visa Conditions</label>
                        <div id="visa-conditions-list">
                            @foreach ($item->visa_conditions ?? [] as $condition)
                                <input type="text" name="visa_conditions[]" class="form-control mb-2"
                                    value="{{ $condition }}" placeholder="Condition">
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="addVisaCondition()">Add
                            Condition</button>
                    </div>
                    {{-- Interview Questions --}}
                    <div class="mt-4">
                        <label class="col-form-label">Interview Questions</label>
                        <div id="interview-questions-list">
                            @foreach ($item->interview_questions ?? [] as $i => $iq)
                                <div class="iq-item mb-2">
                                    <input type="text" name="interview_questions[{{ $i }}][question]"
                                        class="form-control mb-1" value="{{ $iq['question'] ?? '' }}"
                                        placeholder="Question">
                                    <textarea name="interview_questions[{{ $i }}][answer]" class="form-control" placeholder="Answer">{{ $iq['answer'] ?? '' }}</textarea>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="addInterviewQuestion()">Add
                            Question</button>
                    </div>
                    {{-- FAQs --}}
                    <div class="mt-4">
                        <label class="col-form-label">FAQs</label>
                        <div id="faqs-list">
                            @foreach ($item->faqs ?? [] as $i => $faq)
                                <div class="faq-item mb-2">
                                    <input type="text" name="faqs[{{ $i }}][question]"
                                        class="form-control mb-1" value="{{ $faq['question'] ?? '' }}"
                                        placeholder="FAQ Question">
                                    <textarea name="faqs[{{ $i }}][answer]" class="form-control" placeholder="FAQ Answer">{{ $faq['answer'] ?? '' }}</textarea>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary" onclick="addFaq()">Add FAQ</button>
                    </div>
                    <div class="mt-2">
                        <x-form.checkbox label="Status" id="status" name="status" value="1" isEditMode="yes"
                            :isChecked="$item->status ? 'checked' : ''" />
                    </div>
                    <x-form.button class="btn btn-sm btn-dark mt-3" type="submit">
                        <i class='bx bx-save bx-xs'></i> Save
                    </x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\InterviewPreparationUpdateRequest') !!}
    @include('_helpers.new_image_preview')
    @include('_helpers.slugify', ['name' => 'title'])
    @include('_helpers.summernote_editor')
    <script>
        function addVisaCondition() {
            const list = document.getElementById('visa-conditions-list');
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'visa_conditions[]';
            input.className = 'form-control mb-2';
            input.placeholder = 'Condition';
            list.appendChild(input);
        }

        let iqIndex = document.querySelectorAll('#interview-questions-list .iq-item').length;

        function addInterviewQuestion() {
            const list = document.getElementById('interview-questions-list');
            const div = document.createElement('div');
            div.className = 'iq-item mb-2';
            div.innerHTML = `
        <input type="text" name="interview_questions[${iqIndex}][question]" class="form-control mb-1" placeholder="Question">
        <textarea name="interview_questions[${iqIndex}][answer]" class="form-control" placeholder="Answer"></textarea>
    `;
            list.appendChild(div);
            iqIndex++;
        }

        let faqIndex = document.querySelectorAll('#faqs-list .faq-item').length;

        function addFaq() {
            const list = document.getElementById('faqs-list');
            const div = document.createElement('div');
            div.className = 'faq-item mb-2';
            div.innerHTML = `<input type="text" name="faqs[${faqIndex}][question]" class="form-control mb-1" placeholder="FAQ Question">
                <textarea name="faqs[${faqIndex}][answer]" class="form-control" placeholder="FAQ Answer"></textarea>`;
            list.appendChild(div);
            faqIndex++;
        }
    </script>
@endpush
