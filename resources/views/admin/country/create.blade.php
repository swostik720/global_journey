@extends('layouts.master')

@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.countries.index')}}" model="Country" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.countries.store')}}" method="POST" enctype="multipart/form-data">
                        <x-form.input type="text" label="Name" id="name" name="name" value="{{ old('name') }}"/>
<x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="true"/>

                        <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CountryStoreRequest') !!}
    
@endpush
