@extends('layouts.master')
@section('title', 'BRANCHES')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Branch"></x-breadcrumb>
        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.branches.create') }}" class="btn btn-sm btn-dark mb-2"><i
                            class='bx bx-xs bx-plus'> </i>Create</a>
                </div>

                <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                    <x-table.bulk_delete_btn route-destroy="{{ route('admin.branches.bulk-delete') }}" />
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['SN', 'name', 'email', 'phone', 'address', 'working hours', 'status', 'Actions']" />

                        <tbody id="tablecontents">
                            @forelse ($branches as $branch)
                                <tr>
                                    <td><input type="checkbox" class="select-row" data-id="{{ $branch->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>

                                    <x-table.td>{{ $branch->name }}</x-table.td>

                                    <x-table.td>{{ $branch->email ?? 'N/A' }}</x-table.td>

                                    <x-table.td>{{ $branch->phone ?? 'N/A' }}</x-table.td>

                                    <x-table.td>{{ $branch->contact_address ?? 'N/A' }}</x-table.td>

                                    <x-table.td>{{ $branch->working_hours ?? 'N/A' }}</x-table.td>

                                    <x-table.switch :model="$branch" />

                                    <td style="width:150px">
                                        <div class="actions d-flex">
                                            <x-table.view_btn route-view="{{ route('admin.branches.show', ':id') }}"
                                                id="{{ $branch->id }}" model="Branch" name="branch" />

                                            <x-table.edit_btn
                                                route-edit="{{ route('admin.branches.edit', $branch->id) }}" />

                                            <x-table.delete_btn
                                                route-destroy="{{ route('admin.branches.destroy', $branch->id) }}" />
                                        </div>
                                    </td>
                                </tr>

                                <x-table.show_modal id="{{ $branch->id }}" model="Branch" />

                            @empty
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    @include('_helpers.modal_script', ['name' => 'branch', 'route' => route('admin.branches.show', ':id')])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-branch')])
    @include('_helpers.swal_delete')
@endpush
