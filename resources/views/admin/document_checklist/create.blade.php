@extends('layouts.master')
@section('title', 'Create Document Checklist')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.document_checklist.index') }}" model="Document Checklist" item="Create" />
        <div class="card">
            <div class="card-body">
                @php
                    $oldDocuments = old('documents', [['name' => '', 'description' => '']]);
                    if (!is_array($oldDocuments) || empty($oldDocuments)) {
                        $oldDocuments = [['name' => '', 'description' => '']];
                    }
                @endphp

                <x-form.wrapper action="{{ route('admin.document_checklist.store') }}" method="POST"
                    enctype="multipart/form-data">
                    <x-form.row>
                        <div class="mb-3 col-6">
                            <label for="country_id" class="form-label">Country</label>
                            <select name="country_id" id="country_id" class="form-control" required>
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @selected(old('country_id') == $country->id)>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="pdf_file" class="form-label">Document Checklist PDF</label>
                            <input type="file" name="pdf_file" id="pdf_file" class="form-control" accept="application/pdf">
                            <small class="text-muted">Accepted: PDF only. Max size: 10MB. The file is stored in public/frontend/assets/pdf and linked to the selected country.</small>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label">Documents</label>
                            <div id="documents-wrapper" class="d-flex flex-column gap-3">
                                @foreach ($oldDocuments as $idx => $doc)
                                    <div class="row g-2 align-items-start document-row" data-index="{{ $idx }}">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control"
                                                name="documents[{{ $idx }}][name]" placeholder="Document Name"
                                                value="{{ is_array($doc) ? $doc['name'] ?? '' : '' }}" required>
                                        </div>
                                        <div class="col-md-7">
                                            <textarea class="form-control" name="documents[{{ $idx }}][description]" rows="3"
                                                placeholder="Description (use one point per line)">{{ is_array($doc) ? $doc['description'] ?? '' : '' }}</textarea>
                                        </div>
                                        <div class="col-md-1 d-grid">
                                            <button type="button" class="btn btn-outline-danger remove-document">X</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="add-document" class="btn btn-sm btn-outline-dark mt-3">
                                + Add Document
                            </button>
                        </div>
                    </x-form.row>
                    <x-form.button class="btn btn-sm btn-dark mt-3" type="submit">
                        <i class='bx bx-save bx-xs'></i> Save
                    </x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\DocumentChecklistRequest') !!}
    <script>
        (function() {
            const wrapper = document.getElementById('documents-wrapper');
            const addButton = document.getElementById('add-document');

            const rowTemplate = (index) => `
                <div class="row g-2 align-items-start document-row" data-index="${index}">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="documents[${index}][name]" placeholder="Document Name" required>
                    </div>
                    <div class="col-md-7">
                        <textarea class="form-control" name="documents[${index}][description]" rows="3" placeholder="Description (use one point per line)"></textarea>
                    </div>
                    <div class="col-md-1 d-grid">
                        <button type="button" class="btn btn-outline-danger remove-document">X</button>
                    </div>
                </div>`;

            const bindRemoveHandlers = () => {
                wrapper.querySelectorAll('.remove-document').forEach((button) => {
                    button.onclick = () => {
                        if (wrapper.querySelectorAll('.document-row').length > 1) {
                            button.closest('.document-row').remove();
                        }
                    };
                });
            };

            addButton?.addEventListener('click', () => {
                const nextIndex = wrapper.querySelectorAll('.document-row').length;
                wrapper.insertAdjacentHTML('beforeend', rowTemplate(nextIndex));
                bindRemoveHandlers();
            });

            bindRemoveHandlers();
        })();
    </script>
@endpush
