@extends('layouts.master')
@section('title', 'Edit - ' . $author->name)
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.blog-authors.index') }}" model="Blog Author" item="Edit"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.blog-authors.update', $author->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')

                    <x-form.row>
                        <x-form.input type="file" label="Profile Picture" col="6" id="profile_picture" name="profile_picture" alt="profile_picture" accept="image/*" onchange="previewThumb('profile_picture','profile-picture-thumb')" />
                        <x-form.preview for="profile_picture" id="profile-picture-thumb" col="6" url="{{ $author->profile_picture_path }}" />
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" label="Name" id="name" name="name" value="{{ old('name', $author->name) }}" :req="true" col="6" />
                        <x-form.input type="text" label="Title" id="title" name="title" value="{{ old('title', $author->title) }}" col="6" />
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="email" label="Email" id="email" name="email" value="{{ old('email', $author->email) }}" col="6" />
                        <x-form.input type="url" label="Website" id="website" name="website" value="{{ old('website', $author->website) }}" col="6" />
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" label="Company" id="company" name="company" value="{{ old('company', $author->company) }}" col="6" />
                        <x-form.input type="text" label="Favourite Tool" id="favourite_tool" name="favourite_tool" value="{{ old('favourite_tool', $author->favourite_tool) }}" col="6" />
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" label="Education" id="education" name="education" value="{{ old('education', $author->education) }}" col="6" />
                        <x-form.input type="text" label="Expertise" id="expertise" name="expertise" value="{{ old('expertise', $author->expertise) }}" col="6" />
                    </x-form.row>

                    <h5 class="mt-4 mb-3">Follow Me Links</h5>
                    <x-form.row>
                        <x-form.input type="url" label="LinkedIn URL" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $author->linkedin_url) }}" col="6" />
                        <x-form.input type="url" label="X URL" id="x_url" name="x_url" value="{{ old('x_url', $author->x_url) }}" col="6" />
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="url" label="Facebook URL" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $author->facebook_url) }}" col="6" />
                        <x-form.input type="url" label="Instagram URL" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $author->instagram_url) }}" col="6" />
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="url" label="Amazon URL" id="amazon_url" name="amazon_url" value="{{ old('amazon_url', $author->amazon_url) }}" col="6" />
                        <x-form.input type="text" label="Articles Written By Author" id="articles_written" name="articles_written" value="{{ $author->blogs_count }}" col="6" readonly />
                    </x-form.row>

                    <x-form.textarea label="About Author" id="about_author" name="about_author" value="{!! old('about_author', $author->about_author) !!}" rows="6" cols="5" />

                    <div class="mt-2">
                        <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="$author->status ? 'checked' : ''" />
                    </div>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\\Http\\Requests\\Admin\\BlogAuthorUpdateRequest') !!}
    @include('_helpers.new_image_preview')
@endpush
