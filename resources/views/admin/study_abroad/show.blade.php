<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Status:</b>
    <span class="badge {{ $study_abroad->status == 1 ? 'bg-success' : 'bg-danger' }}">
        {{ $study_abroad->status == 1 ? 'Active' : 'Inactive' }}
    </span>
</div>
<hr>
<div class="row align-items-center  ">
    <div class="card-content mt-2 d-flex gap-3">
        <div class="col-md-4">
            <x-table.show_modal_image name="{{ $study_abroad->image }}" url="{{ $study_abroad->image_path }}"
                class="rounded" />
        </div>
        <div class="col-md-8">
            <div class="card-content mt-2">
                <h1>{{ $study_abroad->title ?? '' }}</h1>
            </div>

            @if (!empty($study_abroad->country->name))
                <div class="card-content mt-2">
                    <h5><strong>Country: </strong>{{ $study_abroad->country->name ?? '' }}</h5>
                </div>
            @endif
        </div>
    </div>
    <div class="card-content mt-4">
        <b class="d-block text-uppercase text-14"></b><span>{!! $study_abroad->description ?? '' !!}</span>
    </div>
</div>
