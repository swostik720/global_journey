@extends('layouts.master')
@section('title', 'Edit - ' . $galleryCategory->title)
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.galleryCategory.index') }}" model="Gallery Category" item="Edit"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.galleryCategory.update', $galleryCategory->id) }}" method="POST">
                    @method('PATCH')
                    <x-form.input type="text" label="Gallery Category Title" id="title" name="title"
                        value="{{ $galleryCategory->title }}" :req="true" />
                    <x-form.input type="text" label="Description" id="description" name="description"
                        value="{{ $galleryCategory->description }}" />

                    <x-form.button class="btn btn-sm btn-dark" type="submit">
                        <i class='bx bx-save bx-xs'></i> Save
                    </x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>
@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\GalleryCategoryRequest') !!}
@endpush
