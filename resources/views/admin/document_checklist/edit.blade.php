@extends('layouts.master')
@section('title', 'Edit Document Checklist')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.document_checklist.index') }}" model="Document Checklist" item="Edit" />
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.document_checklist.update', $item->id) }}" method="POST">
                    @method('PUT')
                    <x-form.row>
                        <div class="mb-3 col-6">
                            <label for="country_id" class="form-label">Country</label>
                            <select name="country_id" id="country_id" class="form-control" required>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @if ($item->country_id == $country->id) selected @endif>
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            <x-form.textarea label="Documents (one per line)" id="documents" name="documents"
                                :value="old(
                                    'documents',
                                    is_array($item->documents) ? implode(chr(10), $item->documents) : '',
                                )" rows="8" />

                        </div>
                    </x-form.row>
                    <x-form.button class="btn btn-sm btn-dark mt-3" type="submit">
                        <i class='bx bx-save bx-xs'></i> Update
                    </x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\DocumentChecklistRequest') !!}
@endpush
