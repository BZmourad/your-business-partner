@extends('layout.app')

@section('title', __('Customers'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_customers', "active")

@push('styles')
    @include('layout.partials.styles.nav')
@endpush

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
                                <li class="breadcrumb-item active">{{ isset($customer) ? __('Edit') : __('Add') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-warning">
                            <i class="la la-list"></i> {{ __("Customers")}}
                        </a>
                        <button type="submit" form="customerForm" class="btn btn-success">
                            <i class="fas fa-check"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="content-body pb-5">
                <section class="mb-5">
                    <form id="customerForm" method="POST" action="{{ isset($customer) ? route('admin.customers.update', $customer->id) : route('admin.customers.store') }}">
                        @csrf
                        @if(isset($customer))
                            @method('PUT')
                        @else
                            <div class="row skin skin-square mb-2">
                                <div class="col-md-12">
                                    <fieldset>
                                        <input type="checkbox" id="has_account" name="has_account" value="1">
                                        <label for="has_account">{{ __('Add user account to customer')}}</label>
                                    </fieldset>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs nav-justified bg-white shadow-sm">
                                    <li class="nav-item font-medium-3">
                                        <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active" aria-controls="active" aria-expanded="true">
                                            <i class="fas fa-info-circle"></i> {{ __('Informations') }}
                                        </a>
                                    </li>
                                    <li class="nav-item font-medium-3">
                                        <a class="nav-link" id="link-tab" data-toggle="tab" href="#link" aria-controls="link" aria-expanded="false">
                                            <i class="fas fa-id-card"></i> {{ __('Identité') }}
                                        </a>
                                    </li>
                                    <li class="nav-item font-medium-3">
                                        <a class="nav-link" id="linkcontacts-tab" data-toggle="tab" href="#linkcontacts" aria-controls="linkcontacts">
                                            <i class="fas fa-users"></i> {{ __('Contacts') }}
                                        </a>
                                    </li>
                                    <li class="nav-item font-medium-3">
                                        <a class="nav-link" id="linkOpt-tab" data-toggle="tab" href="#linkOpt" aria-controls="linkOpt">
                                            <i class="fas fa-briefcase"></i> {{ __('Professionnel') }}
                                        </a>
                                    </li>
                                    <li class="nav-item font-medium-3">
                                        <a class="nav-link" id="fiscal-tab" data-toggle="tab" href="#fiscal" aria-controls="fiscal">
                                            <i class="fas fa-chart-line"></i> {{ __('Fiscal') }}
                                        </a>
                                    </li>
                                    @if (!isset($customer))
                                        <li class="nav-item font-medium-3 tab-authentification d-none">
                                            <a class="nav-link" id="authentification-tab" data-toggle="tab" href="#authentification" aria-controls="authentification">
                                                <i class="fas fa-user-lock"></i> {{ __('Authentification') }}
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="tab-content pt-1">
                                    <div role="tabpanel" class="tab-pane active" id="active" aria-labelledby="active-tab" aria-expanded="true">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="customer_type">{{ __('Type de client') }} <span class="text-danger">*</span></label>
                                                                <select class="form-control" id="customer_type" name="customer_type" required>
                                                                    <option value=""></option>
                                                                    <option value="particulier" {{ old('customer_type', $customer->customer_type ?? '') == 'particulier' ? 'selected' : '' }}>
                                                                        {{ __('Particulier') }}
                                                                    </option>
                                                                    <option value="entreprise" {{ old('customer_type', $customer->customer_type ?? '') == 'entreprise' ? 'selected' : '' }}>
                                                                        {{ __('Entreprise') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="last_name">{{ __('Nom') }}  <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $customer->last_name ?? '') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="first_name">{{ __('Prénom') }} <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $customer->first_name ?? '') }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="email">{{ __('Email') }}  <span class="text-danger">*</span></label>
                                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $customer->email ?? '') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="phone">{{ __('Téléphone') }}</label>
                                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $customer->phone ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="fax">{{ __('Fax') }}</label>
                                                                <input type="text" class="form-control" id="fax" name="fax" value="{{ old('fax', $customer->fax ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="gender">{{ __('Gender') }}</label>
                                                                <select class="form-control" id="gender" name="gender">
                                                                    <option value="">{{ __('Sélectionner') }}</option>
                                                                    <option value="homme" {{ old('gender', $customer->gender ?? '') == 'homme' ? 'selected' : '' }}>
                                                                        {{ __('Masculin') }}
                                                                    </option>
                                                                    <option value="femme" {{ old('gender', $customer->gender ?? '') == 'femme' ? 'selected' : '' }}>
                                                                        {{ __('Féminin') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="birth_date">{{ __('Date de naissance') }}</label>
                                                                <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ old('birth_date', $customer->birth_date ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="marital_status">{{ __('État civil') }}</label>
                                                                <select class="form-control" id="marital_status" name="marital_status">
                                                                    <option value="">{{ __('Sélectionner') }}</option>
                                                                    <option value="single" {{ old('marital_status', $customer->marital_status ?? '') == 'single' ? 'selected' : '' }}>
                                                                        {{ __('Célibataire') }}
                                                                    </option>
                                                                    <option value="married" {{ old('marital_status', $customer->marital_status ?? '') == 'married' ? 'selected' : '' }}>
                                                                        {{ __('Marié(e)') }}
                                                                    </option>
                                                                    <option value="divorced" {{ old('marital_status', $customer->marital_status ?? '') == 'divorced' ? 'selected' : '' }}>
                                                                        {{ __('Divorcé(e)') }}
                                                                    </option>
                                                                    <option value="widowed" {{ old('marital_status', $customer->marital_status ?? '') == 'widowed' ? 'selected' : '' }}>
                                                                        {{ __('Veuf/Veuve') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="country">{{ __('Country') }}</label>
                                                                <select name="country" class="form-control select2-country" id="country">
                                                                    <option value=""></option>
                                                                    @foreach (countries() as $item)
                                                                        <option value="{{$item['code']}}" data-flag="{{ asset('img/flags/' . strtolower($item['code']) . '.svg') }}" @if (old('country', $customer->country ?? 'TN') == $item['code']) selected @endif>
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
                                                                        <option value="{{$item['code']}}" data-flag="{{ asset('img/flags/' . strtolower($item['code']) . '.svg') }}" @if (old('nationality', $customer->nationality ?? 'TN') == $item['code']) selected @endif>
                                                                            {{$item['name_'.auth()->user()->lang]}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="birth_place">{{ __('Lieu de naissance') }}</label>
                                                                <input type="text" class="form-control" id="birth_place" name="birth_place" value="{{ old('birth_place', $customer->birth_place ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">{{ __('Adresse complète') }}</label>
                                                        <textarea class="form-control" id="address" name="address" rows="3">{!! old('address', $customer->address ?? '') !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="link" role="tabpanel" aria-labelledby="link-tab" aria-expanded="false">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_type">{{ __('Type de pièce d\'identité') }}</label>
                                                                <select class="form-control" id="id_type" name="id_type">
                                                                    <option value="">{{ __('Sélectionner') }}</option>
                                                                    <option value="cin" {{ old('id_type', $customer->id_type ?? '') == 'cin' ? 'selected' : '' }}>
                                                                        {{ __('CIN') }}
                                                                    </option>
                                                                    <option value="passport" {{ old('id_type', $customer->id_type ?? '') == 'passport' ? 'selected' : '' }}>
                                                                        {{ __('Passeport') }}
                                                                    </option>
                                                                    <option value="other" {{ old('id_type', $customer->id_type ?? '') == 'other' ? 'selected' : '' }}>
                                                                        {{ __('Other') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 ">
                                                            <div class="form-group d-none" id="id_type_other_container">
                                                                <label for="id_type_other">{{ __("Pièce d'identité") }}</label>
                                                                <input type="text" class="form-control" id="id_type_other" name="id_type_other" value="{{ old('id_type_other', $customer->id_type_other ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_number">{{ __('Numéro CIN / Passeport') }}</label>
                                                                <input type="text" class="form-control" id="id_number" name="id_number" value="{{ old('id_number', $customer->id_number ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_issue_place">{{ __('Lieu de délivrance') }}</label>
                                                                <input type="text" class="form-control" id="id_issue_place" name="id_issue_place" value="{{ old('id_issue_place', $customer->id_issue_place ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_issue_date">{{ __('Date de délivrance') }}</label>
                                                                <input type="date" class="form-control" id="id_issue_date" name="id_issue_date"  value="{{ old('id_issue_date', $customer->id_issue_date ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_expiry_date">{{ __('Date d\'expiration') }}</label>
                                                                <input type="date" class="form-control" id="id_expiry_date" name="id_expiry_date" value="{{ old('id_expiry_date', $customer->id_expiry_date ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="linkcontacts" role="tabpanel" aria-labelledby="linkcontacts-tab" aria-expanded="false">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="repeater-default">
                                                        <div data-repeater-list="contacts">
                                                            @if(isset($customer) && $customer->contacts->count() > 0)
                                                                @foreach($customer->contacts as $contact)
                                                                    <div data-repeater-item>
                                                                        <div class="row">
                                                                            <div class="form-group col-md-3">
                                                                                <label>{{ __('Nom') }}</label>
                                                                                <input type="text" class="form-control" name="contacts[{{ $loop->index }}][name]" value="{{ old('contacts.'.$loop->index.'.name', $contact->name) }}">
                                                                            </div>
                                                                            <div class="form-group col-md-2">
                                                                                <label>{{ __('Email') }}</label>
                                                                                <input type="email" class="form-control" name="contacts[{{ $loop->index }}][email]" value="{{ old('contacts.'.$loop->index.'.email', $contact->email) }}">
                                                                            </div>
                                                                            <div class="form-group col-md-2">
                                                                                <label>{{ __('Phone') }} 1</label>
                                                                                <input type="text" class="form-control" name="contacts[{{ $loop->index }}][phone1]" value="{{ old('contacts.'.$loop->index.'.phone1', $contact->phone1) }}">
                                                                            </div>
                                                                            <div class="form-group col-md-2">
                                                                                <label>{{ __('Phone') }} 2</label>
                                                                                <input type="text" class="form-control" name="contacts[{{ $loop->index }}][phone2]" value="{{ old('contacts.'.$loop->index.'.phone2', $contact->phone2) }}">
                                                                            </div>
                                                                            <div class="form-group col-md-2">
                                                                                <label>{{ __('Whatsapp') }}</label>
                                                                                <input type="text" class="form-control" name="contacts[{{ $loop->index }}][whatsapp]" value="{{ old('contacts.'.$loop->index.'.whatsapp', $contact->whatsapp) }}">
                                                                            </div>
                                                                            <div class="form-group col-md-1 text-right">
                                                                                <button type="button" class="btn btn-danger mt-2" data-repeater-delete> <i class="ft-x"></i></button>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div data-repeater-item>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-3">
                                                                            <label>{{ __('Nom') }}</label>
                                                                            <input type="text" class="form-control" name="name">
                                                                        </div>
                                                                        <div class="form-group col-md-2">
                                                                            <label>{{ __('Email') }}</label>
                                                                            <input type="email" class="form-control" name="email">
                                                                        </div>
                                                                        <div class="form-group col-md-2">
                                                                            <label>{{ __('Phone') }} 1</label>
                                                                            <input type="text" class="form-control" name="phone1" >
                                                                        </div>
                                                                        <div class="form-group col-md-2">
                                                                            <label>{{ __('Phone') }} 2</label>
                                                                            <input type="text" class="form-control" name="phone2">
                                                                        </div>
                                                                        <div class="form-group col-md-2">
                                                                            <label>{{ __('Whatsapp') }}</label>
                                                                            <input type="text" class="form-control" name="whatsapp">
                                                                        </div>
                                                                        <div class="form-group col-md-1 text-right">
                                                                            <button type="button" class="btn btn-danger mt-2" data-repeater-delete> <i class="ft-x"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group overflow-hidden">
                                                            <div class="col-12">
                                                                <button type="button" data-repeater-create class="btn btn-primary">
                                                                    <i class="ft-plus"></i> {{ __('Ajouter un contact') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="linkOpt" role="tabpanel" aria-labelledby="linkOpt-tab" aria-expanded="false">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="profession">{{ __('Profession') }}</label>
                                                                <input type="text" class="form-control" id="profession" name="profession" value="{{ old('profession', $customer->profession ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="job_title">{{ __('Job Title') }}</label>
                                                                <input type="text" class="form-control" id="job_title" name="job_title" value="{{ old('job_title', $customer->job_title ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="employer">{{ __('Employeur') }}</label>
                                                                <input type="text" class="form-control" id="employer" name="employer" value="{{ old('employer', $customer->employer ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="work_phone">{{ __('Téléphone professionnel') }}</label>
                                                                <input type="text" class="form-control" id="work_phone" name="work_phone" value="{{ old('work_phone', $customer->work_phone ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="work_address">{{ __('Adresse professionnelle') }}</label>
                                                        <textarea class="form-control" id="work_address" name="work_address" rows="3">{{ old('work_address', $customer->work_address ?? '') }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="activity">{{ __('Activité') }}</label>
                                                        <input type="text" class="form-control" id="activity" name="activity" value="{{ old('activity', $customer->activity ?? '') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="fiscal" role="tabpanel" aria-labelledby="fiscal-tab" aria-expanded="false">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tax_id">{{ __('Matricule fiscal') }}</label>
                                                                <input type="text" class="form-control" id="tax_id" name="tax_id" 
                                                                    value="{{ old('tax_id', $customer->tax_id ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tax_regime">{{ __('Régime fiscal') }}</label>
                                                                <input type="text" class="form-control" id="tax_regime" name="tax_regime" 
                                                                    value="{{ old('tax_regime', $customer->tax_regime ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="commerce_register_number">{{ __('Numéro de registre de commerce') }}</label>
                                                                <input type="text" class="form-control" id="commerce_register_number" name="commerce_register_number" 
                                                                    value="{{ old('commerce_register_number', $customer->commerce_register_number ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="business_sector">{{ __('Secteur d\'activité') }}</label>
                                                                <input type="text" class="form-control" id="business_sector" name="business_sector" 
                                                                    value="{{ old('business_sector', $customer->business_sector ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if (!isset($customer))
                                        <div class="tab-pane tab-authentification d-none" id="authentification" role="tabpanel" aria-labelledby="authentification-tab" aria-expanded="false">
                                            <div class="card">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="row skin skin-square mb-2">
                                                            <div class="col-md-12">
                                                                <fieldset>
                                                                    <input type="checkbox" id="user_send_email" name="user_send_email" value="1">
                                                                    <label for="user_send_email">{{ __('Send access parameters by email')}}</label>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 position-relative mt-1">
                                                                <label for="password" class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control" id="password" name="user_password" placeholder="{{ __('Entrez votre mot de passe') }}">
                                                                    <button type="button" class="btn btn-outline-dark generate-password">
                                                                        <i class="fas fa-random"></i>
                                                                    </button>
                                                                    <button type="button" class="btn btn-outline-dark toggle-password" data-target="password">
                                                                        <i class="fas fa-eye"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 position-relative mt-1">
                                                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control" id="password_confirmation" name="user_password_confirm" placeholder="{{ __('Confirmez votre mot de passe') }}">
                                                                    <button type="button" class="btn btn-outline-dark toggle-password" data-target="password_confirmation">
                                                                        <i class="fas fa-eye"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row justify-content-md-center">
                                                                    <div class="col-lg-12 p-1 shadow-lg">
                                                                        <div class="validation-container container">
                                                                            <div class="progress" style="height: 10px;">
                                                                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                                            </div>
                                                                            <div>
                                                                                <div class="requirement" id="length-req">
                                                                                    <i class="fas fa-times-circle text-danger"></i> {{ __("Au moins 8 caractères")}}
                                                                                </div>
                                                                                <div class="requirement" id="lowercase-req">
                                                                                    <i class="fas fa-times-circle text-danger"></i> {{ __("Lettres minuscules")}}
                                                                                </div>
                                                                                <div class="requirement" id="uppercase-req">
                                                                                    <i class="fas fa-times-circle text-danger"></i> {{ __("Lettres majuscules")}}
                                                                                </div>
                                                                                <div class="requirement" id="number-req">
                                                                                    <i class="fas fa-times-circle text-danger"></i> {{ __("Au moins un chiffre")}}
                                                                                </div>
                                                                                <div class="requirement" id="confirm-req">
                                                                                    <i class="fas fa-times-circle text-danger"></i> {{ __("Confirmation du mot de passe")}}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('modern-admin/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ asset('js/generate-password.js') }}"></script>
    <script>
        $(document).ready(function() {
            ajaxForm('#customerForm');
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".toggle-password").click(function() {
                let target = $("#" + $(this).data("target"));
                let icon = $(this).find("i");

                if (target.attr("type") === "password") {
                    target.attr("type", "text");
                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    target.attr("type", "password");
                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var testBtn = false;
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirmation');
            const progressBar = document.querySelector('.progress-bar');
            const requirements = {
                length: document.getElementById('length-req'),
                lowercase: document.getElementById('lowercase-req'),
                uppercase: document.getElementById('uppercase-req'),
                number: document.getElementById('number-req'),
                confirm: document.getElementById('confirm-req')
            };
            
            // Fonction pour vérifier les exigences du mot de passe
            function checkPasswordRequirements(password) {
                const hasLength = password.length >= 8;
                const hasLowercase = /[a-z]/.test(password);
                const hasUppercase = /[A-Z]/.test(password);
                const hasNumber = /[0-9]/.test(password);
                
                return { hasLength, hasLowercase, hasUppercase, hasNumber };
            }
            
            // Fonction pour mettre à jour l'interface utilisateur
            function updateUI(requirementsMet) {
                // Mettre à jour les icônes et couleurs des exigences
                requirements.length.classList.toggle('valid', requirementsMet.hasLength);
                requirements.length.querySelector('i').className = requirementsMet.hasLength ? 
                    'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger';
                
                requirements.lowercase.classList.toggle('valid', requirementsMet.hasLowercase);
                requirements.lowercase.querySelector('i').className = requirementsMet.hasLowercase ? 
                    'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger';
                
                requirements.uppercase.classList.toggle('valid', requirementsMet.hasUppercase);
                requirements.uppercase.querySelector('i').className = requirementsMet.hasUppercase ? 
                    'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger';
                
                requirements.number.classList.toggle('valid', requirementsMet.hasNumber);
                requirements.number.querySelector('i').className = requirementsMet.hasNumber ? 
                    'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger';
                
                // Vérifier la confirmation
                const passwordsMatch = (passwordInput.value === confirmInput.value) && (passwordInput.value !== '');
               
                requirements.confirm.classList.toggle('valid', passwordsMatch);
                requirements.confirm.querySelector('i').className = passwordsMatch ? 
                    'fas fa-check-circle text-success' : 'fas fa-times-circle text-danger';
                
                // Calculer le pourcentage de complétion
                const totalRequirements = 5;
                let metRequirements = Object.values(requirementsMet).filter(Boolean).length;
                
                // Ajouter la confirmation si nécessaire
                if (passwordsMatch) metRequirements++;
                
                const completionPercentage = (metRequirements / totalRequirements) * 100;
                
                // Mettre à jour la barre de progression
                progressBar.style.width = `${completionPercentage}%`;
                
                // Changer la couleur en fonction de la force
                if (completionPercentage <= 20) {
                    progressBar.className = 'progress-bar bg-danger bg-darken-4';
                } else if (completionPercentage <= 40) {
                    progressBar.className = 'progress-bar bg-danger';
                } else if (completionPercentage <= 60){
                    progressBar.className = 'progress-bar bg-danger bg-lighten-1';
                }else if (completionPercentage <= 80){
                    progressBar.className = 'progress-bar bg-warning';
                }else {
                    testBtn = true;
                    progressBar.className = 'progress-bar bg-success';
                }
            }
            
            // Écouter les modifications du mot de passe
            passwordInput.addEventListener('input', function() {
                testBtn = false;
                const password = this.value;
                const requirementsMet = checkPasswordRequirements(password);
                updateUI(requirementsMet);
                
                // Vérifier la confirmation si le champ de confirmation n'est pas vide
                if (confirmInput.value !== '') {
                    checkPasswordMatch();
                }
            });
            
            document.querySelector(".generate-password").addEventListener("click", function () {
                let newPassword = generatePassword();
    
                // Définir le mot de passe et déclencher les événements
                passwordInput.value = newPassword;
                confirmInput.value = newPassword;
                
                // Déclencher manuellement l'événement input
                const event = new Event('input', { bubbles: true });
                passwordInput.dispatchEvent(event);
                const originalType = passwordInput.type;
                passwordInput.type = 'text';
                setTimeout(() => { passwordInput.type = originalType; }, 1000);
    
                // Déclencher manuellement l'événement input
                const event2 = new Event('input', { bubbles: true });
                confirmInput.dispatchEvent(event2);
                const originalType2 = confirmInput.type;
                confirmInput.type = 'text';
                setTimeout(() => { confirmInput.type = originalType2; }, 1000);
            });
    
            // Fonction pour vérifier si les mots de passe correspondent
            function checkPasswordMatch() {
                testBtn = false;
                // Mettre à jour l'UI pour refléter l'état de la confirmation
                const requirementsMet = checkPasswordRequirements(passwordInput.value);
                updateUI(requirementsMet);
            }
    
            confirmInput.addEventListener('input', checkPasswordMatch);
            
        });
    </script>
    @if (!isset($customer))
        <script>
            $(document).ready(function() {
                $(".skin-square input").iCheck({
                    checkboxClass: "icheckbox_square-green",
                    radioClass: "iradio_square-green"
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#has_account').on('ifChanged', function(event) {
                    var isChecked = $(this).is(':checked');
                    if (isChecked) {
                        $('.tab-authentification').removeClass('d-none');
                        $('.tab-authentification').find('#password').prop("required", true);
                        $('.tab-authentification').find('#password_confirmation').prop("required", true);
                    } else {
                        if ($('#authentification-tab').hasClass('active')) {
                            $('#active-tab').click();
                        }
                        $('.tab-authentification').addClass('d-none');
                        $('.tab-authentification').find('#password').removeAttr("required");
                        $('.tab-authentification').find('#password_confirmation').removeAttr("required");
                    }
                });
            });
        </script>
    @endif
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
            $('.repeater-default').repeater({
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    if(confirm("{{ __('Are you sure you want to remove this item?')}}")) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        });
    </script>
@endpush