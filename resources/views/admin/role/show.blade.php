

<div class="row border-top border-bottom py-3">
    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Name</b>
            <span>{{ $role->name}}</span>
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">Slug</b>
            <span>{{ $role->slug}}</span>
        </div>
    </div>
   
</div>


    <div class="border-bottom py-3">
    <div class="row">
        <div class="card-content">
        <b class="d-block text-uppercase text-14">Permissions</b>
            @foreach ($role->permissions as $permission)
            <span class="badge bg-primary m-1">{{ $permission->name}}</span>
            @endforeach
        </div>
    </div>
</div>