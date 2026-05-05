@extends('layouts.master')

@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.faqs.index') }}" model="Home FAQ" item="Create"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.faqs.store') }}" method="POST" enctype="multipart/form-data">
                    <x-form.input type="text" label="Question" id="question" name="question" value="{{ old('question') }}" :req="true" />
                    <x-form.textarea label="Answer" id="answer" name="answer" value="{{ old('answer') }}" rows="5" />
                    <x-form.input type="number" label="Sort Order" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" />
                    <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="true"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\FaqStoreRequest') !!}
@endpush
