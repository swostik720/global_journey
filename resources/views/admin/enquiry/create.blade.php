@extends('layouts.master')

@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.enquiries.index')}}" model="Enquiry" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.enquiries.store')}}" method="POST" enctype="multipart/form-data">
                        <x-form.input type="text" label="Studyabroad_id" id="studyabroad_id" name="studyabroad_id" value="{{ old('studyabroad_id') }}"/>
<x-form.input type="text" label="Name" id="name" name="name" value="{{ old('name') }}"/>
<x-form.input type="text" label="Email" id="email" name="email" value="{{ old('email') }}"/>
<x-form.input type="text" label="Address" id="address" name="address" value="{{ old('address') }}"/>
<x-form.input type="text" label="Phone" id="phone" name="phone" value="{{ old('phone') }}"/>
<x-form.textarea label="Enquiry_message" id="enquiry_message" name="enquiry_message" value="{{ old('enquiry_message') }}" rows="5" cols="5" />
<x-form.input type="text" label="Status" id="status" name="status" value="{{ old('status') }}"/>

                        <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\EnquiryStoreRequest') !!}
    
@endpush
