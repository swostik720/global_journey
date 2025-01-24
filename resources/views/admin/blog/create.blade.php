@extends('layouts.master')
@section('title', 'Create Blog')
<link href="{{ asset('vendor/summernote/summernote.min.css') }}" rel="stylesheet">
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.blogs.index') }}" model="Blog" item="Create"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                    <x-form.row>
                        <x-form.input type="file" label="Main Image" col="6" name="image" alt="image"
                            accept="image/*" onchange="previewThumb('image','image-thumb')" />
                        <x-form.preview for="image" id="image-thumb" col="6" />
                    </x-form.row>
                    <hr>

                    <x-form.row>
                        <x-form.select label="category" col="6" :req="true" :options="$categories"
                            name="category_id"></x-form.select>

                        <x-form.input type="date" label="Blog date" id="blog_date" name="blog_date"
                            value="{{ old('blog_date') }}" :col="6" :req="true" />
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" label="Title" id="title" name="title"
                            value="{{ old('title') }}" :req="true" col="6" />

                        <x-form.input type="text" label="Slug" id="slug" name="slug"
                            value="{{ old('slug') }}" col="6" />
                    </x-form.row>

                    <x-form.textarea label="Short description" id="short_description" name="short_description"
                        value="{!! old('short_description') !!}" rows="3" cols="5" />

                    <div class="mt-4">
                        <label for="description" class="col-form-label">DESCRIPTION</label>
                        <textarea name="description" id="description" class="form-control" placeholder=" description">{!! old('description') !!}</textarea>
                    </div>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                        Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\BlogStoreRequest') !!}
    @include('_helpers.new_image_preview')
    @include('_helpers.slugify', ['name' => 'title'])
    @include('_helpers.summernote_editor')
@endpush
