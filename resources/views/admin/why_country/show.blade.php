<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-3">Country: {{ $item->country->name ?? 'N/A' }}</h4>
        <h5 class="mb-2">Reasons:</h5>

        @if(is_array($item->description) && count($item->description) > 0)
            <ol class="ps-3">
                @foreach($item->description as $desc)
                    <li>{{ $desc }}</li>
                @endforeach
            </ol>
        @else
            <p>No reasons available for this country.</p>
        @endif
    </div>
</div>
