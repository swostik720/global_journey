<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="row align-items-start">
            {{-- Image --}}
            <div class="col-md-4 mb-3 mb-md-0">
                <x-table.show_modal_image
                    name="{{ $item->image }}"
                    url="{{ $item->image_path ?? '' }}"
                    class="rounded shadow-sm"
                    height="250px"
                    width="100%"
                />
            </div>

            {{-- Details --}}
            <div class="col-md-8">

                <div class="mb-3">
                    <b class="text-uppercase text-14">Name:</b>
                    <span>{{ $item->name ?? 'N/A' }}</span>
                </div>

                <div class="mb-3">
                    <b class="text-uppercase text-14">Website:</b>
                    @if ($item->link)
                        <a href="{{ $item->link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            Visit Website
                        </a>
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="card-content mt-4">
            <b class="d-block text-uppercase text-14 mb-2">Description:</b>
            <p>{!! $item->description ?? 'No description available.' !!}</p>
        </div>

    </div>
</div>
