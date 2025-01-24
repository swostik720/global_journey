<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Status:</b>
    <span class="badge {{ $country->status == 1 ? 'bg-success' : 'bg-danger' }}">
        {{ $country->status == 1 ? 'Active' : 'Inactive' }}
    </span>
</div>
<hr>
<div class="row align-items-center  ">
    <div class="card-content mt-2">
        <h4><b class="text-uppercase">country name: </b>{{ $country->name }}</h4>
    </div>

</div>
