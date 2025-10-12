@extends('layouts.master')
@section('title', 'ENQUIRIES')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Enquiry"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                    <x-table.bulk_delete_btn route-destroy="{{ route('admin.enquiries.bulk-delete') }}" />
                </div>
                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['SN', 'Branch', 'study abroad', 'name', 'email', 'address', 'status', 'Actions']" />

                        <tbody id="tablecontents">
                            @forelse ($enquiries as $enquiry)
                                <tr>
                                    <td><input type="checkbox" class="select-row" data-id="{{ $enquiry->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>

                                    <x-table.td>{{ $enquiry->branch->name ?? 'N/A' }}</x-table.td>

                                    <x-table.td>{{ $enquiry->studyabroad->title ?? 'N/A' }}</x-table.td>

                                    <x-table.td>{{ $enquiry->name }}</x-table.td>

                                    <x-table.td>{{ $enquiry->email }}</x-table.td>

                                    <x-table.td>{{ $enquiry->address }}</x-table.td>

                                    <x-table.contact_status_td :status="$enquiry->status" />

                                    <td style="width:150px">
                                        <div class="actions d-flex">
                                            <x-table.view_btn route-view="{{ route('admin.enquiries.show', ':id') }}"
                                                id="{{ $enquiry->id }}" model="Enquiry" name="enquiry" />

                                            <x-table.delete_btn
                                                route-destroy="{{ route('admin.enquiries.destroy', $enquiry->id) }}" />
                                        </div>
                                    </td>
                                </tr>

                                <x-table.show_modal id="{{ $enquiry->id }}" model="Enquiry" />

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
        'name' => 'enquiry',
        'route' => route('admin.enquiries.show', ':id'),
    ])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-enquiry')])
    @include('_helpers.swal_delete')
@endpush
