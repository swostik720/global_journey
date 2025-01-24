@extends('layouts.master')
@section('name', 'Edit User')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{ route('admin.users.index') }}" model="User" item="Edit"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{ route('admin.users.update', $user->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PATCH')

                    <x-form.input type="file" label="Image" id="image" name="image" alt="image" accept="image/*"
                        onchange="previewThumb(this,'image-thumb')" />
                    <x-form.preview id="image-thumb" . url="{{ $user->image_path }}" />

                    <x-form.row>
                        <x-form.input type="text" :req="true" col="6" label="Name" id="name"
                            name="name" value="{{ $user->name }}" />
                        <x-form.input type="text" :req="true" col="6" label="Email" id="email"
                            name="email" value="{{ $user->email }}" />
                    </x-form.row>

                    <x-form.password label="Current Password" id="current_password" name="current_password"
                        value="{{ old('current_password') }}" />

                    <x-form.row>
                        <x-form.password col="6" label="New Password" id="new_password" name="new_password" />
                        <x-form.password col="6" label="Confirm Password" id="confirm_password"
                            name="confirm_password" />
                    </x-form.row>

                    <x-form.select name="role_id" :options="$roles" label="Role" :model="$user->role_id"></x-form.select>
                    <br>

                    <div id="permissions_box">
                        <label for="roles">Select Permissions</label>
                        <div id="permissions_checkbox_list" class="d-flex flex-wrap"></div>
                        @error('permissions')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    @if (!empty($userPermissions) && !is_null($rolePermissions))
                        <div id="user_permissions_box">
                            <label for="roles">Select Permissions</label>
                            <div id="user_permissions_checkbox_list" class="d-flex flex-wrap">
                                @foreach ($rolePermissions as $permission)
                                    <div class="form-check mx-1 my-2">
                                        <input class="form-check-input" style="margin-right:5px" type="checkbox"
                                            name="permissions[]" id="{{ $permission->id }}" value="{{ $permission->id }}"
                                            {{ in_array($permission->id, $userPermissions, true) ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('permissions')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    @endif
                    <br>
                    <x-form.enum-select label="Status" :req="true" col="3" :model="$user->user_status" :options="\App\Enums\UserStatus::cases()"
                        name="user_status"></x-form.enum-select>

                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                        Save</x-form.button>
                </x-form.wrapper>
            </div>
        </div>
    </div>

@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UserUpdateRequest') !!}
    @include('_helpers.image_preview', ['name' => 'image'])
    <script>
        $(document).ready(function() {
            let permissions_box = $('#permissions_box');
            let permissions_checkbox_list = $('#permissions_checkbox_list');
            let user_permissions_box = $('#user_permissions_box');

            permissions_box.hide(); // hide all boxes


            $('#role_id').on('change', function() {
                let role_id = $(this).find(':selected').val();

                permissions_checkbox_list.empty();
                user_permissions_box.empty();

                $.ajax({
                    url: "{{ url('admin/get-role-based-permissions') }}",
                    method: 'get',
                    dataType: 'json',
                    data: {
                        role_id: role_id,
                    }
                }).done(function(data) {

                    permissions_box.show();

                    $.each(data, function(index, element) {
                        $(permissions_checkbox_list).append(
                            '<div class="form-check mx-1 my-2">' +
                            '<input class="form-check-input" style="margin-right:5px" type="checkbox" checked name="permissions[]" id="' +
                            element.name + '" value="' + element.id + '">' +
                            '<label class="form-check-label" for="' + element.name +
                            '">' + element.name + '</label>' +
                            '</div>'
                        );

                    });
                });
            });
        });
    </script>
@endpush
