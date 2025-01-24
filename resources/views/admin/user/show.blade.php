<div class="title-section justify-content-between mb-2">
    <span class="badge bg-info ml-auto">{{ $roleName}}</span>
    <span class="badge bg-primary float-end">{{ $user->user_status}}</span>
</div>
<div class="row border-top py-3">

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">image</b>
            <x-table.table_image name="{{$user->image}}" url="{{$user->image_path}}" height="200px" width="200px"/>
            <p>{{$user->image_caption}}</p>
        </div>
    </div>

    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">name</b>
            <span>{{ $user->name}}</span>
        </div>
    </div>
    <div class="col-xl-4 col-md-4">
        <div class="card-content">
            <b class="d-block text-uppercase text-14">email</b>
            <span>{{ $user->email}}</span>
        </div>
    </div>
</div>

