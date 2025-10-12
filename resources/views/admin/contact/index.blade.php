@extends('layouts.master')
@section('title', 'CONTACT REQUESTS')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Contact Request"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                    <x-table.bulk_delete_btn route-destroy="{{ route('admin.contacts.bulk-delete') }}" />
                </div>
                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">
                        <x-table.header :headers="['SN','Branch', 'Name', 'Email', 'Phone', 'Status', 'Actions']" />
                        <tbody id="tablecontents">
                            @forelse ($contacts as $contact)
                                <tr>
                                    <td><input type="checkbox" class="select-row" data-id="{{ $contact->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <x-table.td>{{ $contact->branch?->name ?? 'No branch selected' }}</x-table.td>
                                    <x-table.td>{{ $contact->name }}</x-table.td>
                                    <x-table.td>{{ $contact->email }}</x-table.td>
                                    <x-table.td>{{ $contact->phone }}</x-table.td>
                                    <x-table.contact_status_td :status="$contact->status" />
                                    <td style="width:150px">
                                        <div class="actions d-flex">
                                            <x-table.view_btn route-view="{{ route('admin.contacts.show', ':id') }}"
                                                id="{{ $contact->id }}" model="Contact" name="contact" />
                                            <x-table.delete_btn
                                                route-destroy="{{ route('admin.contacts.destroy', $contact->id) }}" />
                                        </div>
                                    </td>
                                </tr>
                                <x-table.show_modal id="{{ $contact->id }}" model="Contact" />
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
        'name' => 'contact',
        'route' => route('admin.contacts.show', ':id'),
    ])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-contact')])
    @include('_helpers.swal_delete')
@endpush
