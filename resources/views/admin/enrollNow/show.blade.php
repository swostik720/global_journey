    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Name: {{ $enrollNow->name ?? 'N/A' }}</h4>
            <h5 class="mb-2">Email: {{ $enrollNow->email ?? 'N/A' }}</h5>
            <h5 class="mb-2">Phone: {{ $enrollNow->phone ?? 'N/A' }}</h5>
            <h5 class="mb-2">Test Preparation: {{ $enrollNow->testPreparation->title ?? 'N/A' }}</h5>
            <h5 class="mb-2">Branch: {{ $enrollNow->branch->name ?? 'N/A' }}</h5>
            <p class="text-muted"><small>Created at: {{ $enrollNow->created_at->format('d F Y, h:i A') }}</small></p>
        </div>
    </div>
