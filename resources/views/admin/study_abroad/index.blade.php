@extends('layouts.master')
@section('title', 'STUDY ABROADS')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Study Abroad"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <x-form.wrapper action="{{ route('admin.countries.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="d-flex gap-3">
                            <x-form.input type="text" label="Country Name" id="name" name="name"
                                value="{{ old('name') }}" :req="true" :col="8"
                                placeholder="Country Name" />
                            <div class="mt-3">
                                <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                                    Save</x-form.button>
                            </div>
                        </div>
                    </x-form.wrapper>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.study-abroads.create') }}" class="btn btn-sm btn-dark mb-2"><i
                            class='bx bx-xs bx-plus'> </i>Create Study Abroad</a>
                </div>
                <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                    <x-table.bulk_delete_btn route-destroy="{{ route('admin.study-abroads.bulk-delete') }}" />
                </div>

                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">

                        <x-table.header :headers="['SN', 'image', 'title', 'country', 'status', 'Actions']" />

                        <tbody id="tablecontents">
                            @forelse ($study_abroads as $study_abroad)
                                <tr>
                                    <td><input type="checkbox" class="select-row" data-id="{{ $study_abroad->id }}"></td>
                                    <td>{{ $loop->iteration }}</td>

                                    <x-table.table_image name="{{ $study_abroad->image }}"
                                        url="{{ $study_abroad->image_path }}" />
                                    <x-table.td>{{ $study_abroad->title }}</x-table.td>

                                    <x-table.td>{{ $study_abroad->country->name ?? 'N/A' }}</x-table.td>

                                    <x-table.switch :model="$study_abroad" />

                                    <td style="width:150px">
                                        <div class="actions d-flex">
                                            <x-table.view_btn route-view="{{ route('admin.study-abroads.show', ':id') }}"
                                                id="{{ $study_abroad->id }}" model="StudyAbroad" name="study_abroad" />

                                            <x-table.edit_btn
                                                route-edit="{{ route('admin.study-abroads.edit', $study_abroad->id) }}" />

                                            <x-table.delete_btn
                                                route-destroy="{{ route('admin.study-abroads.destroy', $study_abroad->id) }}" />
                                        </div>
                                    </td>
                                </tr>

                                <x-table.show_modal id="{{ $study_abroad->id }}" model="StudyAbroad" />

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
        'name' => 'study_abroad',
        'route' => route('admin.study-abroads.show', ':id'),
    ])
    @include('_helpers.datatable')
    @include('_helpers.status_change', ['url' => url('admin/status-change-study_abroad')])
    @include('_helpers.swal_delete')
@endpush
