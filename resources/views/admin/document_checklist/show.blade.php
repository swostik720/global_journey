<div class="container-xxl">
    <div class="card">
        <div class="card-body">
            <h5>Country: {{ $item->country->name }}</h5>
            <h6>PDF:</h6>
            @if (!empty($item->pdf_path))
                <a href="{{ asset($item->pdf_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                    View PDF</a>
            @else
                <p class="text-muted">No PDF uploaded.</p>
            @endif

            <h6 class="pt-6">Documents:</h6>
            <ul>
                @foreach($item->documents as $doc)
                    @if(is_array($doc))
                        <li>
                            <strong>{{ $doc['name'] }}</strong>
                            @if(!empty($doc['description']))
                                <small class="text-muted">{!! nl2br(e($doc['description'])) !!}</small>
                                <br>
                            @endif
                        </li>
                    @else
                        <li>{{ $doc }}</li> {{-- fallback for old plain string entries --}}
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
