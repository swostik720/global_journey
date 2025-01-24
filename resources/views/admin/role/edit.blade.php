@extends('layouts.master')
@section('name', 'Edit Role')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.roles.index')}}" model="Role" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.roles.update', $role->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    <x-form.input type="text" :req="true" label="Name" id="name" name="name" value="{{$role->name}}"/>
                    <x-form.input type="text" :req="true" label="Slug" id="slug" name="slug" value="{{$role->slug}}"/>

                    <div class="form-group mt-2 col-md-12">
                        <label class="required" for="permissions">Add Permissions</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-sm btn-primary select-all" style="border-radius: 0">Select All</span>
                            <span class="btn btn-sm btn-danger deselect-all" style="border-radius: 0">Remove All</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple>
                            @foreach($permissions as $permission)
                                <option
                                    value="{{ $permission->id }}" {{ in_array($permission->id, old('permissions', [])) || $role->permissions->contains($permission->id)? 'selected' : '' }}>{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('permissions'))
                            <span class="text-danger small">{{ $errors->first('permissions') }}</span>
                        @endif
                    </div>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\RoleUpdateRequest') !!}
    @include('_helpers.slugify',['name' => 'name'])
    @include('_helpers.role_selector')
@endpush
