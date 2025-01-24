<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Status:</b>
    <span class="badge {{ $category->status == 1 ? 'bg-success' : 'bg-danger' }}">
        {{ $category->status == 1 ? 'Active' : 'Inactive' }}
    </span>
</div>
<hr>
<div class="row align-items-center  ">
    <div class="card-content mt-2">
        <h4><b class="text-uppercase">blog category name: </b>{{ $category->name }}</h4>
    </div>

</div>
