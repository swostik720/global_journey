@extends('layouts.master')
@section('title', 'SUBSCRIBES')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Subscribe"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">
                        <x-table.header :headers="['email', 'Actions']" />
                        <tbody id="tablecontents">
                            @forelse ($subscribes as $subscribe)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <x-table.td>{{ $subscribe->email }}</x-table.td>
                                    <td style="width:150px">
                                        <div class="actions d-flex">
                                            <x-table.view_btn route-view="{{ route('admin.subscribes.show', ':id') }}"
                                                id="{{ $subscribe->id }}" model="Subscribe" name="subscribe" />
                                            <x-table.delete_btn
                                                route-destroy="{{ route('admin.subscribes.destroy', $subscribe->id) }}" />
                                        </div>
                                    </td>
                                </tr>

                                <x-table.show_modal id="{{ $subscribe->id }}" model="Subscribe" />

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
        'name' => 'subscribe',
        'route' => route('admin.subscribes.show', ':id'),
    ])
    @include('_helpers.datatable')

    @include('_helpers.swal_delete')
@endpush
