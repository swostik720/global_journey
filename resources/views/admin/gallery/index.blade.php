@extends('layouts.master')
@section('title', 'GALLERIES')
@section('content')
<div class="container-xxl">
    <x-breadcrumb model="Galleries"></x-breadcrumb>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-sm btn-dark">
                    <i class='bx bx-plus bx-xs'></i> Add New Gallery
                </a>
            </div>

            <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                <x-table.bulk_delete_btn route-destroy="{{ route('admin.gallery.bulk-delete') }}" />
            </div>

            <div class="table-responsive no-wrap">
                <table class="table" id="datatable">
                    <x-table.header :headers="['SN', 'Title', 'Category', 'Images', 'Actions']" />
                    <tbody>
                        @forelse ($galleries as $gallery)
                        <tr>
                            <td><input type="checkbox" class="select-row" data-id="{{ $gallery->id }}"></td>
                            <td>{{ $loop->iteration }}</td>
                            <x-table.td>{{ $gallery->title }}</x-table.td>
                            <x-table.td>{{ $gallery->galleryCategory->title ?? '-' }}</x-table.td>
                            <x-table.td>
                                @if($gallery->images)
                                    @foreach($gallery->images as $img)
                                        <img src="{{ asset('uploaded-images/gallery/' . $img) }}" alt="img" width="50" class="me-1 mb-1">
                                    @endforeach
                                @endif
                            </x-table.td>
                            <td style="width:150px">
                                <div class="actions d-flex">
                                    <x-table.view_btn
                                        route-view="{{ route('admin.gallery.show', ':id') }}"
                                        id="{{ $gallery->id }}"
                                        model="Gallery"
                                        name="gallery" />
                                    <x-table.edit_btn
                                        route-edit="{{ route('admin.gallery.edit', $gallery->id) }}" />
                                    <x-table.delete_btn
                                        route-destroy="{{ route('admin.gallery.destroy', $gallery->id) }}" />
                                </div>
                            </td>
                        </tr>
                        <x-table.show_modal id="{{ $gallery->id }}" model="Gallery" />
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No galleries found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\GalleryRequest') !!}
    @include('_helpers.modal_script', [
        'name' => 'gallery',
        'route' => route('admin.gallery.show', ':id'),
    ])
    @include('_helpers.datatable')
    @include('_helpers.swal_delete')
@endpush
