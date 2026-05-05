@extends('layouts.master')
@section('title', 'BLOG AUTHORS')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Blog Author"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.blog-authors.create') }}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'></i>Create</a>
                </div>
                <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                    <x-table.bulk_delete_btn route-destroy="{{ route('admin.blog-authors.bulk-delete') }}" />
                </div>
                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">
                        <x-table.header :headers="['SN', 'image', 'name', 'title', 'email', 'company', 'articles', 'status', 'Actions']" />
                        <tbody id="tablecontents">
                            @forelse ($authors as $author)
                                <tr>
                                    <td><input type="checkbox" class="select-row" data-id="{{ $author->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <x-table.table_image name="{{ $author->profile_picture }}" url="{{ $author->profile_picture_path }}" />
                                    <x-table.td>{{ $author->name }}</x-table.td>
                                    <x-table.td>{{ $author->title ?? 'N/A' }}</x-table.td>
                                    <x-table.td>{{ $author->email ?? 'N/A' }}</x-table.td>
                                    <x-table.td>{{ $author->company ?? 'N/A' }}</x-table.td>
                                    <x-table.td>{{ $author->blogs_count }}</x-table.td>
                                    <x-table.switch :model="$author" />
                                    <td style="width:150px">
                                        <div class="actions d-flex">
                                            <x-table.view_btn route-view="{{ route('admin.blog-authors.show', ':id') }}" id="{{ $author->id }}" model="Blog Author" name="blog_author" />
                                            <x-table.edit_btn route-edit="{{ route('admin.blog-authors.edit', $author->id) }}" />
                                            <x-table.delete_btn route-destroy="{{ route('admin.blog-authors.destroy', $author->id) }}" />
                                        </div>
                                    </td>
                                </tr>
                                <x-table.show_modal id="{{ $author->id }}" model="Blog Author" />
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
    @include('_helpers.modal_script', ['name' => 'blog_author', 'route' => route('admin.blog-authors.show', ':id')])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-blog-author')])
    @include('_helpers.swal_delete')
@endpush
