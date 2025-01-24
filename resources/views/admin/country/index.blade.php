@extends('layouts.master')
@section('title', 'COUNTRIES')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Country"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <x-form.wrapper action="{{ route('admin.countries.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="d-flex gap-3">
                            <x-form.input type="text" label="Country Name" id="name" name="name"
                                value="{{ old('name') }}" :req="true" :col="8" />
                            <div class="mt-3">
                                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                                    Save</x-form.button>
                            </div>
                        </div>
                    </x-form.wrapper>
                </div>

                <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                    <x-table.bulk_delete_btn route-destroy="{{ route('admin.countries.bulk-delete') }}" />
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['SN', 'name', 'status', 'Actions']" />

                        <tbody id="tablecontents">
                            @forelse ($countries as $country)
                                <tr>
                                    <td><input type="checkbox" class="select-row" data-id="{{ $country->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>

                                    <x-table.td>{{ $country->name }}</x-table.td>

                                    <x-table.switch :model="$country" />

                                    <td style="width:150px">
                                        <div class="actions d-flex">
                                            <x-table.view_btn route-view="{{ route('admin.countries.show', ':id') }}"
                                                id="{{ $country->id }}" model="Country" name="country" />

                                            <x-table.edit_btn
                                                route-edit="{{ route('admin.countries.edit', $country->id) }}" />

                                            <x-table.delete_btn
                                                route-destroy="{{ route('admin.countries.destroy', $country->id) }}" />
                                        </div>
                                    </td>
                                </tr>

                                <x-table.show_modal id="{{ $country->id }}" model="Country" />

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
        'name' => 'country',
        'route' => route('admin.countries.show', ':id'),
    ])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-country')])
    @include('_helpers.swal_delete')
@endpush
