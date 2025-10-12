@extends('layouts.master')
@section('title', 'Edit Why Country')
@section('content')
<div class="container-xxl">
    <x-breadcrumb listRoute="{{ route('admin.why_country.index') }}" model="Why Country" item="Edit" />
    <div class="card">
        <div class="card-body">
            <!-- Make sure method="POST" and include @method('PUT') -->
            <form action="{{ route('admin.why_country.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- important for PUT requests -->

                <div class="row">
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
                        <label for="description" class="form-label">Description (one per line)</label>
                        <textarea name="description" id="description" rows="8" class="form-control" required>{{ is_array($item->description) ? implode(PHP_EOL, $item->description) : '' }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-sm btn-dark mt-3">
                    <i class='bx bx-save bx-xs'></i> Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
