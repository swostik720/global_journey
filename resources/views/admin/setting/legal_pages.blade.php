@extends('layouts.master')
@section('title', 'LEGAL PAGES')

@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Legal Pages"></x-breadcrumb>

        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.setting.legal-pages.update') }}" method="POST">
                    @method('PUT')

                    <h5 class="mb-3">Terms and Conditions</h5>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="terms_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="terms_title" name="terms_title"
                                value="{{ old('terms_title', $terms->title['en'] ?? '') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="terms_last_updated" class="form-label">Last Updated</label>
                            <input type="text" class="form-control" id="terms_last_updated" name="terms_last_updated"
                                value="{{ old('terms_last_updated', $terms->last_updated) }}"
                                placeholder="16 November 2025 (Asia/Kathmandu)">
                        </div>
                        <div class="col-12">
                            <label for="terms_description" class="form-label">Description (HTML allowed)</label>
                            <textarea id="terms_description" name="terms_description" class="form-control" rows="16" required>{{ old('terms_description', $terms->description['en'] ?? '') }}</textarea>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3 mt-4">Privacy Policy</h5>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="privacy_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="privacy_title" name="privacy_title"
                                value="{{ old('privacy_title', $privacy->title['en'] ?? '') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="privacy_last_updated" class="form-label">Last Updated</label>
                            <input type="text" class="form-control" id="privacy_last_updated" name="privacy_last_updated"
                                value="{{ old('privacy_last_updated', $privacy->last_updated) }}"
                                placeholder="16 November 2025 (Asia/Kathmandu)">
                        </div>
                        <div class="col-12">
                            <label for="privacy_description" class="form-label">Description (HTML allowed)</label>
                            <textarea id="privacy_description" name="privacy_description" class="form-control" rows="16" required>{{ old('privacy_description', $privacy->description['en'] ?? '') }}</textarea>
                        </div>
                    </div>

                    <x-form.button class="mt-3 btn btn-sm btn-primary" type="submit">
                        <i class='bx bx-save bx-xs'></i> Save Legal Pages
                    </x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\\Http\\Requests\\Admin\\Settings\\LegalPageUpdateRequest') !!}
@endpush
