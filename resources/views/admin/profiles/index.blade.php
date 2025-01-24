@extends('layouts.master')
@section('title', 'PROFILE')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Profile"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.profiles.update') }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    <div class="">
                        <label for="email" class="col-form-label">EMAIL: </label>
                        <label for="email" class="badge bg-primary text-lowercase">{{ $user->email }}</label>
                    </div>
                    <x-form.row>
                        <x-form.input type="file" col="6" label="Image" :tooltip="true"
                            tooltip_text="Upload less than 2MB" id="image" name="image" alt="image"
                            accept="image/*" onchange="previewThumb('image','image-thumb')" />
                        <x-form.input type="text" col="6" label="Name" id="name" name="name"
                            value="{{ $user->name }}" />

                    </x-form.row>
                    <x-form.newpreview for="image" id="image-thumb" url="{{ $user->image_path }}" />

                    <hr>
                    <x-form.password label="Current Password" id="current_password" name="current_password"
                        value="{{ old('current_password') }}" />

                    <x-form.row>
                        <x-form.password col="6" label="New Password" id="new_password" name="new_password" />
                        <x-form.password col="6" label="Confirm Password" id="confirm_password"
                            name="confirm_password" />
                    </x-form.row>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                        Save</x-form.button>
                </x-form.wrapper>
            </div>

        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ProfileRequest') !!}
    @include('_helpers.new_image_preview')
@endpush
