@extends('layouts.master')
@section('title', 'TEAMS')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Teams"></x-breadcrumb>
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.teams.create') }}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'>
                        </i>Create</a>
                </div>
                {{-- <div class="d-flex justify-content-start mb-3" id="bulk-delete">
                    <x-table.bulk_delete_btn route-destroy="{{ route('admin.teams.bulk-delete') }}" />
                </div> --}}
                <div class="table-responsive no-wrap">
                    <table class="table" id="datatable">
                        <x-table.header :headers="['name', 'image', 'responsibility', 'rank', 'status', 'Actions']" />
                        <tbody id="tablecontents"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    @include('_helpers.modal_script', ['name' => 'team', 'route' => route('admin.teams.show', ':id')])
    @include('_helpers.yajra', ['url' => route('admin.teams.index'), 'columns' => $columns])
    @include('_helpers.status_change', ['url' => url('admin/status-change-team')])
    @include('_helpers.swal_delete')

    <script type="text/javascript">
        $(function() {
            $("#tablecontents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {
                var order = [];
                $('tr.row1').each(function(index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('admin.teams.reorder') }}",
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            console.log(response);
                        } else {
                            console.log(response);
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }
        });
    </script>
@endpush
