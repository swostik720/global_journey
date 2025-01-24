<span>
    @if (isset($routeDestroy))
        <form action="{{ $routeDestroy }}" method="POST">
            @csrf

            <button class="btn btn-danger bulk-delete-btn btn-outline-main btn-outline-main-white btn-sm" title="Delete">
                <i class="bx bx-trash"></i> Delete Selected
            </button>
        </form>
    @endif
</span>
