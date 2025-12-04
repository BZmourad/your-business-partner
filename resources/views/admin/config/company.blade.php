@extends('layout.app')

@section('title', __('Configuration'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_config_company', "active")

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('Configuration')}}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">{{ __('Company') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <button type="submit" form="settingForm" class="btn btn-success">
                            <i class="fas fa-check"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="content-body pb-5">
                <form id="settingForm" method="POST" action="{{ route('admin.config.company.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">{{ __("Nom d'entreprise") }}  <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ config('company.name') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="app_name">{{ __('App Name') }} <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="app_name" name="app_name" value="{{ config('app.name') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">{{ __("Email") }}  <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ config('company.email') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">{{ __('Phone') }} <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ config('company.phone') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="country">{{ __('Country') }} <span class="text-danger">*</span></label>
                                                    <select name="country" class="form-control select2-country" id="country" required>
                                                        <option value=""></option>
                                                        @foreach (countries() as $item)
                                                            <option value="{{$item['code']}}" data-flag="{{ asset('img/flags/' . strtolower($item['code']) . '.svg') }}" @if (config('company.country') == $item['code']) selected @endif>
                                                                {{$item['name_'.auth()->user()->lang]}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="ville">{{ __('Ville') }} <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="ville" name="ville" value="{{ config('company.ville') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">{{ __('Adresse complète') }} <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="address" name="address" rows="4" required>{{ config('company.address') }}</textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="code_postal">{{ __("Code postal") }}  <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="code_postal" name="code_postal" value="{{ config('company.code_postal') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="business_registration_number">{{ __('Business registration number') }} <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="business_registration_number" name="business_registration_number" value="{{ config('company.business_registration_number') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="tax_id">{{ __("Matricule Fiscale") }}  <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="tax_id" name="tax_id" value="{{ config('company.tax_id') }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            ajaxForm('#settingForm');
        });
    </script>
@endpush