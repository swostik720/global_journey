<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Status:</b>
    <span class="badge {{ $test_preparation->status == 1 ? 'bg-success' : 'bg-danger' }}">
        {{ $test_preparation->status == 1 ? 'Active' : 'Inactive' }}
    </span>
</div>
<hr>
<div class="row align-items-center  ">
    <div class="card-content mt-2 d-flex gap-3">
        <div class="col-md-4">
            <x-table.show_modal_image name="{{ $test_preparation->image }}" url="{{ $test_preparation->image_path }}"
                class="rounded" />
        </div>
        <div class="col-md-8">
            <div class="card-content mt-2">
                <h1>{{ $test_preparation->title ?? '' }}</h1>
            </div>
        </div>
    </div>
    <div class="card-content mt-4">
        <b class="d-block text-uppercase text-14"></b><span>{!! $test_preparation->description ?? '' !!}</span>
    </div>
</div>
