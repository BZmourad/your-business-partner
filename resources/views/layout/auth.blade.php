<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset(config('company.logo')) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('company.logo')) }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/vendors/css/extensions/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('modern-admin/app-assets/css/plugins/extensions/toastr.min.css') }}">
    @include('layout.partials.auth.style')
    @include('layout.partials.pointer.style')
    @stack('styles')
</head>
<body>
    <div class="container">
        <div class="@yield('class_global')">
            @yield('return')
            <div class="logo-container">
                <a href="{{route('welcome')}}">
                    <img src="{{ asset(config('company.logo')) }}" alt="Logo" class="logo">
                </a>
                <h2 class="login-title">@yield('title1')</h2>
                <p class="login-subtitle">@yield('title2')</p>
            </div>
            @yield('content')
        </div>
    </div>
    <script src="{{asset('libs/jquery/3.7.1/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('modern-admin/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    @include('layout.partials.pointer.script')
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
        function toggleConfirmPassword() {
            const passwordInput = document.getElementById('password_confirmation');
            const toggleIcon = document.querySelector('.password-toggle-new i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                group.style.animationDelay = `${index * 0.1 + 0.1}s`;
            });
            const logo = document.querySelector('.logo');
            logo.addEventListener('mouseenter', () => {
                logo.style.animation = 'float 3s ease-in-out infinite';
            });
            logo.addEventListener('mouseleave', () => {
                logo.style.animation = 'float 4s ease-in-out infinite';
            });
        });
    </script>
    @stack('scripts')
</body>
</html>