@extends('layouts.master')
@section('title', 'Edit - ' . $branch->name)
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.branches.index') }}" model="Branch" item="Edit"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.branches.update', $branch->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PATCH')

                    <x-form.row>
                        <x-form.input type="text" label="Name" id="name" name="name" value="{{ $branch->name }}"
                            :req="true" :col="6" />
                        <x-form.input type="text" label="Email" id="email" name="email"
                            value="{{ $branch->email }}" :req="true" :col="6" />
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" label="Phone" id="phone" name="phone"
                            value="{{ $branch->phone }}" :col="4" />
                        <x-form.input type="text" label="Address" id="address" name="contact_address"
                            value="{{ $branch->contact_address }}" :col="4" />
                        <x-form.input type="text" label="Working hours" id="working_hours" name="working_hours"
                            value="{{ $branch->working_hours }}" :col="4" />
                    </x-form.row>

                    <div class="mt-2">
                        <x-form.checkbox label="Status" id="status" name="status" value="1"
                            class="form-check-input" isEditMode="yes" :isChecked="$branch->status ? 'checked' : ''" />
                    </div>
                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                        Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>
@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\BranchUpdateRequest') !!}
@endpush
