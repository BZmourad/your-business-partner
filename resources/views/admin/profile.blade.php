@extends('layout.app')

@section('title', __('Profile'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")

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
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('Profile')}}</h3>
                </div>
                <div class="content-header-right col-md-6 col-12"></div>
            </div>
            <div class="content-body pb-5">
                <section id="page-account-settings">
                    <div class="row">
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1 bg-white shadow-sm">
                                <li class="nav-item">
                                    <a class="nav-link d-flex active" id="account-pill-general" data-toggle="pill"
                                        href="#account-vertical-general" aria-expanded="true">
                                        <i class="ft-globe mr-50"></i>
                                        {{ __('Profile Information')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-password" data-toggle="pill" href="#account-vertical-password"
                                        aria-expanded="false">
                                        <i class="ft-lock mr-50"></i>
                                        {{ __('Update Password')}}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex" id="account-pill-info" data-toggle="pill" href="#account-vertical-info"
                                        aria-expanded="false">
                                        <i class="ft-camera mr-50"></i>
                                        {{ __('Update Profile Picture')}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                                <form id="formUpdate1" autocomplete="off" method="POST" action="{{route('admin.profile.update1')}}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="last_name">{{ __('Nom') }}  <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', auth()->user()->last_name ?? '') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="first_name">{{ __('Prénom') }} <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', auth()->user()->first_name ?? '') }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="email">{{ __('Email') }}  <span class="text-danger">*</span></label>
                                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="languageselect2">{{ __('Languages')}}</label>
                                                                <select class="form-control" id="languageselect2" name="lang">
                                                                    <option value="ar" @if (Auth::user()->lang == 'ar') selected @endif>{{ __('Arabic')}}</option>
                                                                    <option value="en" @if (Auth::user()->lang == 'ar') selected @endif>{{ __('Anglais')}}</option>
                                                                    <option value="fr" @if (Auth::user()->lang == 'fr') selected @endif>{{ __('French')}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="phone">{{ __('Téléphone') }}</label>
                                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fax">{{ __('Fax') }}</label>
                                                                <input type="text" class="form-control" id="fax" name="fax" value="{{ old('fax', auth()->user()->fax ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="gender">{{ __('Gender') }}</label>
                                                                <select class="form-control" id="gender" name="gender">
                                                                    <option value="">{{ __('Sélectionner') }}</option>
                                                                    <option value="homme" {{ old('gender', auth()->user()->gender ?? '') == 'homme' ? 'selected' : '' }}>
                                                                        {{ __('Masculin') }}
                                                                    </option>
                                                                    <option value="femme" {{ old('gender', auth()->user()->gender ?? '') == 'femme' ? 'selected' : '' }}>
                                                                        {{ __('Féminin') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="birth_date">{{ __('Date de naissance') }}</label>
                                                                <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ old('birth_date', auth()->user()->birth_date ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="birth_place">{{ __('Lieu de naissance') }}</label>
                                                                <input type="text" class="form-control" id="birth_place" name="birth_place" value="{{ old('birth_place', auth()->user()->birth_place ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="marital_status">{{ __('État civil') }}</label>
                                                                <select class="form-control" id="marital_status" name="marital_status">
                                                                    <option value="">{{ __('Sélectionner') }}</option>
                                                                    <option value="single" {{ old('marital_status', auth()->user()->marital_status ?? '') == 'single' ? 'selected' : '' }}>
                                                                        {{ __('Célibataire') }}
                                                                    </option>
                                                                    <option value="married" {{ old('marital_status', auth()->user()->marital_status ?? '') == 'married' ? 'selected' : '' }}>
                                                                        {{ __('Marié(e)') }}
                                                                    </option>
                                                                    <option value="divorced" {{ old('marital_status', auth()->user()->marital_status ?? '') == 'divorced' ? 'selected' : '' }}>
                                                                        {{ __('Divorcé(e)') }}
                                                                    </option>
                                                                    <option value="widowed" {{ old('marital_status', auth()->user()->marital_status ?? '') == 'widowed' ? 'selected' : '' }}>
                                                                        {{ __('Veuf/Veuve') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="country">{{ __('Country') }}</label>
                                                                <select name="country" class="form-control select2-country" id="country">
                                                                    <option value=""></option>
                                                                    @foreach (countries() as $item)
                                                                        <option value="{{$item['code']}}" data-flag="{{ asset('img/flags/' . strtolower($item['code']) . '.svg') }}" @if (old('country', auth()->user()->country ?? 'TN') == $item['code']) selected @endif>
                                                                            {{$item['name_'.auth()->user()->lang]}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="nationality">{{ __('Nationalité') }}</label>
                                                                <select name="nationality" class="form-control select2-country" id="nationality">
                                                                    <option value=""></option>
                                                                    @foreach (nationalities() as $item)
                                                                        <option value="{{$item['code']}}" data-flag="{{ asset('img/flags/' . strtolower($item['code']) . '.svg') }}" @if (old('nationality', auth()->user()->nationality ?? 'TN') == $item['code']) selected @endif>
                                                                            {{$item['name_'.auth()->user()->lang]}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">{{ __('Adresse complète') }}</label>
                                                        <textarea class="form-control" id="address" name="address" rows="3">{!! old('address', auth()->user()->address ?? '') !!}</textarea>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="job_title">{{ __('Job Title') }}</label>
                                                                <input type="text" class="form-control" id="job_title" name="job_title" value="{{ old('job_title', auth()->user()->job_title ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_type">{{ __('Type de pièce d\'identité') }}</label>
                                                                <select class="form-control" id="id_type" name="id_type">
                                                                    <option value="">{{ __('Sélectionner') }}</option>
                                                                    <option value="cin" {{ old('id_type', auth()->user()->id_type ?? '') == 'cin' ? 'selected' : '' }}>
                                                                        {{ __('CIN') }}
                                                                    </option>
                                                                    <option value="passport" {{ old('id_type', auth()->user()->id_type ?? '') == 'passport' ? 'selected' : '' }}>
                                                                        {{ __('Passeport') }}
                                                                    </option>
                                                                    <option value="other" {{ old('id_type', auth()->user()->id_type ?? '') == 'other' ? 'selected' : '' }}>
                                                                        {{ __('Other') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 ">
                                                            <div class="form-group d-none" id="id_type_other_container">
                                                                <label for="id_type_other">{{ __("Pièce d'identité") }}</label>
                                                                <input type="text" class="form-control" id="id_type_other" name="id_type_other" value="{{ old('id_type_other', auth()->user()->id_type_other ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_number">{{ __('Numéro CIN / Passeport') }}</label>
                                                                <input type="text" class="form-control" id="id_number" name="id_number" value="{{ old('id_number', auth()->user()->id_number ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_issue_place">{{ __('Lieu de délivrance') }}</label>
                                                                <input type="text" class="form-control" id="id_issue_place" name="id_issue_place" value="{{ old('id_issue_place', auth()->user()->id_issue_place ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_issue_date">{{ __('Date de délivrance') }}</label>
                                                                <input type="date" class="form-control" id="id_issue_date" name="id_issue_date"  value="{{ old('id_issue_date', auth()->user()->id_issue_date ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_expiry_date">{{ __('Date d\'expiration') }}</label>
                                                                <input type="date" class="form-control" id="id_expiry_date" name="id_expiry_date" value="{{ old('id_expiry_date', auth()->user()->id_expiry_date ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        {{--<div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-username">{{ __('Name')}}</label>
                                                                    <input type="text" class="form-control form-control-lg" id="account-username" placeholder="{{ __('Name')}}" required name="name" value="{{Auth::user()->name}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-e-mail">{{ __('Email')}}</label>
                                                                    <input type="email" class="form-control form-control-lg" id="account-e-mail" placeholder="{{ __('Email')}}" required value="{{Auth::user()->email}}" name="email" >
                                                                </div>
                                                            </div>
                                                        </div>--}}
                                                        
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-success mr-sm-1 mb-1 mb-sm-0"> {{ __('Save')}} </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                                <form id="formUpdate3" autocomplete="off" enctype="multipart/form-data" method="POST" action="{{route('admin.profile.update3')}}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-old-password">{{ __('Current Password') }}</label>
                                                                    <fieldset class="form-group position-relative">
                                                                        <div class="input-group">
                                                                            <input type="password" class="form-control form-control-lg" id="user-current_password" name="current_password" required>
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text la la-eye" id="show-hide-current_password"></span>
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="user-current_password">{{ __('New Password') }}</label>
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
                                                        <div class="col-12">
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
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-success mr-sm-1 mb-1 mb-sm-0">{{ __('Save')}}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                                <form id="formUpdate2"  method="POST" action="{{route('admin.profile.update2')}}" autocomplete="off" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row align-items-center justify-content-center">
                                                        <div class="avatar-section">
                                                            <div class="avatar-container">
                                                                <img src="{{ auth()->user()->getAvatar() }}" alt="Avatar" class="avatar-preview" id="avatar-preview">
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
                                                        <div class="col-md-6">
                                                            <a href="{{route('admin.profile.update4')}}" class="btn btn-danger mr-sm-1 mb-1 mb-sm-0 delete-avatar">{{ __('Remove')}}</a>
                                                        </div>
                                                        <div class="col-md-6 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-success mr-sm-1 mb-1 mb-sm-0">{{ __('Save')}}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
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
            $("#show-hide-current_password").on('click', function() {
                $(this).toggleClass("la-eye la-eye-slash");
                var input = $("#user-current_password");
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const idTypeSelect = document.getElementById('id_type');
            const idTypeOtherContainer = document.getElementById('id_type_other_container');
            function toggleIdTypeOther() {
                if (idTypeSelect.value === 'other') {
                    idTypeOtherContainer.classList.remove('d-none');
                } else {
                    idTypeOtherContainer.classList.add('d-none');
                    document.getElementById('id_type_other').value = '';
                }
            }
            idTypeSelect.addEventListener('change', toggleIdTypeOther);
            toggleIdTypeOther();
        });
    </script>
    <script>
        $(document).ready(function() {
            ajaxForm('#formUpdate1');
            ajaxForm('#formUpdate3');
            ajaxForm('#formUpdate2');
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.delete-avatar').click(function(e) {
                if(!confirm("{{ __('Êtes-vous sûr de vouloir continuer ?')}}")) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush