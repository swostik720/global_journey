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
@endpush
