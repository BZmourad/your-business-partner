<!DOCTYPE html>
<html class="loading" lang="{{Auth::user()->lang}}" @if(Auth::user()->lang != 'ar') data-textdirection="ltr" @else data-textdirection="rtl" @endif>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="title" content="{{config('app.name')}} | {{config('company.name')}}" >
    <meta name="description" content="  {{ __('Conseil fiscal tunisie')}} | {{config('app.name')}} | {{config('company.name')}}" > 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title') </title>
    <link rel="apple-touch-icon" href="{{ asset(config('company.logo')) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(config('company.logo')) }}">
    @include('layout.partials.main-css')
    @stack('styles')
</head>
<body class="vertical-layout vertical-menu-modern @yield('body_class') fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="@yield('data_col')">
    @include('layout.partials.loader.html')
    @include('layout.partials.header')
    @include(auth()->user()->type.'.partials.menu')
    @yield('content')
    <datalist id="docsname">
        @foreach(\App\Models\Document\DocumentName::all() as $doc)
            <option value="{{ $doc->name }}">
        @endforeach
    </datalist>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <button class="scroltop icon-up" type="button" id="scroll-to-top"><i class="fas fa-arrow-up"></i></button>
    @include('layout.partials.main-js')
    @stack('scripts')
</body>
</html>