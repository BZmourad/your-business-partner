@extends('layout.app')

@section('title', __('Users'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_users', "active")

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
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('Users') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">{{ isset($user) ? __('Edit') : __('Add') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-warning">
                            <i class="la la-list"></i> {{ __("Users")}}
                        </a>
                        <button type="submit" form="userForm" class="btn btn-success">
                            <i class="fas fa-check"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="content-body pb-5">
                <form id="userForm" method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif
                    <div class="card mb-5">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row align-items-center justify-content-center">
                                    <div class="avatar-section">
                                        <div class="avatar-container">
                                            <img src="{{ isset($user) ? $user->getAvatar() : asset('img/users/avatar.png') }}" alt="Avatar" class="avatar-preview" id="avatar-preview">
                                            @if(isset($user) && $user->getFirstMediaUrl('avatar'))
                                                <button type="button" class="avatar-remove-btn" id="remove-avatar" title="{{ __('Remove profile picture') }}">
                                                    <i class="la la-times"></i>
                                                </button>
                                            @endif
                                        </div>
                                        <div class="file-input-container">
                                            <div class="file-input-btn">
                                                <i class="la la-upload"></i> {{ __('Choose Image') }}
                                            </div>
                                            <input type="file" name="avatar" id="avatar" accept="image/jpeg, image/png">
                                            <span class="file-name" id="file-name">{{ __('No file chosen') }}</span>
                                        </div>
                                        <small class="form-text text-muted text-center">{{ __('Formats acceptés: JPG, PNG. Taille max: 5MB') }}</small>
                                    </div>
                                    <input type="hidden" name="remove_avatar" id="remove-avatar-input" value="0">
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="account-username">{{ __('Name')}}</label>
                                            <input type="text" class="form-control" id="account-username" required name="name" value="{{isset($user) ? $user->name: ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="account-e-mail">{{ __('Email')}}</label>
                                            <input type="email" class="form-control" id="account-e-mail" required value="{{isset($user) ? $user->email: ''}}" name="email" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="account-e-mail">{{ __('Role')}}</label>
                                            <select name="role" id="role" class="form-control" required>
                                                @foreach ($roles as $role)
                                                    <option value="{{$role}}" {{isset($user) && $userRole==$role ? 'selected' : ''}}>{{$role}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if (!isset($user))
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="user-current_password">{{ __('Password') }}</label>
                                                    <fieldset class="form-group position-relative">
                                                        <div class="input-group">
                                                            <input type="password" class="form-control form-control-lg" id="user-password" name="password" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text la la-refresh generate-password"></span>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text la la-eye" id="show-hide-password"></span>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-retype-new-password">{{ __('Confirm Password') }}</label>
                                                    <fieldset class="form-group position-relative">
                                                        <div class="input-group">
                                                            <input type="password" class="form-control form-control-lg" id="user-password_confirmation" name="password_confirmation" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text la la-eye" id="show-hide-password_confirmation"></span>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row skin skin-square mb-2">
                                        <div class="col-md-12">
                                            <fieldset>
                                                <input type="checkbox" id="user_send_email" name="user_send_email" value="1">
                                                <label for="user_send_email">{{ __('Send access parameters by email')}}</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                @endif
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
            ajaxForm('#userForm');
        });
    </script>
    <script src="{{ asset('js/generate-password.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#show-hide-password").on('click', function() {
                $(this).toggleClass("la-eye la-eye-slash");
                var input = $("#user-password");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
            $("#show-hide-password_confirmation").on('click', function() {
                $(this).toggleClass("la-eye la-eye-slash");
                var input = $("#user-password_confirmation");
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelector(".generate-password").addEventListener("click", function () {
                let newPassword = generatePassword();
                document.getElementById("user-password").value = newPassword;
                document.getElementById("user-password_confirmation").value = newPassword;
            });
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
                $('#avatar-preview').attr('src', "{{ asset('img/users/avatar.png') }}");
                $("#remove-avatar-input").val("1");
                $("#avatar").val('');
                $("#file-name").text("{{ __('No file chosen') }}");
                $(this).hide(); 
            });
        });
    </script>
    @if (!isset($user))
        <script>
            $(document).ready(function() {
                $(".skin-square input").iCheck({
                    checkboxClass: "icheckbox_square-green",
                    radioClass: "iradio_square-green"
                });
            });
        </script>
    @endif
@endpush