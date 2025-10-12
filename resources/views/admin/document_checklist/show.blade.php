<div class="container-xxl">
    <div class="card">
        <div class="card-body">
            <h5>Country: {{ $item->country->name }}</h5>
            <h6>Documents:</h6>
            <ul>
                @foreach($item->documents as $doc)
                    <li>{{ $doc }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
