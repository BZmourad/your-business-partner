@extends('layout.auth')

@section('title', __('Login'))
@section('title1', __('Login'))
@section('title2', __('Sign in to access your account and continue your journey with us'))
@section('class_global', 'login-container')

@section('content')
<form method="POST" action="{{ route('login') }}" autocomplete="off">
    @csrf
    <div class="mb-4 form-group" style="animation-delay: 0.1s;">
        <label for="email" class="form-label">{{ __('Email Address') }}</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="mb-4 form-group" style="animation-delay: 0.2s;">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <div class="password-input-group">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" >
            </div>
            <span class="password-toggle" onclick="togglePassword()">
                <i class="fas fa-eye"></i>
            </span>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="mb-4 d-flex justify-content-between align-items-center form-group" style="animation-delay: 0.3s;">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
        </div>
        
        @if (Route::has('password.request'))
            <a class="text-decoration-none" href="{{ route('password.request') }}" style="font-size: 0.85rem;">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
    </div>
    <div class="d-grid gap-2 form-group" style="animation-delay: 0.4s;">
        <button type="submit" class="btn btn-primary btn-login">
            <i class="fas fa-sign-in-alt me-2"></i> {{ __('Login') }}
        </button>
    </div>
</form>
@if (Route::has('register'))
    <div class="mt-3 text-center form-group" style="animation-delay: 0.5s;">
        <p class="mb-0">{{ __("Don't have an account?") }}
            <a class="text-decoration-none" href="{{ route('register') }}">{{ __('Create Account') }}</a>
        </p>
    </div>
@endif
@endsection
