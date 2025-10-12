    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Country: {{ $item->country->name ?? 'N/A' }}</h4>

            <h5 class="mb-2">Guides:</h5>
            @if (is_array($item->guides) && count($item->guides) > 0)
                <ol class="ps-3">
                    @foreach ($item->guides as $guide)
                        <li>{{ $guide }}</li>
                    @endforeach
                </ol>
            @else
                <p>No guides available for this country.</p>
            @endif
        </div>
    </div>
