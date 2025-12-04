@extends('layout.app')

@section('title', __('Configuration'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_config_logo', "active")

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
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('Configuration')}}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">{{ __('Logo') }}</li>
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
                <form id="settingForm" method="POST" action="{{ route('admin.config.logo.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-center">
                                            <div class="avatar-section">
                                                <div class="avatar-container">
                                                    <img src="{{ asset(config('company.logo')) }}" alt="Avatar" class="avatar-preview" id="avatar-preview">
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
                                            <input type="hidden" name="remove_avatar" id="remove-avatar-input" value="0">
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
    <script>
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
                $('#avatar-preview').attr('src', "{{ asset(config('company.logo')) }}");
                $("#remove-avatar-input").val("1");
                $("#avatar").val('');
                $("#file-name").text("{{ __('No file chosen') }}");
                $(this).hide(); 
            });
        });
    </script>
@endpush