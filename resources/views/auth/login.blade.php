@extends('layouts.master')
@section('title', 'LOGIN')
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="app-brand justify-content-center mb-4">
                @if (is_object($setting) && isset($setting['logo']))
                    <a href="{{ url('/') }}" class="app-brand-link">
                        <img src="{{ asset('uploaded-images/site-setting-images/' . $setting->logo) }}"
                            style="max-width: 200px;max-height:65px; object-fit: contain;" alt="Logo">
                    </a>
                @else
                    <a href="{{ url('/') }}" class="app-brand-link">
                        <span class="app-brand-text demo text-body fw-bolder text-uppercase">Leader</span>
                    </a>
                @endif
            </div>
            <h5 class="mb-3 text-center text-uppercase">Login👋</h5>
            <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Sign in with your email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" id="email" placeholder="Enter your email" autofocus />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                    </div>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                            name="password"
                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                            aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }} " class="mt-1 d-inline-block">
                            <small>Forgot Password?</small>
                        </a>
                    @endif
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary d-grid w-100" type="submit">LOGIN</button>
                </div>
            </form>

            {{-- <div>
                Do not have an account ?
                <a href="{{ route('register') }} " class="mt-1 d-inline-block">
                    <small>Sign Up</small>
                </a>
            </div> --}}
        </div>
    </div>
@endsection
