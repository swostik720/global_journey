@extends('layouts.master')
@section('title', 'Create Why Country')
@section('content')
<div class="container-xxl">
    <x-breadcrumb listRoute="{{ route('admin.why_country.index') }}" model="Why Country" item="Create" />
    <div class="card">
        <div class="card-body">
            <x-form.wrapper action="{{ route('admin.why_country.store') }}" method="POST">
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
                        <x-form.textarea label="Description (one per line)" id="description" name="description" value="" rows="8" />
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
