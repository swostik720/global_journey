@extends('layouts.master')
@section('title', 'Colleges & Universities')

@section('content')
<div class="container-xxl">
    <x-breadcrumb model="College & University" />

    <div class="card">
        <div class="card-body">
            {{-- Create Button --}}
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('admin.college_and_university.create') }}" class="btn btn-sm btn-dark mb-2">
                    <i class='bx bx-xs bx-plus'></i> Create
                </a>
            </div>

            {{-- Bulk Delete --}}
            <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                <x-table.bulk_delete_btn route-destroy="{{ route('admin.college_and_university.bulk-delete') }}" />
            </div>

            {{-- Table --}}
            <div class="table-responsive no-wrap">
                <table class="table" id="datatable">
                    <x-table.header :headers="['SN', 'Country', 'Name', 'Description', 'Link', 'Actions']" />
                    <tbody id="tablecontents">
                        @forelse($items as $item)
                        <tr>
                            <td><input type="checkbox" class="select-row" data-id="{{ $item->id }}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <x-table.td>{{ $item->country->name ?? 'N/A' }}</x-table.td>
                            <x-table.td>{{ $item->name }}</x-table.td>
                            <x-table.td>{{ Str::limit($item->description, 80) }}</x-table.td>

                            {{-- Link --}}
                            <td>
                                @if($item->link)
                                    <a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td style="width:180px">
                                <div class="actions d-flex gap-1">
                                    {{-- View --}}
                                    <x-table.view_btn
                                        route-view="{{ route('admin.college_and_university.show', ':id') }}"
                                        id="{{ $item->id }}"
                                        model="CollegeAndUniversity"
                                        name="item"
                                    />

                                    {{-- Edit --}}
                                    <x-table.edit_btn route-edit="{{ route('admin.college_and_university.edit', $item->id) }}" />

                                    {{-- Delete --}}
                                    <x-table.delete_btn route-destroy="{{ route('admin.college_and_university.destroy', $item->id) }}" />
                                </div>
                            </td>
                        </tr>

                        {{-- Modal for each item --}}
                        <x-table.show_modal id="{{ $item->id }}" model="CollegeAndUniversity" />
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No colleges or universities found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                {{ $items->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
    {{-- Modal Script --}}
    @include('_helpers.modal_script', [
        'name' => 'item',
        'route' => route('admin.college_and_university.show', ':id'),
    ])

    {{-- Datatable --}}
    @include('_helpers.datatable')

    {{-- SweetAlert Delete --}}
    @include('_helpers.swal_delete')
@endpush
