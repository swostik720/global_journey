@extends('layouts.master')
@section('title', 'Create Gallery')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb listRoute="{{ route('admin.gallery.index') }}" model="Gallery" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">
                <x-form.wrapper action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">

                    {{-- Gallery Title --}}
                    <x-form.input type="text" label="Gallery Title" id="title" name="title"
                        value="{{ old('title') }}" :req="true" />

                    {{-- Gallery Category --}}
                    <x-form.select label="Gallery Category" name="gallery_category_id" id="gallery_category_id"
                        :options="$categories" :selected="old('gallery_category_id')" :req="true" />

                    {{-- Gallery Images --}}
                    <x-form.input type="file" label="Gallery Images" id="images" name="images[]" multiple />

                    {{-- Preview Selected Images --}}
                    <div id="images-preview" class="d-flex flex-wrap gap-2 mt-2"></div>

                    {{-- Submit Button --}}
                    <div class="mt-3">
                        <x-form.button class="btn btn-sm btn-dark" type="submit">
                            <i class='bx bx-save bx-xs'></i> Save
                        </x-form.button>
                    </div>
                </x-form.wrapper>
            </div>
        </div>
    </div>
@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\GalleryRequest') !!}
    <script>
        document.getElementById('images').addEventListener('change', function(event) {
            const preview = document.getElementById('images-preview');
            preview.innerHTML = ''; // Clear previous previews

            const files = event.target.files;
            if (files.length > 0) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.width = 80; // adjust size as needed
                        img.className = 'me-1 mb-1 rounded border';
                        preview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            }
        });
    </script>
@endpush
