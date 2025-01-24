@props(['status'])

@php
    $badgeClass = match ($status) {
        'Contacted' => 'bg-success text-white',
        'Rejected' => 'bg-danger text-white',
        'Requested' => 'bg-warning text-dark',
        default => 'bg-primary text-white',
    };
@endphp

<td>
    <span class="badge {{ $badgeClass }}">
        {{ $status }}
    </span>
</td>
