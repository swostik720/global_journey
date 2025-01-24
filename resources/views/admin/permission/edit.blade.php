@extends('layouts.master')
@section('name', 'Edit Permission')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.permissions.index')}}" model="Permission" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.permissions.update', $permission->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    <x-form.input type="text" :req="true" label="Name" id="name" name="name" value="{{$permission->name}}"/>
                    <x-form.input type="text" :req="true" label="Slug" id="slug" name="slug" value="{{$permission->slug}}"/>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\PermissionUpdateRequest') !!}
    @include('_helpers.slugify',['name' => 'name'])
@endpush
