@extends('layout.auth')

@section('title', __('Verify Your Email Address'))
@section('title1', __('Verify Your Email Address'))
@section('class_global', 'login-container')

@section('content')
    <div class="row justify-content-center">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }},
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <div class="d-grid gap-2 form-group" style="animation-delay: 0.4s;">
                <button type="submit" class="btn btn-primary btn-login">{{ __('click here to request another') }}</button>
            </div>
        </form>
    </div>
@endsection
