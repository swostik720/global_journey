@extends('layouts.master')
@section('title', 'Create Study Abroad')
<link href="{{ asset('vendor/summernote/summernote.min.css') }}" rel="stylesheet">
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.study-abroads.index') }}" model="Study Abroad" item="Create"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.study-abroads.store') }}" method="POST"
                    enctype="multipart/form-data">
                    <x-form.row>
                        <x-form.input type="file" label="Image" col="6" name="image" alt="image"
                            accept="image/*" onchange="previewThumb('image','image-thumb')" />
                        <x-form.preview for="image" id="image-thumb" col="6" />
                    </x-form.row>

                    <x-form.row>
                        <x-form.select label="country" col="12" :req="true" :options="$countries"
                            name="country_id"></x-form.select>
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" label="Title" id="title" name="title"
                            value="{{ old('title') }}" :req="true" col="6" />

                        <x-form.input type="text" label="Slug" id="slug" name="slug"
                            value="{{ old('slug') }}" col="6" />
                    </x-form.row>

                    <x-form.textarea label="Short description" id="short description" name="short_description"
                        value="{!! old('short_description') !!}" rows="5" cols="5" />

                    <div class="mt-4">
                        <label for="description" class="col-form-label">DESCRIPTION</label>
                        <textarea name="description" id="description" class="form-control" placeholder=" description">{!! old('description') !!}</textarea>
                    </div>

                    <hr>
                    <h5 class="mt-4">FAQ Section</h5>

                    @php
                        $oldFaqs = old('faqs', [['question' => '', 'answer' => '']]);
                    @endphp
                    <div id="faq-wrapper">
                        @foreach ($oldFaqs as $index => $faq)
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

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                        Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StudyAbroadStoreRequest') !!}
    @include('_helpers.new_image_preview')
    @include('_helpers.slugify', ['name' => 'title'])
    @include('_helpers.summernote_editor')

    <script>
        let faqIndex = document.querySelectorAll('#faq-wrapper .faq-item').length;

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
    </script>
@endpush
