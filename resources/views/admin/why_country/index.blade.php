@extends('layouts.master')
@section('title', 'Why Countries')
@section('content')
<div class="container-xxl">
    <x-breadcrumb model="Why Country" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-2">
                <a href="{{ route('admin.why_country.create') }}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
            </div>
            <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                <x-table.bulk_delete_btn route-destroy="{{ route('admin.why_country.bulk-delete') }}" />
            </div>
            <div class="table-responsive no-wrap">
                <table class="table" id="datatable">
                    <x-table.header :headers="['SN', 'Country', 'Description', 'Actions']" />
                    <tbody id="tablecontents">
                        @forelse($items as $item)
                        <tr>
                            <td><input type="checkbox" class="select-row" data-id="{{ $item->id }}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <x-table.td>{{ $item->country->name }}</x-table.td>
                            <td>
                                @if(is_array($item->description))
                                    <ul class="mb-0">
                                        @foreach($item->description as $desc)
                                            <li>{{ $desc }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $item->description }}
                                @endif
                            </td>
                            <td style="width:150px">
                                <div class="actions d-flex">
                                    <x-table.view_btn route-view="{{ route('admin.why_country.show', ':id') }}" id="{{ $item->id }}" model="WhyCountry" name="item" />
                                    <x-table.edit_btn route-edit="{{ route('admin.why_country.edit', $item->id) }}" />
                                    <x-table.delete_btn route-destroy="{{ route('admin.why_country.destroy', $item->id) }}" />
                                </div>
                            </td>
                        </tr>
                        <x-table.show_modal id="{{ $item->id }}" model="WhyCountry" />
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No reasons found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $items->links() }}
            </div>
        </div>
    </div>
</div>

@push('custom_js')
    @include('_helpers.modal_script', [
        'name' => 'item',
        'route' => route('admin.why_country.show', ':id'),
    ])
    @include('_helpers.datatable')
    @include('_helpers.swal_delete')
@endpush
@endsection
