@extends('layouts.master')
@section('title', 'Edit Enrollment')
@section('content')
<div class="container-xxl">
    <x-breadcrumb listRoute="{{ route('admin.enrollNow.index') }}" model="Enrollment" item="Edit" />
    <div class="card">
        <div class="card-body">
            <x-form.wrapper action="{{ route('admin.enrollNow.update', $enrollNow->id) }}" method="POST">
                @method('PUT')
                @csrf
                <x-form.row>
                    <div class="mb-3 col-6">
                        <x-form.input label="Name" name="name" value="{{ old('name', $enrollNow->name) }}" required />
                    </div>
                    <div class="mb-3 col-6">
                        <x-form.input label="Email" name="email" type="email" value="{{ old('email', $enrollNow->email) }}" required />
                    </div>
                    <div class="mb-3 col-6">
                        <x-form.input label="Phone" name="phone" value="{{ old('phone', $enrollNow->phone) }}" required />
                    </div>
                    <div class="mb-3 col-6">
                        <label for="test_preparation_id" class="form-label">Test Preparation</label>
                        <select name="test_preparation_id" id="test_preparation_id" class="form-control" required>
                            @foreach ($testPreparations as $test)
                                <option value="{{ $test->id }}" @if($enrollNow->test_preparation_id == $test->id) selected @endif>
                                    {{ $test->title }}
                                </option>
                            @endforeach
                        </select>
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
