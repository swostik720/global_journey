@extends('layouts.master')
@section('title', 'Document Checklists')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Document Checklist" />

        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end mb-2">
                    <a href="{{ route('admin.document_checklist.create') }}" class="btn btn-sm btn-dark mb-2">
                        <i class='bx bx-xs bx-plus'></i>
                        <span class="fw-semibold" style="font-size: 14px;">Create</span>
                    </a>
                </div>

                <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                    <x-table.bulk_delete_btn route-destroy="{{ route('admin.document_checklist.bulk-delete') }}" />
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable" style="font-size: 14px;">
                        <x-table.header :headers="['SN', 'Country', 'Documents', 'PDF', 'Actions']" />
                        <tbody id="tablecontents">
                            @forelse($items as $item)
                                <tr>
                                    <td><input type="checkbox" class="select-row" data-id="{{ $item->id }}"></td>
                                    <td style="font-size: 13px;">{{ $loop->iteration }}</td>
                                    <x-table.td><span style="font-size: 14px;">{{ $item->country->name }}</span></x-table.td>
                                    <td>
                                        <ul class="mb-0 ps-3 admin-doc-list">
                                            @foreach ($item->documents as $doc)
                                                <li class="mb-2">
                                                    @if (is_array($doc))
                                                        <p class="fw-semibold text-dark mb-1" style="font-size: 15px;">
                                                            {{ $doc['name'] }}
                                                        </p>
                                                        @if (!empty($doc['description']))
                                                            <ul class="text-muted mb-0 ps-3 admin-doc-sublist" style="font-size: 13px;">
                                                                @foreach (preg_split('/\r\n|\r|\n/', trim($doc['description'])) as $line)
                                                                    @if (!empty(trim($line)))
                                                                        <li>{{ preg_replace('/^[-*•\s]+/u', '', trim($line)) }}</li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    @else
                                                        <p class="fw-semibold text-dark mb-0" style="font-size: 14px;">
                                                            {{ $doc }}
                                                        </p>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        @if (!empty($item->pdf_path))
                                            <a href="{{ asset($item->pdf_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                View PDF
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td style="width:150px">
                                        <div class="actions d-flex" style="gap: 4px;">
                                            <x-table.view_btn
                                                route-view="{{ route('admin.document_checklist.show', ':id') }}"
                                                id="{{ $item->id }}" model="DocumentChecklist" name="item" />
                                            <x-table.edit_btn
                                                route-edit="{{ route('admin.document_checklist.edit', $item->id) }}" />
                                            <x-table.delete_btn
                                                route-destroy="{{ route('admin.document_checklist.destroy', $item->id) }}" />
                                        </div>
                                    </td>
                                </tr>
                                <x-table.show_modal id="{{ $item->id }}" model="DocumentChecklist" />
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted" style="font-size: 14px;">
                                        No document checklists found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3" style="font-size: 13px;">
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('custom_js')
        @include('_helpers.modal_script', [
            'name' => 'item',
            'route' => route('admin.document_checklist.show', ':id'),
        ])
        @include('_helpers.datatable')
        @include('_helpers.swal_delete')
    @endpush

    <style>
        .admin-doc-list,
        .admin-doc-sublist {
            list-style: disc !important;
            padding-left: 20px !important;
        }

        .admin-doc-list li,
        .admin-doc-sublist li {
            display: list-item !important;
            list-style: disc !important;
        }
    </style>
@endsection
