@extends('layouts.master')
@section('title', 'Create College & University')

@section('content')
<div class="container-xxl">
    <x-breadcrumb listRoute="{{ route('admin.college_and_university.index') }}" model="College & University" item="Create" />
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <x-form.wrapper action="{{ route('admin.college_and_university.store') }}" method="POST" enctype="multipart/form-data">
                <x-form.row>
                    <div class="mb-3 col-6">
                        <label for="country_id" class="form-label">Country</label>
                        <select name="country_id" id="country_id" class="form-control" required>
                            <option value="">Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-6">
                        <x-form.input label="Name" id="name" name="name" value="{{ old('name') }}" required />
                    </div>
                </x-form.row>

                <x-form.row>
                    <div class="mb-3 col-6">
                        <x-form.textarea label="Description" id="description" name="description" value="{{ old('description') }}" rows="5" />
                    </div>
                    <div class="mb-3 col-6">
                        <x-form.input label="Link" id="link" name="link" value="{{ old('link') }}" />
                    </div>
                </x-form.row>

                <x-form.row>
                    <div class="mb-3 col-6">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </x-form.row>

                <x-form.button class="btn btn-sm btn-dark mt-3" type="submit">
                    <i class='bx bx-save bx-xs'></i> Save
                </x-form.button>
            </x-form.wrapper>
        </div>
    </div>
</div>
@endsection
