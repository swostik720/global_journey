@extends('layouts.master')

@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.contacts.index')}}" model="Contact" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.contacts.update', $contact->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                        <x-form.input type="text" label="Name" id="name" name="name" value="{{$contact->name}}"/>
<x-form.input type="text" label="Email" id="email" name="email" value="{{$contact->email}}"/>
<x-form.input type="text" label="Phone" id="phone" name="phone" value="{{$contact->phone}}"/>
<x-form.input type="text" label="Contact_message" id="contact_message" name="contact_message" value="{{$contact->contact_message}}"/>
<x-form.checkbox label="Status" id="status" name="status" value="1" class="form-check-input" isEditMode="yes" :isChecked="$contact->status ? 'checked' : ''"/>

                        <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\ContactUpdateRequest') !!}
    
@endpush
