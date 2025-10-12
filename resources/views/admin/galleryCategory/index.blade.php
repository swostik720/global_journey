@extends('layouts.master')
@section('title', 'GALLERY CATEGORIES')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Gallery Categories"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.galleryCategory.create') }}" class="btn btn-sm btn-dark">
                        <i class='bx bx-plus bx-xs'></i> Add New Gallery Category
                    </a>
                </div>

                <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                    <x-table.bulk_delete_btn route-destroy="{{ route('admin.galleryCategory.bulk-delete') }}" />
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">
                        <x-table.header :headers="['SN', 'Title', 'Description', 'Actions']" />

                        <tbody id="tablecontents">
                            @forelse ($galleryCategories as $category)
                                <tr>
                                    <td><input type="checkbox" class="select-row" data-id="{{ $category->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <x-table.td>{{ $category->title }}</x-table.td>
                                    <x-table.td>{{ $category->description }}</x-table.td>

                                    <td style="width:150px">
                                        <div class="actions d-flex">
                                            {{-- Replace x-table.view_btn with explicit button --}}
                                            <span type="button"
                                                data-galleryCategory-id="{{ $category->id }}" data-bs-toggle="modal"
                                                data-bs-target="#galleryCategoryModal{{ $category->id }}" title="View">
                                                <i class="bx bx-show bx-xs"></i>
                                        </span>
                                            <x-table.edit_btn
                                                route-edit="{{ route('admin.galleryCategory.edit', $category->id) }}" />

                                            <x-table.delete_btn
                                                route-destroy="{{ route('admin.galleryCategory.destroy', $category->id) }}" />
                                        </div>
                                    </td>
                                </tr>

                                {{-- Modal --}}
                                <div class="modal fade" id="galleryCategoryModal{{ $category->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Gallery Category Details</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{-- AJAX content will be loaded here --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    {!! JsValidator::formRequest('App\Http\Requests\GalleryCategoryRequest') !!}
    <script>
        $(document).on('show.bs.modal', '.modal', function(event) {
            let button = $(event.relatedTarget);
            let id = button.data('gallerycategory-id'); // lowercase for jQuery
            let modal = $(this);

            let url = "{{ route('admin.galleryCategory.show', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    modal.find('.modal-body').html(response);
                },
                error: function() {
                    modal.find('.modal-body').html('<p class="text-danger">Unable to load data.</p>');
                }
            });
        });
    </script>
    @include('_helpers.datatable')
    @include('_helpers.swal_delete')
@endpush
