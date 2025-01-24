@extends('layouts.master')
@section('title', 'Create Testimonial')
@section('content')
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
            margin-left: 10px;
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
    <div class="container-xxl">

        <x-breadcrumb listRoute="{{ route('admin.testimonials.index') }}" model="Testimonial" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">

                    <x-form.row>
                        <x-form.input type="file" label="Image" col="6" name="image" alt="image"
                            accept="image/*" onchange="previewThumb('image','image-thumb')" />
                        <x-form.preview for="image" id="image-thumb" col="6" />
                    </x-form.row>

                    <x-form.input type="text" label="Name" id="name" name="name" value="{{ old('name') }}" />
                    <x-form.input type="text" label="Address" id="address" name="address"
                        value="{{ old('address') }}" />

                    <x-form.row>
                        <div class="form-group form-star mt-2">
                            <label class="form-label">Rating</label>
                            <div class="star-rating">
                                <span class="star" data-rating="1"></span>
                                <span class="star" data-rating="2"></span>
                                <span class="star" data-rating="3"></span>
                                <span class="star" data-rating="4"></span>
                                <span class="star" data-rating="5"></span>
                                <input type="hidden" name="rating" class="rating-value" value="5">
                            </div>
                        </div>
                    </x-form.row>

                    <x-form.row>
                        <x-form.textarea label="description" id="description" name="description"
                            value="{{ old('description') }}" rows="3" cols="5" :req="true"
                            placeholder="I'm grateful to access ability solutions for their exceptional care and support." />
                    </x-form.row>
                    <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                        Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\TestimonialStoreRequest') !!}
    @include('_helpers.new_image_preview')
    <script>
        var $star_rating = $('.star-rating .star');
        var SetRatingStar = function() {
            return $star_rating.each(function() {
                if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data(
                        'rating'))) {
                    return $(this).addClass('star-full');
                } else {
                    return $(this).removeClass('star-full');
                }
            });
        };
        $star_rating.on('click', function() {
            $star_rating.siblings('input.rating-value').val($(this).data('rating'));
            return SetRatingStar();
        });
        $star_rating.hover(
            function() {
                var rating = $(this).data('rating');
                $star_rating.each(function() {
                    if (parseInt($(this).data('rating')) <= rating) {
                        $(this).addClass('hovered-star');
                    }
                });
            },
            function() {
                $star_rating.removeClass('hovered-star');
            }
        );
        SetRatingStar();
    </script>
@endpush
