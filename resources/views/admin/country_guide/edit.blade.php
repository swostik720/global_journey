@extends('layouts.master')
@section('title', 'Edit Country Guide')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.country_guide.index') }}" model="Country Guide" item="Edit" />
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.country_guide.update', $item->id) }}" method="POST">
                    @method('PUT')
                    <x-form.row>
                        <div class="mb-3 col-6">
                            <label for="country_id" class="form-label">Country</label>
                            <select name="country_id" id="country_id" class="form-control" required>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @if ($item->country_id == $country->id) selected @endif>
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-6">
                            <x-form.textarea label="Guides (one per line)" id="guides" name="guides" :value="old('guides', is_array($item->guides) ? implode(PHP_EOL, $item->guides) : '')"
                                rows="8" />
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
