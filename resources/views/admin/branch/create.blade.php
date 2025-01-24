@extends('layouts.master')
@section('title', 'Create Branch')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.branches.index') }}" model="Branch" item="Create"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.branches.store') }}" method="POST" enctype="multipart/form-data">

                    <x-form.row>
                        <x-form.input type="text" label="Name" id="name" name="name" value="{{ old('name') }}"
                            :req="true" :col="6" />
                        <x-form.input type="text" label="Email" id="email" name="email"
                            value="{{ old('email') }}" :req="true" :col="6" />
                    </x-form.row>

                    <x-form.row>
                        <x-form.input type="text" label="Phone" id="phone" name="phone"
                            value="{{ old('phone') }}" :col="4" />
                        <x-form.input type="text" label="Address" id="address" name="contact_address"
                            value="{{ old('contact_address') }}" :col="4" />
                        <x-form.input type="text" label="Working hours" id="working_hours" name="working_hours"
                            value="{{ old('working_hours') }}" :col="4" />
                    </x-form.row>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                        Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\BranchStoreRequest') !!}
@endpush
