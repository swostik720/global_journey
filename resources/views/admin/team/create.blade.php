@extends('layouts.master')
@section('title', 'Create Team')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.teams.index') }}" model="Team" item="Create"></x-breadcrumb>

        <x-form.wrapper action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
            <div class="d-flex gap-3">
                <div class="card col-md-6">
                    <h5 class="card-title m-3">Team Basic Details</h5>
                    <div class="card-body">
                        <x-form.row>
                            <x-form.input type="file" label="Image" col="6" name="image" alt="image"
                                accept="image/*" onchange="previewThumb('image','image-thumb')" />
                            <x-form.preview for="image" id="image-thumb" col="6" />
                        </x-form.row>

                        <x-form.input type="text" label="Name" id="name" name="name"
                            value="{{ old('name') }}" placeholder="John Doe" :req="true" />
                        <x-form.input type="email" label="Email" id="email" name="email"
                            value="{{ old('email') }}" placeholder="johndoe@gmail.com" :req="true" />
                        <x-form.input type="text" label="phone" id="phone" name="phone"
                            value="{{ old('phone') }}" placeholder="+91590 0574 258" :req="true" />
                        <x-form.input type="text" label="Responsibility" id="responsibility" name="responsibility"
                            value="{{ old('responsibility') }}" placeholder="Systems engineer" :req="true" />
                        {{-- <x-form.input type="text" label="experience" id="experience" name="experience"
                            value="{{ old('experience') }}" placeholder="18 Years" :req="true" /> --}}
                    </div>
                </div>
                <div class="card col-md-6">
                    <h5 class="card-title m-3">Social Media Links</h5>
                    <div class="card-body">
                        <x-form.input type="text" label="Facebook link" id="fb_link" name="fb_link"
                            value="{{ old('fb_link') }}" placeholder="https://www.facebook.com/name" />
                        <x-form.input type="text" label="Twitter link" id="twitter_link" name="twitter_link"
                            value="{{ old('twitter_link') }}" placeholder="https://www.twitter.com/name" />
                        <x-form.input type="text" label="LinkedIn link" id="linkedin_link" name="linkedin_link"
                            value="{{ old('linkedin_link') }}" placeholder="https://www.linkedin.com/name" />
                        <x-form.input type="text" label="Instagram link" id="instagram_link" name="instagram_link"
                            value="{{ old('instagram_link') }}" placeholder="https://www.instagram.com/name" />
                    </div>
                </div>
            </div>

            {{-- <div class="card mt-4">
                <div class="card-body">
                    <x-form.textarea label="details" id="details" name="details" value="{!! old('details') !!}"
                        rows="5" cols="5" placeholder="Professional Skills, Since joining at XYZ in 1993..." />
                </div>
            </div> --}}

            <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                Save</x-form.button>
        </x-form.wrapper>

    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\TeamStoreRequest') !!}
    @include('_helpers.new_image_preview')
    @include('_helpers.ck_editor', ['textarea_id' => 'details'])
@endpush
