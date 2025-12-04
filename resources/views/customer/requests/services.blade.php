@extends('customer.layouts.app')

@section('title', __('Requests'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_new_requests', "active")

@push('styles')
    <style>
        .card-service:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        .card-service .card-body {
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .card-service .card-text {
            flex-grow: 1;
        }
        .card-service .btn {
            margin-top: auto; 
            align-self: center; 
        }
    </style>
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('Requests') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">{{ __('Add') }}</li>
                                <li class="breadcrumb-item active">{{ __('Choose service') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('customer.requests.index') }}" class="btn btn-warning"> <i class="la la-list"></i> </a>
                    </div>
                </div>
            </div>
            <div class="content-body pb-5">
                <section class="mb-5">
                    <div class="row match-height">
                        @foreach ($services as $service)
                            <div class="col-lg-4 col-md-12 mb-4">
                                <div class="card text-center card-service h-100">
                                    <div class="card-content h-100"> 
                                        <div class="card-body">
                                            <h2 class="blue-dark">{{$service->name}}</h2>
                                            <p class="card-text mt-1">{!! $service->description !!}</p>
                                            <a href="{{route('customer.requests.add', $service->id)}}" class="btn btn-primary btn-glow round px-2">{{ __('Choose')}} <i class="la la-arrow-right"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection