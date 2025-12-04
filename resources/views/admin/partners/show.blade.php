@extends('layout.app')

@section('title', __('Partners'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_partners', "active")

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('Partners') }}</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">{{ __('Details') }}</li>
                            <li class="breadcrumb-item active">{{ $partner->reference }}</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="btn-group float-md-right">
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-warning">
                        <i class="la la-list"></i> {{ __("Partners")}}
                    </a>
                    <a href="{{ route('admin.partners.edit', $partner->id) }}" class="btn btn-blue">
                        <i class="fas fa-edit"></i> {{ __("Edit")}}
                    </a>
                </div>
            </div>
        </div>
        <div class="content-body pb-5">
            <section>
                @include('admin.partners.fiche')
            </section>
        </div>
    </div>
</div>
@endsection
