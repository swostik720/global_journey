<div class="row">
    <div class="title-section col-md-6">
        <span>Status:</span>
        @php
            $badgeClass = match ($contact->status) {
                'Contacted' => 'bg-success',
                'Rejected' => 'bg-danger',
                'Requested' => 'bg-warning',
                default => 'bg-primary',
            };
            $badgeText = match ($contact->status) {
                'Contacted' => 'Contacted',
                'Rejected' => 'Rejected',
                'Requested' => 'Requested',
                default => 'Unknown',
            };
        @endphp
        <span class="badge {{ $badgeClass }} ml-auto">{{ $badgeText }}</span>
    </div>
    <div class="title-section col-md-6 mb-2">
        <x-form.wrapper action="{{ route('admin.contact-status-change', $contact->id) }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <x-form.enum-select label="Select an option to change status" :req="true" col="12"
                        :model="$contact->status" :options="\App\Enums\ContactStatus::cases()" name="status"></x-form.enum-select>
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
                <b class="d-block text-uppercase text-14">name</b><span>{{ $contact->name }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-content mt-2">
                <b class="d-block text-uppercase text-14">email</b><span>{{ $contact->email }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-content mt-2">
                <b class="d-block text-uppercase text-14">Phone</b><span>{{ $contact->phone }}</span>
            </div>
        </div>

        <div class="card-content mt-2">
            <b class="d-block text-uppercase text-14">message</b><span>{{ $contact->contact_message }}</span>
        </div>

        @if($contact->branch->name)
        <div class="col-md-3">
            <div class="card-content mt-2">
                <b class="d-block text-uppercase text-14">Branch</b><span>{{ $contact->branch->name }}</span>
            </div>
        </div>
        @endif
        
        @if($contact->address)
        <div class="col-md-3">
            <div class="card-content mt-2">
                <b class="d-block text-uppercase text-14">Address</b><span>{{ $contact->address }}</span>
            </div>
        </div>
        @endif
        @if($contact->interested_country)
        <div class="col-md-3">
            <div class="card-content mt-2">
                <b class="d-block text-uppercase text-14">Interested Country</b><span>{{ $contact->interested_country }}</span>
            </div>
        </div>
        @endif
        @if($contact->last_qualification)
        <div class="col-md-3">
            <div class="card-content mt-2">
                <b class="d-block text-uppercase text-14">Last Qualification</b><span>{{ $contact->last_qualification }} GPA/%</span>
            </div>
        </div>
        @endif
        @if($contact->test_preparation)
        <div class="col-md-3">
            <div class="card-content mt-2">
                <b class="d-block text-uppercase text-14">Test Peparation</b><span>{{ $contact->test_preparation }}</span>
            </div>
        </div>
        @endif
    </div>
</div>
