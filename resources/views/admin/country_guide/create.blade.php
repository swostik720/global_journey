@extends('layouts.master')
@section('title', 'Create Country Guide')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.country_guide.index') }}" model="Country Guide" item="Create" />
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.country_guide.store') }}" method="POST">
                    <x-form.row>
                        <div class="mb-3 col-6">
                            <label for="country_id" class="form-label">Country</label>
                            <select name="country_id" id="country_id" class="form-control" required>
                                <option value="">Select Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            <x-form.textarea label="Guides (one per line)" id="guides" name="guides" value=""
                                rows="8" />
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
