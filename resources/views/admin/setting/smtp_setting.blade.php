@extends('layouts.master')
@section('title', 'SMTP SETTING')
@section('content')
    <div class="container-xxl">
        <x-breadcrumb model="SMTP Setting"></x-breadcrumb>

        <div class="card">
            <div class="card-body">
                <x-form.wrapper
                    action="{{ isset($smtpSettings) && isset($smtpSettings->id) ? route('admin.setting.smtp.update', $smtpSettings->id) : route('admin.setting.smtp.update') }}"
                    method="POST" enctype="multipart/form-data">
                    @method('PUT')

                    <x-form.row>
                        <x-form.input type="text" col="4" :req="true" placeholder="smtp" label="Mail Mailer"
                            id="mail_mailer" name="mail_mailer"
                            value="{{ $smtpSettings ? $smtpSettings->mail_mailer : '' }}" />
                        <x-form.input type="text" col="4" :req="true" placeholder="smtp.office365.com"
                            label="Mail Host" id="mail_host" name="mail_host"
                            value="{{ $smtpSettings ? $smtpSettings->mail_host : '' }}" />
                        <x-form.input type="text" col="4" :req="true" placeholder="587" label="Mail Port"
                            id="mail_port" name="mail_port" value="{{ $smtpSettings ? $smtpSettings->mail_port : '' }}" />
                    </x-form.row>
                    <x-form.row>
                        <x-form.input type="text" col="12" :req="true" placeholder="something@mail.com"
                            label="Username" id="mail_username" name="mail_username"
                            value="{{ $smtpSettings ? $smtpSettings->mail_username : '' }}" />
                    </x-form.row>
                    <x-form.row style="margin-top:10px;">
                        <x-form.password col="12" :req="true" label="Password" id="password"
                            name="mail_password" value="{{ $smtpSettings ? $smtpSettings->mail_password : '' }}" />
                    </x-form.row>

                    <div class="form-group col-md-12">
                        <label class="required" for="mail_encryption">Mail Encryption<span
                                class="text-danger">*</span></label>
                        <select name="mail_encryption" id="mail_encryption"
                            class="form-control {{ $errors->has('mail_encryption') ? 'is-invalid' : '' }}">
                            <option value="">Select encryption</option>
                            @foreach ($encryptionOptions as $smtp_encrypt)
                                <option value="{{ $smtp_encrypt }}"
                                    {{ $smtp_encrypt === $smtpSettings?->mail_encryption ? 'selected' : '' }}>
                                    {{ $smtp_encrypt }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <x-form.row>
                        <x-form.input type="text" col="6" :req="true" placeholder="something@mail.com"
                            label="Mail From Address" id="mail_from_address" name="mail_from_address"
                            value="{{ $smtpSettings ? $smtpSettings->mail_from_address : '' }}" />
                        <x-form.input type="text" col="6" :req="true" placeholder="App name"
                            label="Mail From Name" id="mail_from_name" name="mail_from_name"
                            value="{{ $smtpSettings ? $smtpSettings->mail_from_name : '' }}" />
                    </x-form.row>

                    <x-form.button class="mt-4 btn btn-sm btn-dark" type="submit"><i class='bx bx-save bx-xs'></i>
                        Save
                    </x-form.button>

                </x-form.wrapper>
            </div>
        </div>

    </div>
@endsection
@push('custom_js')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\Settings\SmptSettingUpdateRequest') !!}
@endpush
