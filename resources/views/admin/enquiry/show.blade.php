<div class="row">
    <div class="title-section col-md-6">
        <span>Status:</span>
        @php
            $badgeClass = match ($enquiry->status) {
                'Contacted' => 'bg-success',
                'Rejected' => 'bg-danger',
                'Requested' => 'bg-warning',
                default => 'bg-primary',
            };
            $badgeText = match ($enquiry->status) {
                'Contacted' => 'Contacted',
                'Rejected' => 'Rejected',
                'Requested' => 'Requested',
                default => 'Unknown',
            };
        @endphp
        <span class="badge {{ $badgeClass }} ml-auto">{{ $badgeText }}</span>
    </div>
    <div class="title-section col-md-6 mb-2">
        <x-form.wrapper action="{{ route('admin.enquiry-status-change', $enquiry->id) }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <x-form.enum-select label="Select an option to change status" :req="true" col="12"
                        :model="$enquiry->status" :options="\App\Enums\ContactStatus::cases()" name="status"></x-form.enum-select>
                </div>
                <div class="col-md-6 mt-3">
                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                        Save</x-form.button>
                </div>
            </div>
        </x-form.wrapper>
    </div>
    <hr>
    <div class="row align-items-center  ">
        <div class="col-md-3">
            <div class="card-content mt-2">
                <b class="d-block text-uppercase text-14">Study Abroad</b><span>{{ $enquiry->studyabroad->title ?? 'N/A' }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-content mt-2">
                <b class="d-block text-uppercase text-14">name</b><span>{{ $enquiry->name }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-content mt-2">
                <b class="d-block text-uppercase text-14">email</b><span>{{ $enquiry->email }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-content mt-2">
                <b class="d-block text-uppercase text-14">Phone</b><span>{{ $enquiry->phone ?? '' }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-content mt-2">
                <b class="d-block text-uppercase text-14">Address</b><span>{{ $enquiry->address }}</span>
            </div>
        </div>
        <div class="card-content mt-2">
            <b class="d-block text-uppercase text-14">message</b><span>{{ $enquiry->enquiry_message }}</span>
        </div>
    </div>
</div>
