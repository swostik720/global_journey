@extends('layouts.master')
@section('title', 'Create Blog Author')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.blog-authors.index') }}" model="Blog Author" item="Create"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.blog-authors.store') }}" method="POST" enctype="multipart/form-data">
                    <x-form.row>
                        <x-form.input type="file" label="Profile Picture" col="6" name="profile_picture" alt="profile_picture" accept="image/*" onchange="previewThumb('profile_picture','profile-picture-thumb')" />
                        <x-form.preview for="profile_picture" id="profile-picture-thumb" col="6" />
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" label="Name" id="name" name="name" value="{{ old('name') }}" :req="true" col="6" />
                        <x-form.input type="text" label="Title" id="title" name="title" value="{{ old('title') }}" col="6" />
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="email" label="Email" id="email" name="email" value="{{ old('email') }}" col="6" />
                        <x-form.input type="url" label="Website" id="website" name="website" value="{{ old('website') }}" col="6" />
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" label="Company" id="company" name="company" value="{{ old('company') }}" col="6" />
                        <x-form.input type="text" label="Favourite Tool" id="favourite_tool" name="favourite_tool" value="{{ old('favourite_tool') }}" col="6" />
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" label="Education" id="education" name="education" value="{{ old('education') }}" col="6" />
                        <x-form.input type="text" label="Expertise" id="expertise" name="expertise" value="{{ old('expertise') }}" col="6" />
                    </x-form.row>

                    <h5 class="mt-4 mb-3">Follow Me Links</h5>
                    <x-form.row>
                        <x-form.input type="url" label="LinkedIn URL" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url') }}" col="6" />
                        <x-form.input type="url" label="X URL" id="x_url" name="x_url" value="{{ old('x_url') }}" col="6" />
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="url" label="Facebook URL" id="facebook_url" name="facebook_url" value="{{ old('facebook_url') }}" col="6" />
                        <x-form.input type="url" label="Instagram URL" id="instagram_url" name="instagram_url" value="{{ old('instagram_url') }}" col="6" />
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="url" label="Amazon URL" id="amazon_url" name="amazon_url" value="{{ old('amazon_url') }}" col="6" />
                        <x-form.input type="text" label="Articles Written By Author" id="articles_written" name="articles_written" value="0" col="6" readonly />
                    </x-form.row>

                    <x-form.textarea label="About Author" id="about_author" name="about_author" value="{!! old('about_author') !!}" rows="6" cols="5" />

                    <div class="mt-2">
                        <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" :isChecked="'checked'" />
                    </div>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\\Http\\Requests\\Admin\\BlogAuthorStoreRequest') !!}
    @include('_helpers.new_image_preview')
@endpush
