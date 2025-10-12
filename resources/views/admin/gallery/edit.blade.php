@extends('layouts.master')
@section('title', 'Edit Gallery - ' . $gallery->title)
@section('content')
<div class="container-xxl">
    <x-breadcrumb listRoute="{{ route('admin.gallery.index') }}" model="Gallery" item="Edit"></x-breadcrumb>

    <div class="card">
        <div class="card-body">

            <x-form.wrapper action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST"
                enctype="multipart/form-data">
                @method('PATCH')

                {{-- Gallery Title --}}
                <x-form.input type="text" label="Gallery Title" id="title" name="title"
                    value="{{ $gallery->title }}" :req="true" />

                {{-- Gallery Category --}}
                <div class="mb-3 col-6 pt-3">
                    <label for="gallery_category_id" class="form-label">Gallery Category</label>
                    <select name="gallery_category_id" id="gallery_category_id" class="form-control" required>
                        <option value="">Select Gallery Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @if ($gallery->gallery_category_id == $category->id) selected @endif>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Existing Images --}}
                @if ($gallery->images)
                    <div class="mb-3">
                        <label class="form-label">Existing Images</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($gallery->images as $img)
                                <div class="position-relative" id="img-{{ md5($img) }}">
                                    <img src="{{ asset('uploaded-images/gallery/' . $img) }}" width="100"
                                        class="rounded border">
                                    <button type="button"
                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 remove-img-btn"
                                        data-image="{{ $img }}" data-gallery="{{ $gallery->id }}">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <small class="text-muted">Click trash to remove an image</small>
                    </div>
                @endif

                {{-- Add New Images --}}
                <div class="mb-3">
                    <x-form.input type="file" label="Add New Images" id="images" name="images[]" multiple />
                    <div class="mt-2" id="new-images-preview" style="display:flex; flex-wrap: wrap; gap: 10px;"></div>
                </div>

                {{-- Submit Button --}}
                <div class="mt-3">
                    <x-form.button class="btn btn-sm btn-dark" type="submit">
                        <i class='bx bx-save bx-xs'></i> Update
                    </x-form.button>
                </div>
            </x-form.wrapper>
        </div>
    </div>
</div>
@endsection

@push('custom_js')
{!! JsValidator::formRequest('App\Http\Requests\GalleryRequest') !!}

{{-- Include CryptoJS for MD5 hashing --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // --- Real-time preview for newly uploaded images ---
    const newImagesInput = document.getElementById('images');
    const newImagesPreview = document.getElementById('new-images-preview');

    newImagesInput.addEventListener('change', function(e) {
        newImagesPreview.innerHTML = '';
        const files = e.target.files;
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.width = 100;
                img.classList.add('rounded', 'border');
                newImagesPreview.appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    });

    // --- Delete existing images via AJAX with SweetAlert ---
    document.querySelectorAll('.remove-img-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const image = this.dataset.image;
            const galleryId = this.dataset.gallery;
            const container = document.getElementById('img-' + CryptoJS.MD5(image));

            Swal.fire({
                title: 'Are you sure?',
                text: "This image will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ url('admin/gallery') }}/${galleryId}/image`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ image: image })
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.success) {
                            container.remove(); // Remove from DOM
                            Swal.fire(
                                'Deleted!',
                                'Image has been deleted.',
                                'success'
                            );
                        } else {
                            Swal.fire('Error!', res.error || 'Something went wrong!', 'error');
                        }
                    })
                    .catch(err => Swal.fire('Error!', 'Error deleting image!', 'error'));
                }
            });
        });
    });

});
</script>
@endpush
