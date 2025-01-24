@extends('layouts.master')
@section('title', 'TEST PREPARATIONS')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Test Preparation"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.test-preparations.create') }}" class="btn btn-sm btn-dark mb-2"><i
                            class='bx bx-xs bx-plus'> </i>Create</a>
                </div>
                <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                    <x-table.bulk_delete_btn route-destroy="{{ route('admin.test-preparations.bulk-delete') }}" />
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['SN', 'image', 'title', 'status', 'Actions']" />

                        <tbody id="tablecontents">
                            @forelse ($test_preparations as $test_preparation)
                                <tr>
                                    <td><input type="checkbox" class="select-row" data-id="{{ $test_preparation->id }}">
                                    </td>
                                    <td>{{ $loop->iteration }}</td>

                                    <x-table.table_image name="{{ $test_preparation->image }}"
                                        url="{{ $test_preparation->image_path }}" />
                                    <x-table.td>{{ $test_preparation->title }}</x-table.td>

                                    <x-table.switch :model="$test_preparation" />

                                    <td style="width:150px">
                                        <div class="actions d-flex">
                                            <x-table.view_btn
                                                route-view="{{ route('admin.test-preparations.show', ':id') }}"
                                                id="{{ $test_preparation->id }}" model="TestPreparation"
                                                name="test_preparation" />

                                            <x-table.edit_btn
                                                route-edit="{{ route('admin.test-preparations.edit', $test_preparation->id) }}" />

                                            <x-table.delete_btn
                                                route-destroy="{{ route('admin.test-preparations.destroy', $test_preparation->id) }}" />
                                        </div>
                                    </td>
                                </tr>

                                <x-table.show_modal id="{{ $test_preparation->id }}" model="TestPreparation" />

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
    @include('_helpers.modal_script', [
        'name' => 'test_preparation',
        'route' => route('admin.test-preparations.show', ':id'),
    ])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-test_preparation')])
    @include('_helpers.swal_delete')
@endpush
