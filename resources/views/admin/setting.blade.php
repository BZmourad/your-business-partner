@extends('layout.app')

@section('title', __('Settings'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_settings', "active")

@push('styles')
    <style>
        .avatar-container {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }
        .avatar-preview {
            width: 150px;
            object-fit: cover;
            border: 3px solid #f8f9fa;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .avatar-remove-btn {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #ff5b5b;
            color: white;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .avatar-remove-btn:hover {
            background-color: #ff3a3a;
        }
        .file-input-container {
            position: relative;
            overflow: hidden;
            display: inline-block;
            margin-top: 15px;
        }
        .file-input-btn {
            background-color: #6b6b6b;
            color: white;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .file-input-btn:hover {
            background-color: #5a5a5a;
        }
        .file-input-container input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }
        .file-name {
            margin-left: 10px;
            font-size: 14px;
            color: #6c757d;
        }
        .avatar-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('Settings')}}</h3>
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
                <form id="settingForm" method="POST" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        {{--<div class="row align-items-center justify-content-center">
                                            <div class="avatar-section">
                                                <div class="avatar-container">
                                                    <img src="{{ asset(config('company.logo')) }}" alt="Avatar" class="avatar-preview" id="avatar-preview">
                                                    @if(config('company.logo'))
                                                        <button type="button" class="avatar-remove-btn" id="remove-avatar" title="{{ __('Remove logo') }}">
                                                            <i class="la la-times"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                                <div class="file-input-container">
                                                    <div class="file-input-btn">
                                                        <i class="la la-upload"></i> {{ __('Choose Image') }}
                                                    </div>
                                                    <input type="file" name="logo" id="avatar" accept="image/jpeg, image/png">
                                                    <span class="file-name" id="file-name">{{ __('No file chosen') }}</span>
                                                </div>
                                                <small class="form-text text-muted text-center">{{ __('Formats acceptés: JPG, PNG. Taille max: 5MB') }}</small>
                                            </div>
                                            <input type="hidden" name="remove_logo" id="remove-avatar-input" value="0">
                                        </div>--}}
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
    {{--<script>
        $(document).ready(function() {
            $("#avatar").on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $("#file-name").text(fileName || "{{ __('No file chosen') }}");
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#avatar-preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                    $("#remove-avatar-input").val("0"); 
                }
            });
            $("#remove-avatar").on('click', function() {
                $('#avatar-preview').attr('src', "{{ asset('img/logo/logo.png') }}");
                $("#remove-avatar-input").val("1");
                $("#avatar").val('');
                $("#file-name").text("{{ __('No file chosen') }}");
                $(this).hide(); 
            });
        });
    </script>--}}
@endpush