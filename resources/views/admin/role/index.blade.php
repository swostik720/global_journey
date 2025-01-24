@extends('layouts.master')
@section('name', 'Permission')
@section('content')

    <div class="container-xxl">

        <x-breadcrumb model="Role"></x-breadcrumb>

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-end">
                    @can('create',\App\Models\Role::class)
                        <a href="{{route('admin.roles.create')}}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
                    @endcan
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['name','slug', 'Actions']"/>

                        <tbody id="tablecontents"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    @include('_helpers.modal_script',['name' => 'role', 'route' => route('admin.roles.show', ':id')])
    @include('_helpers.yajra',['url' => route("admin.roles.index"), 'columns' => $columns])
    @include('_helpers.swal_delete')
@endpush
