@extends('layout.auth')

@section('title', __('Inactive account'))
@section('title1', __('Inactive account'))
@section('title2', __('This account does not have an active subscription.'))
@section('class_global', 'login-container')

@section('content')
<div class="card-content">
    <p class="card-subtitle text-muted text-center font-large-5 mx-2 my-1">¯\_(ツ)_/¯</p>

    <div class="card-body text-center">
        <div class="d-grid gap-2" style="animation-delay: 0.4s;">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-primary btn-login">
                <i class="la la-sign-out me-2"></i> {{ __('Logout') }}
            </a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>
@endsection
