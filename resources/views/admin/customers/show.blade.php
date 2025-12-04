@extends('layout.app')

@section('title', __('Customers'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_customers', "active")

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('Customers') }}</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">{{ __('Details') }}</li>
                            <li class="breadcrumb-item active">{{ $customer->reference }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right">
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-warning">
                        <i class="la la-list"></i> {{ __("Customers")}}
                    </a>
                    <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-blue">
                        <i class="fas fa-edit"></i> {{ __("Edit")}}
                    </a>
                    <a href="{{ route('admin.customers.downloadPDF', $customer->id) }}" class="btn btn-dark" target="_blanc" >
                        <i class="fas fa-download"></i> {{ __("Download sheet")}}
                    </a>
                </div>
            </div>
        </div>
        <div class="content-body pb-5">
            <section>
                @include('admin.customers.fiche')
            </section>
        </div>
    </div>
</div>
@endsection
