@extends('layout.app')

@section('title', __('Profile'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")

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
                <section id="page-account-settings mb-5">
                    <div class="row">
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
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
                                                <form  autocomplete="off" method="POST" action="{{route('customer.profile.update1')}}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-e-mail">{{ __('Email')}}</label>
                                                                    <input type="email" class="form-control" id="account-e-mail" placeholder="{{ __('Email')}}" required value="{{Auth::user()->email}}" name="email" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label for="languageselect2">{{ __('Languages')}}</label>
                                                                <select class="form-control" id="languageselect2" name="lang">
                                                                    <option value="fr" @if (Auth::user()->lang == 'fr') selected @endif>{{ __('French')}}</option>
                                                                    <option value="en" @if (Auth::user()->lang == 'ar') selected @endif>{{ __('Arabic')}}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-md-6">
                                                            <label for="type">{{ __('Client Type') }} <span class="text-danger">*</span></label>
                                                            <select name="type" id="type" class="form-control" required>
                                                                <option value="particulier" {{ (isset($customer) && $customer->type == 'particulier') ? 'selected' : '' }}>{{ __('Individual') }}</option>
                                                                <option value="societe" {{ (isset($customer) && $customer->type == 'societe') ? 'selected' : '' }}>{{ __('Company') }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="civility">{{ __('Civility') }}</label>
                                                            <select name="civility" id="civility" class="form-control">
                                                                <option value="M" {{ (isset($customer) && $customer->civility == 'M') ? 'selected' : '' }}>M.</option>
                                                                <option value="Mme" {{ (isset($customer) && $customer->civility == 'Mme') ? 'selected' : '' }}>Mme</option>
                                                                <option value="Mlle" {{ (isset($customer) && $customer->civility == 'Mlle') ? 'selected' : '' }}>Mlle</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1" id="individual-fields" style="{{ (isset($customer) && $customer->type == 'societe') ? 'display: none;' : '' }}">
                                                        <div class="col-md-6">
                                                            <label for="full_name">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                                                            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ $customer->full_name ?? old('full_name') }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="birth_date">{{ __('Birth Date') }}</label>
                                                            <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ $customer->birth_date ?? old('birth_date') }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1" id="company-fields" style="{{ (!isset($customer) || (isset($customer) && $customer->type == 'particulier') ? 'display: none;' : '') }}">
                                                        <div class="col-md-6">
                                                            <label for="company_name">{{ __('Company Name') }} <span class="text-danger">*</span></label>
                                                            <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $customer->company_name ?? old('company_name') }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="contact_person">{{ __('Contact Person') }}</label>
                                                            <input type="text" name="contact_person" id="contact_person" class="form-control" value="{{ $customer->contact_person ?? old('contact_person') }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-md-6">
                                                            <label for="matricule_fiscal">{{ __('Tax Identification Number') }} <span class="text-danger">*</span></label>
                                                            <input type="text" name="matricule_fiscal" id="matricule_fiscal" class="form-control" value="{{ $customer->matricule_fiscal ?? old('matricule_fiscal') }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="cin">{{ __('CIN / Passport') }}</label>
                                                            <input type="text" name="cin" id="cin" class="form-control" value="{{ $customer->cin ?? old('cin') }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1" id="company-rc" style="{{ (!isset($customer) || (isset($customer) && $customer->type == 'particulier') ? 'display: none;' : '') }}">
                                                        <div class="col-md-6">
                                                            <label for="rc">{{ __('Commercial Register') }}</label>
                                                            <input type="text" name="rc" id="rc" class="form-control" value="{{ $customer->rc ?? old('rc') }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="sector">{{ __('Activity Sector') }}</label>
                                                            <input type="text" name="sector" id="sector" class="form-control" value="{{ $customer->sector ?? old('sector') }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-md-6">
                                                            <label for="address">{{ __('Address') }} <span class="text-danger">*</span></label>
                                                            <input type="text" name="address" id="address" class="form-control" value="{{ $customer->address ?? old('address') }}" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="city">{{ __('City') }} <span class="text-danger">*</span></label>
                                                            <input type="text" name="city" id="city" class="form-control" value="{{ $customer->city ?? old('city') }}" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="postal_code">{{ __('Postal Code') }}</label>
                                                            <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ $customer->postal_code ?? old('postal_code') }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-md-4">
                                                            <label for="phone">{{ __('Phone') }} <span class="text-danger">*</span></label>
                                                            <input type="text" name="phone" id="phone" class="form-control" value="{{ $customer->phone ?? old('phone') }}" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="mobile">{{ __('Mobile') }} <span class="text-danger">*</span></label>
                                                            <input type="text" name="mobile" id="mobile" class="form-control" value="{{ $customer->mobile ?? old('mobile') }}" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="contact_email">{{ __('Contact Email') }}</label>
                                                            <input type="email" name="contact_email" id="contact_email" class="form-control" value="{{ $customer->contact_email ?? old('contact_email') }}">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-1" id="company-contact" style="{{ (!isset($customer) || (isset($customer) && $customer->type == 'particulier') ? 'display: none;' : '') }}">
                                                        <div class="col-md-6">
                                                            <label for="contact_phone">{{ __('Contact Phone') }}</label>
                                                            <input type="text" name="contact_phone" id="contact_phone" class="form-control" value="{{ $customer->contact_phone ?? old('contact_phone') }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-dark mr-sm-1 mb-1 mb-sm-0"> {{ __('Save')}} </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                                <form autocomplete="off" enctype="multipart/form-data" method="POST" action="{{route('customer.profile.update3')}}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label for="account-old-password">{{ __('Current Password') }}</label>
                                                                    <fieldset class="form-group position-relative">
                                                                        <div class="input-group">
                                                                            <input type="password" class="form-control" id="user-current_password" name="current_password" required>
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
                                                                            <input type="password" class="form-control" id="user-password" name="password" required>
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
                                                                            <input type="password" class="form-control" id="user-password_confirmation" name="password_confirmation" required>
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text la la-eye" id="show-hide-password_confirmation"></span>
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-dark mr-sm-1 mb-1 mb-sm-0">{{ __('Save')}}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane fade" id="account-vertical-info" role="tabpanel" aria-labelledby="account-pill-info" aria-expanded="false">
                                                <form  method="POST" action="{{route('customer.profile.update2')}}" autocomplete="off" enctype="multipart/form-data" class="dropzone overflow-visible p-0" id="formDropzone" novalidate>
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="text-center mb-3">
                                                                <img id="avatar_image_preview" src="{{ asset('storage/users/' . auth()->user()->avatar) }}" class="border shadow-sm" width="150" height="150" alt="Picture">
                                                                <div class="mt-2">
                                                                    <label for="avatar" class="btn btn-outline-dark btn-sm">
                                                                        <i class="bi bi-upload"></i> {{ __("Changer l'image") }}
                                                                    </label>
                                                                    <input type="file" class="d-none" name="avatar" id="avatar" accept="image/*">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                            <button type="submit" class="btn btn-dark mr-sm-1 mb-1 mb-sm-0">{{ __('Save')}}</button>
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
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#type').change(function() {
            if ($(this).val() === 'societe') {
                $('#individual-fields').hide();
                $('#company-fields').show();
                $('#company-rc').show();
                $('#company-contact').show();
                
                // Make company fields required
                $('#company_name').prop('required', true);
            } else {
                $('#individual-fields').show();
                $('#company-fields').hide();
                $('#company-rc').hide();
                $('#company-contact').hide();
                
                // Remove required from company fields
                $('#company_name').prop('required', false);
            }
        });
    });
</script>
@endpush