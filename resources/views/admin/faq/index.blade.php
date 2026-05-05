@extends('layouts.master')
@section('title', 'HOME FAQS')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Home FAQs"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.faqs.create') }}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create FAQ</a>
                </div>
                <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                    <x-table.bulk_delete_btn route-destroy="{{ route('admin.faqs.bulk-delete') }}" />
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">
                        <x-table.header :headers="['SN', 'question', 'sort order', 'status', 'Actions']" />

                        <tbody id="tablecontents">
                            @forelse ($faqs as $faq)
                                <tr>
                                    <td><input type="checkbox" class="select-row" data-id="{{ $faq->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <x-table.td>{{ $faq->question }}</x-table.td>
                                    <x-table.td>{{ $faq->sort_order }}</x-table.td>
                                    <x-table.switch :model="$faq" />

                                    <td style="width:150px">
                                        <div class="actions d-flex">
                                            <x-table.view_btn route-view="{{ route('admin.faqs.show', ':id') }}" id="{{ $faq->id }}" model="Faq" name="faq" />
                                            <x-table.edit_btn route-edit="{{ route('admin.faqs.edit', $faq->id) }}" />
                                            <x-table.delete_btn route-destroy="{{ route('admin.faqs.destroy', $faq->id) }}" />
                                        </div>
                                    </td>
                                </tr>

                                <x-table.show_modal id="{{ $faq->id }}" model="Faq" />
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
        'name' => 'faq',
        'route' => route('admin.faqs.show', ':id'),
    ])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-faq')])
    @include('_helpers.swal_delete')
@endpush
