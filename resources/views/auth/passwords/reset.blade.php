@extends('layout.auth')

@section('title', __('Reset Password'))
@section('title1', __('Reset Password'))
@section('title2', __('Reset Password'))
@section('class_global', 'login-container')

@section('return')
    <div class="back-to-home form-group" style="animation-delay: 0s;">
        <a href="{{ route('login') }}">
            <i class="fas fa-arrow-left"></i> {{ __('Login')}}
        </a>
    </div>
@endsection

@section('content')
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
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
    <div class="mb-4 form-group" style="animation-delay: 0.2s;">
        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
        <div class="password-input-group">
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" >
            </div>
            <span class="password-toggle-new" onclick="toggleConfirmPassword()">
                <i class="fas fa-eye"></i>
            </span>
        </div>
    </div>
    <div class="d-grid gap-2 form-group" style="animation-delay: 0.4s;">
        <button type="submit" class="btn btn-primary btn-login">
            <i class="fas fa-redo me-2"></i> {{ __('Reset Password') }}
        </button>
    </div>
</form>
@endsection
