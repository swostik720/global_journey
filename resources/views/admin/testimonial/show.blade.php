<style>
    .form-star {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .form-star .form-label {
        margin: 0;
    }

    .star-rating {
        display: inline-block;
    }

    .star-rating .star {
        display: inline-block;
        position: relative;
        width: 30 px;
        height: 30px;
        color: #ffcf20;
        cursor: pointer;
    }

    .star-rating .star::before {
        font-family: boxicons !important;
        font-weight: 400;
        content: "\ee8a";
        font-size: 30px;
        -webkit-transition: all 0.3s ease-in;
        -o-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
    }

    .star-rating .star.star-full::before {
        content: "\ebac";
    }

    .star-rating .star.hovered-star::before {
        content: "\ebac";
    }
</style>
<div class="title-section justify-content-between mb-2">
    <b class="text-uppercase text-14">Status:</b>
    <span class="badge {{ $testimonial->status == 1 ? 'bg-success' : 'bg-danger' }}">
        {{ $testimonial->status == 1 ? 'Active' : 'Inactive' }}
    </span>
</div>
<hr>
<div class="row align-items-center  ">
    <div class="card-content mt-2 d-flex gap-3">
        <div class="col-md-4">
            <x-table.show_modal_image name="{{ $testimonial->image }}" url="{{ $testimonial->image_path }}"
                class="rounded" />
        </div>
        <div class="col-md-8">
            <div class="card-content mt-2">
                <h1>{{ $testimonial->name ?? '' }}</h1>
            </div>

            @if (!empty($testimonial->address))
                <div class="card-content mt-2">
                    <h5><strong>Address: </strong>{{ $testimonial->address ?? '' }}</h5>
                </div>
            @endif
            <div class="">
                <div class="card-content mt-2">
                    <b class="d-block text-uppercase text-14">Rating</b>
                    <div class="star-rating">
                        @foreach (range(1, 5) as $i)
                            @if ($i <= $testimonial->rating)
                                <span class="star star-full"></span>
                            @else
                                <span class="star"></span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-content mt-4">
        <b class="d-block text-uppercase text-14">description</b><span>{!! $testimonial->description ?? '' !!}</span>
    </div>
</div>
