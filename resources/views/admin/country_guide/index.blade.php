@extends('layouts.master')
@section('title', 'Country Guide')
@section('content')
<div class="container-xxl">
	<x-breadcrumb model="Country Guide" />
	<div class="card">
		<div class="card-body">
			<div class="d-flex justify-content-end mb-2">
				<a href="{{ route('admin.country_guide.create') }}" class="btn btn-sm btn-dark mb-2"><i class='bx bx-xs bx-plus'> </i>Create</a>
			</div>
			<div class="d-flex justify-content-start mb-3" id="bulk-delete">
				<x-table.bulk_delete_btn route-destroy="{{ route('admin.country_guide.bulk-delete') }}" />
			</div>
			<div class="table-responsive no-wrap">
				<table class="table" id="datatable">
					<x-table.header :headers="['SN', 'Country', 'Guides', 'Actions']" />
					<tbody id="tablecontents">
						@forelse($items as $item)
						<tr>
							<td><input type="checkbox" class="select-row" data-id="{{ $item->id }}"></td>
							<td>{{ $loop->iteration }}</td>
							<x-table.td>{{ $item->country->name }}</x-table.td>
							<td>
								<ul>
									@foreach($item->guides as $guide)
										<li>{{ $guide }}</li>
									@endforeach
								</ul>
							</td>
							<td style="width:150px">
								<div class="actions d-flex">
                                    <x-table.view_btn route-view="{{ route('admin.country_guide.show', ':id') }}" id="{{ $item->id }}" model="CountryGuide" name="item" />
									<x-table.edit_btn route-edit="{{ route('admin.country_guide.edit', $item->id) }}" />
									<x-table.delete_btn route-destroy="{{ route('admin.country_guide.destroy', $item->id) }}" />
								</div>
							</td>
						</tr>
                        <x-table.show_modal id="{{ $item->id }}" model="CountryGuide" />
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No guides found.</td>
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
        'route' => route('admin.country_guide.show', ':id'),
    ])
	@include('_helpers.datatable')
	@include('_helpers.swal_delete')
@endpush
@endsection
