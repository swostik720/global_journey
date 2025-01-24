<style>
    .social-icon {
        font-size: 32px;
        margin-right: 10px;
    }

    .social-icon i {
        display: inline-block;
        width: 50px;
        height: 50px;
        text-align: center;
        line-height: 50px;
        background-color: #f8f8f8;
        border-radius: 8px;
        color: #3b5998;
    }

    .social-icon i:hover {
        color: #1a73e8;
    }
</style>
<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Status:</b>
    <span class="badge {{ $team->status == 1 ? 'bg-success' : 'bg-danger' }}">
        {{ $team->status == 1 ? 'Active' : 'Inactive' }}
    </span>
</div>
<hr>
<div class="row align-items-center  ">
    <div class="card-content mt-2 d-flex gap-3">
        <div class="col-md-4">
            <x-table.show_modal_image name="{{ $team->image }}" url="{{ $team->image_path }}" class="rounded" />
        </div>
        <div class="col-md-8">
            <div class="card-content mt-2">
                <h1>{{ $team->name ?? '' }}</h1>
            </div>
            <div class="card-content mt-2">
                <h5><strong>Responsibility: </strong>{{ $team->responsibility ?? '' }}</h5>
            </div>
            {{-- <div class="card-content mt-2">
                <h5><strong>Experience: </strong>{{ $team->experience ?? '' }}</h5>
            </div>
            <div class="card-content mt-2">
                <h5><strong>Email: </strong>{{ $team->email ?? '' }}</h5>
            </div>
            <div class="card-content mt-2">
                <h5><strong>Phone: </strong>{{ $team->phone ?? '' }}</h5>
            </div> --}}
            <div class="card-content mt-2">
                <h5><strong>Rank: </strong>{{ $team->rank ?? '' }}</h5>
            </div>
            <div class="card-content mt-2 gap-3">
                <b class="d-block text-uppercase text-14">Social media</b>

                <a href="{{ $team->fb_link ?? '#' }}" target="_blank" class="social-icon">
                    <i class='bx bxl-facebook'></i>
                </a>
                <a href="{{ $team->twitter_link ?? '#' }}" target="_blank" class="social-icon">
                    <i class='bx bxl-twitter'></i>
                </a>
                <a href="{{ $team->linkedin_link ?? '#' }}" target="_blank" class="social-icon">
                    <i class='bx bxl-linkedin'></i>
                </a>
                <a href="{{ $team->instagram_link ?? '#' }}" target="_blank" class="social-icon">
                    <i class='bx bxl-instagram'></i>
                </a>
            </div>
        </div>
    </div>
    {{-- <div class="card-content mt-2">
        <b class="d-block text-uppercase text-14">details</b><span>{!! $team->details ?? '' !!}</span>
    </div> --}}

</div>
