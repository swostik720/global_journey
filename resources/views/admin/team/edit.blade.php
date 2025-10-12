@extends('layouts.master')
@section('title', 'Edit - ' . $team->name)
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.teams.index') }}" model="Team" item="Edit"></x-breadcrumb>
        <x-form.wrapper action="{{ route('admin.teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')

            <div class="d-flex gap-3">
                <div class="card col-md-6">
                    <h5 class="card-title m-3">Team Basic Details</h5>
                    <div class="card-body">
                        <x-form.row>
                            <x-form.input type="file" label="Image" col="6" id="image" name="image"
                                alt="image" accept="image/*" onchange="previewThumb('image','image-thumb')" />
                            <x-form.preview for="image" col="6" id="image-thumb" url="{{ $team->image_path }}" />
                        </x-form.row>

                        <x-form.input type="text" label="Name" id="name" name="name"
                            value="{{ $team->name }}" :req="true" />
                        <x-form.input type="email" label="Email" id="email" name="email"
                            value="{{ $team->email }}" :req="true" />
                        <x-form.input type="text" label="phone" id="phone" name="phone"
                            value="{{ $team->phone }}" :req="true" />
                        <x-form.input type="text" label="Responsibility" id="responsibility" name="responsibility"
                            value="{{ $team->responsibility }}" :req="true" />
                        {{-- <x-form.input type="text" label="experience" id="experience" name="experience"
                            value="{{ $team->experience }}" :req="true" /> --}}
                        <x-form.input type="number" label="Rank" id="rank" name="rank"
                            value="{{ $team->rank ?? \App\Models\Team::max('rank') + 1 }}" :req="true" />
                    </div>
                </div>
                <div class="card col-md-6">
                    <h5 class="card-title m-3">Social Media Links</h5>
                    <div class="card-body">
                        <x-form.input type="text" label="Facebook link" id="fb_link" name="fb_link"
                            value="{{ $team->fb_link }}" />
                        <x-form.input type="text" label="Twitter link" id="twitter_link" name="twitter_link"
                            value="{{ $team->twitter_link }}" />
                        <x-form.input type="text" label="LinkedIn link" id="linkedin_link" name="linkedin_link"
                            value="{{ $team->linkedin_link }}" />
                        <x-form.input type="text" label="Instagram link" id="instagram_link" name="instagram_link"
                            value="{{ $team->instagram_link }}" />
                    </div>
                </div>
            </div>

            {{-- <div class="card mt-4">
                <div class="card-body">
                    <x-form.textarea label="details" id="details" name="details" value="{!! $team->details !!}"
                        rows="5" cols="5" />
                </div>
            </div> --}}

            <div class="mt-2">
                <x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input"
                    isEditMode="yes" :isChecked="$team->status ? 'checked' : ''" />
            </div>
            <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                Save</x-form.button>
        </x-form.wrapper>
    </div>
@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\TeamUpdateRequest') !!}
    @include('_helpers.new_image_preview')
    @include('_helpers.ck_editor', ['textarea_id' => 'details'])
@endpush
