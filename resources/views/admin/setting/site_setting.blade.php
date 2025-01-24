@extends('layouts.master')
@section('title', 'COMPANY SETTING')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="Company Setting"></x-breadcrumb>

        <div class="card">
            <div class="card-body">
                <x-form.wrapper
                    action="{{ isset($siteSettings) && isset($siteSettings->id) ? route('admin.setting.company.update', $siteSettings->id) : route('admin.setting.company.update') }}"
                    method="POST" enctype="multipart/form-data">
                    @method('PUT')

                    <x-form.row>
                        <div class="col-md-4">
                            <div class="card p-3">
                                <x-form.input type="text" :req="true" label="Company Name" id="name"
                                    name="name" value="{{ $siteSettings ? $siteSettings->name : '' }}"
                                    placeholder="Company Name" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3">
                                <x-form.input type="file" col="12" label="Logo" id="logo" name="logo"
                                    accept="image/*" onchange="previewLogo(this,'featured-logo')" />
                                <x-form.settinglogopreview col="12" id="featured-logo"
                                    url="{{ $siteSettings->logo_path ?? '' }}" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card p-3">
                                <x-form.input type="file" col="12" label="Favicon" id="favicon" name="favicon"
                                    accept="image/*" onchange="previewFavicon(this,'featured-favicon')" />
                                <x-form.settingfaviconpreview col="12" id="featured-favicon"
                                    url="{{ $siteSettings->favicon_path ?? '' }}" />
                            </div>
                        </div>
                    </x-form.row>
                    <hr>

                    <h3>{{ $siteSettings->name ?? 'Company' }} Information</h3>
                    <div class="card">
                        <div class="card-body">
                            <x-form.row>
                                <x-form.input type="email" col="4" label="Email" id="email" name="email"
                                    value="{{ $siteSettings ? $siteSettings->email : '' }}"
                                    placeholder="jhondoe@gmail.com" />
                                <x-form.input type="text" col="4" label="Phone" id="phone" name="phone"
                                    value="{{ $siteSettings ? $siteSettings->phone : '' }}" placeholder="+99 999 9999" />
                                <x-form.input type="text" col="4" label="Mobile" id="mobile" name="mobile"
                                    value="{{ $siteSettings ? $siteSettings->mobile : '' }}" placeholder="+99 999 9999" />
                            </x-form.row>
                            <x-form.row>
                                <x-form.input type="text" col="6" label="Our Location" id="contact_address"
                                    name="contact_address" value="{{ $siteSettings ? $siteSettings->contact_address : '' }}"
                                    placeholder="Kathmandu, Nepal" />
                                <x-form.input type="text" col="6" label="Visit Between" id="working_hours"
                                    name="working_hours" value="{{ $siteSettings ? $siteSettings->working_hours : '' }}"
                                    placeholder="Mon - Sat: 8.00-5.00 Sunday: Closed" />
                            </x-form.row>
                            <x-form.row>
                                <x-form.input type="text" col="12" label="Copyright" id="copyright_text"
                                    name="copyright_text" value="{{ $siteSettings ? $siteSettings->copyright_text : '' }}"
                                    placeholder="© 2024 All right reserved" />
                            </x-form.row>
                            <x-form.row>
                                <x-form.textarea type="text" col="12" label="Description" id="description"
                                    name="description" value="{{ $siteSettings ? $siteSettings->description : '' }}"
                                    placeholder="Dynamic description used in footer section" />
                            </x-form.row>
                        </div>
                    </div>
                    <hr>

                    <h3>Social Medai Links</h3>
                    <div class="card">
                        <div class="card-body">
                            <x-form.row>
                                <x-form.input type="text" col="6" label="Facebook Link" id="fb_link"
                                    name="fb_link" value="{{ $siteSettings ? $siteSettings->fb_link : '' }}"
                                    placeholder="https://www.facebook.com/company" />
                                <x-form.input type="text" col="6" label="Twitter Link" id="twitter_link"
                                    name="twitter_link" value="{{ $siteSettings ? $siteSettings->twitter_link : '' }}"
                                    placeholder="https://www.twitter.com/company" />

                            </x-form.row>
                            <x-form.row>
                                <x-form.input type="text" col="6" label="Instagram Link" id="instagram_link"
                                    name="instagram_link"
                                    value="{{ $siteSettings ? $siteSettings->instagram_link : '' }}"
                                    placeholder="https://www.instagram.com/company" />
                                <x-form.input type="text" col="6" label="LinkedIn Link" id="linkedIn_link"
                                    name="linkedIn_link" value="{{ $siteSettings ? $siteSettings->linkedIn_link : '' }}"
                                    placeholder="https://www.linkedIn.com/company" />
                            </x-form.row>
                        </div>
                    </div>
                    <hr>
                    <h3>Google Map</h3>
                    <x-form.row>
                        <x-form.input type="text" col="12" :req="false"
                            label="Our location Map URL (Go To Google Map to generate embed map link)" id="map_url"
                            name="map_url" value="{{ $siteSettings ? $siteSettings->map_url : '' }}" class="mb-2" />
                    </x-form.row>
                    <x-form.row>
                        <iframe src="{{ $siteSettings ? $siteSettings->map_url : '' }}" width="400" height="300"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </x-form.row>

                    <x-form.button class="mt-4 btn btn-sm btn-primary" type="submit"><i class='bx bx-save bx-xs'></i>
                        Save
                    </x-form.button>

                </x-form.wrapper>
            </div>
        </div>

    </div>
@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Settings\SiteSettingUpdateRequest') !!}
    @include('_helpers.site_setting_image_preview')
@endpush
