@extends('layouts.master')
@section('title', 'Create Enrollment')
@section('content')
<div class="container-xxl">
    <x-breadcrumb listRoute="{{ route('admin.enrollNow.index') }}" model="Enrollment" item="Create" />
    <div class="card">
        <div class="card-body">
            <x-form.wrapper action="{{ route('admin.enrollNow.store') }}" method="POST">
                <x-form.row>
                    <div class="mb-3 col-6">
                        <x-form.input label="Name" name="name" required />
                    </div>
                    <div class="mb-3 col-6">
                        <x-form.input label="Email" name="email" type="email" required />
                    </div>
                    <div class="mb-3 col-6">
                        <x-form.input label="Phone" name="phone" required />
                    </div>
                    <div class="mb-3 col-6">
                        <label for="test_preparation_id" class="form-label">Test Preparation</label>
                        <select name="test_preparation_id" id="test_preparation_id" class="form-control" required>
                            <option value="">Select Test Preparation</option>
                            @foreach ($testPreparations as $test)
                                <option value="{{ $test->id }}">{{ $test->title }}</option>
                            @endforeach
                        </select>
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
