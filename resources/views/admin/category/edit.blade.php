@extends('layouts.master')
@section('title', 'Edit - ' . $category->name)
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.categories.index') }}" model="Blog Category" item="Edit"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    <x-form.input type="text" label="Blog CategoryName" id="name" name="name"
                        value="{{ $category->name }}" />
                    <div class="mt-2">
                        <x-form.checkbox label="Status" id="status" name="status" value="1"
                            class="form-check-input" isEditMode="yes" :isChecked="$category->status ? 'checked' : ''" />
                    </div>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                        Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>
@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CategoryUpdateRequest') !!}
@endpush
