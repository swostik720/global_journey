@extends('layouts.master')
@section('title', 'Edit College & University')

@section('content')
<div class="container-xxl">
    <x-breadcrumb listRoute="{{ route('admin.college_and_university.index') }}" model="College & University" item="Edit" />
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <x-form.wrapper action="{{ route('admin.college_and_university.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')

                <x-form.row>
                    <div class="mb-3 col-6">
                        <label for="country_id" class="form-label">Country</label>
                        <select name="country_id" id="country_id" class="form-control" required>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" @if ($item->country_id == $country->id) selected @endif>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-6">
                        <x-form.input label="Name" id="name" name="name" value="{{ old('name', $item->name) }}" required />
                    </div>
                </x-form.row>

                <x-form.row>
                    <div class="mb-3 col-6">
                        <x-form.textarea label="Description" id="description" name="description" value="{{ old('description', $item->description) }}" rows="5" />
                    </div>
                    <div class="mb-3 col-6">
                        <x-form.input label="Link" id="link" name="link" value="{{ old('link', $item->link) }}" />
                    </div>
                </x-form.row>

                <x-form.row>
                    <div class="mb-3 col-6">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @if($item->image)
                            <div class="mt-2">
                                <img src="{{ asset($item->image) }}" alt="Image" width="100" class="img-thumbnail">
                            </div>
                        @endif
                    </div>
                </x-form.row>

                <x-form.button class="btn btn-sm btn-dark mt-3" type="submit">
                    <i class='bx bx-save bx-xs'></i> Update
                </x-form.button>
            </x-form.wrapper>
        </div>
    </div>
</div>
@endsection
