@extends('layouts.master')
@section('title', 'BLOGS')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Blog"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <div class="card-body">
                    <div class="mb-4">
                        <x-form.wrapper action="{{ route('admin.categories.store') }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="d-flex gap-3">
                                <x-form.input type="text" label="Blog Category Name" id="name" name="name"
                                    value="{{ old('name') }}" :req="true" :col="8"
                                    placeholder="Blog Category Name" />
                                <div class="mt-3">
                                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i
                                            class='bx bx-save bx-xs'></i>
                                        Save</x-form.button>
                                </div>
                            </div>

                        </x-form.wrapper>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-sm btn-dark mb-2"><i
                                class='bx bx-xs bx-plus'>
                            </i>Create</a>
                    </div>
                    <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                        <x-table.bulk_delete_btn route-destroy="{{ route('admin.blogs.bulk-delete') }}" />
                    </div>
                    <div class="table-responsive no-wrap">
                        <table class="table" id="datatable">
                            <x-table.header :headers="['SN', 'image', 'category', 'title', 'blog date', 'status', 'Actions']" />
                            <tbody id="tablecontents">
                                @forelse ($blogs as $blog)
                                    <tr>
                                        <td><input type="checkbox" class="select-row" data-id="{{ $blog->id }}"></td>
                                        <td>{{ $loop->iteration }}</td>

                                        <x-table.table_image name="{{ $blog->image }}" url="{{ $blog->image_path }}" />

                                        <x-table.td>{{ $blog->category->name ?? '' }}</x-table.td>

                                        <x-table.td>{{ $blog->title }}</x-table.td>

                                        <x-table.td>
                                            {{ \Carbon\Carbon::parse($blog->blog_date)->format('d F Y') }}
                                        </x-table.td>

                                        <x-table.switch :model="$blog" />

                                        <td style="width:150px">
                                            <div class="actions d-flex">
                                                <x-table.view_btn route-view="{{ route('admin.blogs.show', ':id') }}"
                                                    id="{{ $blog->id }}" model="Blog" name="blog" />

                                                <x-table.edit_btn
                                                    route-edit="{{ route('admin.blogs.edit', $blog->id) }}" />

                                                <x-table.delete_btn
                                                    route-destroy="{{ route('admin.blogs.destroy', $blog->id) }}" />
                                            </div>
                                        </td>
                                    </tr>

                                    <x-table.show_modal id="{{ $blog->id }}" model="Blog" />

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
        @include('_helpers.modal_script', ['name' => 'blog', 'route' => route('admin.blogs.show', ':id')])
        @include('_helpers.datatable')
        @include('_helpers.status_change', ['url' => url('admin/status-change-blog')])
        @include('_helpers.swal_delete')
    @endpush
