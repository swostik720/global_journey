@extends('layouts.master')

@section('content')

    <div class="container-xxl">

        <x-breadcrumb listRoute="{{route('admin.subscribes.index')}}" model="Subscribe" item="Create"></x-breadcrumb>

        <div class="card">
            <div class="card-body">

                <x-form.wrapper action="{{route('admin.subscribes.store')}}" method="POST" enctype="multipart/form-data">
                        <x-form.input type="text" label="Email" id="email" name="email" value="{{ old('email') }}"/>

                        <x-form.button class="btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i> Save</x-form.button>
                </x-form.wrapper>

            </div>
        </div>
    </div>

@endsection

@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\SubscribeStoreRequest') !!}
    
@endpush
