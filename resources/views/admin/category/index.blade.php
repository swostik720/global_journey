@extends('layouts.master')
@section('title', 'BLOG CATEGORIES')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Blog Categories"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <x-form.wrapper action="{{ route('admin.categories.store') }}" method="POST"
                        enctype="multipart/form-data">
                        <div class="d-flex gap-3">
                            <x-form.input type="text" label="Blog Category Name" id="name" name="name"
                                value="{{ old('name') }}" :req="true" :col="8" />
                            <div class="mt-3">
                                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                                    Save</x-form.button>
                            </div>
                        </div>

                    </x-form.wrapper>
                </div>

                <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                    <x-table.bulk_delete_btn route-destroy="{{ route('admin.categories.bulk-delete') }}" />
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['SN', 'name', 'status', 'Actions']" />

                        <tbody id="tablecontents">
                            @forelse ($categories as $category)
                                <tr>
                                    <td><input type="checkbox" class="select-row" data-id="{{ $category->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>

                                    <x-table.td>{{ $category->name }}</x-table.td>

                                    <x-table.switch :model="$category" />

                                    <td style="width:150px">
                                        <div class="actions d-flex">
                                            <x-table.view_btn route-view="{{ route('admin.categories.show', ':id') }}"
                                                id="{{ $category->id }}" model="Category" name="category" />

                                            <x-table.edit_btn
                                                route-edit="{{ route('admin.categories.edit', $category->id) }}" />

                                            <x-table.delete_btn
                                                route-destroy="{{ route('admin.categories.destroy', $category->id) }}" />
                                        </div>
                                    </td>
                                </tr>

                                <x-table.show_modal id="{{ $category->id }}" model="Category" />

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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\CategoryStoreRequest') !!}

    @include('_helpers.modal_script', [
        'name' => 'category',
        'route' => route('admin.categories.show', ':id'),
    ])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-category')])
    @include('_helpers.swal_delete')
@endpush
