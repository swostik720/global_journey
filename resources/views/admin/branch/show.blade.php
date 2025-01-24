<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Status:</b>
    <span class="badge {{ $branch->status == 1 ? 'bg-success' : 'bg-danger' }}">
        {{ $branch->status == 1 ? 'Active' : 'Inactive' }}
    </span>
</div>
<hr>
<div class="row align-items-center  ">
    <div class="card-content mt-2">
        <h4><b class="text-uppercase">branch name: </b>{{ $branch->name }}</h4>
    </div>
    <div class="card-content mt-2">
        <h4><b class="text-uppercase">branch email: </b>{{ $branch->email }}</h4>
    </div>
    <div class="card-content mt-2">
        <h4><b class="text-uppercase">branch phone: </b>{{ $branch->phone ?? 'N/A' }}</h4>
    </div>
    <div class="card-content mt-2">
        <h4><b class="text-uppercase">branch address: </b>{{ $branch->contact_address ?? 'N/A' }}</h4>
    </div>
    <div class="card-content mt-2">
        <h4><b class="text-uppercase">branch working hours: </b>{{ $branch->working_hours ?? 'N/A' }}</h4>
    </div>
</div>
