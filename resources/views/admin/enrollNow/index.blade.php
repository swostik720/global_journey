@extends('layouts.master')
@section('title', 'Enrollments')
@section('content')
<div class="container-xxl">
    <x-breadcrumb model="Enrollment" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('admin.enrollNow.create') }}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'></i>Create</a>
            </div>
            <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                <x-table.bulk_delete_btn route-destroy="{{ route('admin.enrollnow.bulk-delete') }}" />
            </div>
            <div class="table-responsive no-wrap">
                <table class="table" id="datatable">
                    <x-table.header :headers="['SN', 'Branch', 'Name', 'Email', 'Phone', 'Test Preparation', 'Actions']" />
                    <tbody id="tablecontents">
                        @forelse($enrollments as $enroll)
                        <tr>
                            <td><input type="checkbox" class="select-row" data-id="{{ $enroll->id }}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <x-table.td>{{ $enroll->branch->name ?? 'N/A' }}</x-table.td>
                            <x-table.td>{{ $enroll->name }}</x-table.td>
                            <x-table.td>{{ $enroll->email }}</x-table.td>
                            <x-table.td>{{ $enroll->phone }}</x-table.td>
                            <x-table.td>{{ $enroll->testPreparation->title ?? 'N/A' }}</x-table.td>
                            <td style="width:150px">
                                <div class="actions d-flex">
                                    <x-table.view_btn route-view="{{ route('admin.enrollNow.show', ':id') }}" id="{{ $enroll->id }}" model="EnrollNow" name="enroll" />
                                    <x-table.edit_btn route-edit="{{ route('admin.enrollNow.edit', $enroll->id) }}" />
                                    <x-table.delete_btn route-destroy="{{ route('admin.enrollNow.destroy', $enroll->id) }}" />
                                </div>
                            </td>
                        </tr>
                        <x-table.show_modal id="{{ $enroll->id }}" model="EnrollNow" />
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No enrollments found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('custom_js')
@include('_helpers.modal_script', [
    'name' => 'enroll',
    'route' => route('admin.enrollNow.show', ':id'),
])
@include('_helpers.datatable')
@include('_helpers.swal_delete')
@endpush
@endsection
