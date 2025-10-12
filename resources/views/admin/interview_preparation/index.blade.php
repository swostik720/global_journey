@extends('layouts.master')
@section('title', 'INTERVIEW PREPARATIONS')

@section('content')
<div class="container-xxl">
    <x-breadcrumb model="Interview Preparation" />

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.interview_preparation.create') }}" class="btn btn-sm btn-dark mb-2">
                    <i class='bx bx-xs bx-plus'></i> Create
                </a>
            </div>

            <div class="table-responsive no-wrap">
                <table class="table" id="datatable">
                    <x-table.header :headers="['SN', 'Image', 'Title', 'Status', 'Actions']" />
                    <tbody id="tablecontents">
                        @forelse ($items as $item)
                            <tr>
                                <td><input type="checkbox" class="select-row" data-id="{{ $item->id }}"></td>
                                <td>{{ $loop->iteration }}</td>
                                <x-table.table_image name="{{ $item->image }}" url="{{ $item->image_path }}" />
                                <x-table.td>{{ $item->title }}</x-table.td>
                                <x-table.switch :model="$item" />

                                <td style="width:150px">
                                    <div class="actions d-flex">
                                        <x-table.view_btn route-view="{{ route('admin.interview_preparation.show', ':id') }}" id="{{ $item->id }}" model="InterviewPreparation" name="item" />
                                        <x-table.edit_btn route-edit="{{ route('admin.interview_preparation.edit', $item->id) }}" />
                                        <x-table.delete_btn route-destroy="{{ route('admin.interview_preparation.destroy', $item->id) }}" />
                                    </div>
                                </td>
                            </tr>

                            <x-table.show_modal id="{{ $item->id }}" model="InterviewPreparation" />
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
    @include('_helpers.modal_script', ['name' => 'item', 'route' => route('admin.interview_preparation.show', ':id')])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-interview_preparation')])
    @include('_helpers.swal_delete')
@endpush
