@extends('layout.app')

@section('title', __('Partners'))
@section('data_col', "2-columns")
@section('body_class', "2-columns")
@section('active_partners', "active")

@push('styles')
    @include('layout.partials.styles.nav')
@endpush

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
                                <li class="breadcrumb-item active">{{ isset($partner) ? __('Edit') : __('Add') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right">
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-warning">
                            <i class="la la-list"></i> {{ __("Partners")}}
                        </a>
                        <button type="submit" form="partnerForm" class="btn btn-success">
                            <i class="fas fa-check"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="content-body pb-5">
                <section class="mb-5">
                    <form id="partnerForm" method="POST" action="{{ isset($partner) ? route('admin.partners.update', $partner->id) : route('admin.partners.store') }}">
                        @csrf
                        @if(isset($partner))
                            @method('PUT')
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
                                </ul>
                                <div class="tab-content pt-1">
                                    <div role="tabpanel" class="tab-pane active" id="active" aria-labelledby="active-tab" aria-expanded="true">
                                        <div class="card">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label for="partner_type">{{ __('Type de partner') }} <span class="text-danger">*</span></label>
                                                                <select class="form-control" id="partner_type" name="partner_type" required>
                                                                    <option value=""></option>
                                                                    <option value="particulier" {{ old('partner_type', $partner->partner_type ?? '') == 'particulier' ? 'selected' : '' }}>
                                                                        {{ __('Particulier') }}
                                                                    </option>
                                                                    <option value="entreprise" {{ old('partner_type', $partner->partner_type ?? '') == 'entreprise' ? 'selected' : '' }}>
                                                                        {{ __('Entreprise') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="last_name">{{ __('Nom') }}  <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $partner->last_name ?? '') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="first_name">{{ __('Prénom') }} <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $partner->first_name ?? '') }}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="email">{{ __('Email') }}  <span class="text-danger">*</span></label>
                                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $partner->email ?? '') }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="phone">{{ __('Téléphone') }}</label>
                                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $partner->phone ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="fax">{{ __('Fax') }}</label>
                                                                <input type="text" class="form-control" id="fax" name="fax" value="{{ old('fax', $partner->fax ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="gender">{{ __('Gender') }}</label>
                                                                <select class="form-control" id="gender" name="gender">
                                                                    <option value="">{{ __('Sélectionner') }}</option>
                                                                    <option value="homme" {{ old('gender', $partner->gender ?? '') == 'homme' ? 'selected' : '' }}>
                                                                        {{ __('Masculin') }}
                                                                    </option>
                                                                    <option value="femme" {{ old('gender', $partner->gender ?? '') == 'femme' ? 'selected' : '' }}>
                                                                        {{ __('Féminin') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="birth_date">{{ __('Date de naissance') }}</label>
                                                                <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ old('birth_date', $partner->birth_date ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="marital_status">{{ __('État civil') }}</label>
                                                                <select class="form-control" id="marital_status" name="marital_status">
                                                                    <option value="">{{ __('Sélectionner') }}</option>
                                                                    <option value="single" {{ old('marital_status', $partner->marital_status ?? '') == 'single' ? 'selected' : '' }}>
                                                                        {{ __('Célibataire') }}
                                                                    </option>
                                                                    <option value="married" {{ old('marital_status', $partner->marital_status ?? '') == 'married' ? 'selected' : '' }}>
                                                                        {{ __('Marié(e)') }}
                                                                    </option>
                                                                    <option value="divorced" {{ old('marital_status', $partner->marital_status ?? '') == 'divorced' ? 'selected' : '' }}>
                                                                        {{ __('Divorcé(e)') }}
                                                                    </option>
                                                                    <option value="widowed" {{ old('marital_status', $partner->marital_status ?? '') == 'widowed' ? 'selected' : '' }}>
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
                                                                        <option value="{{$item['code']}}" data-flag="{{ asset('img/flags/' . strtolower($item['code']) . '.svg') }}" @if (old('country', $partner->country ?? 'TN') == $item['code']) selected @endif>
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
                                                                        <option value="{{$item['code']}}" data-flag="{{ asset('img/flags/' . strtolower($item['code']) . '.svg') }}" @if (old('nationality', $partner->nationality ?? 'TN') == $item['code']) selected @endif>
                                                                            {{$item['name_'.auth()->user()->lang]}}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="birth_place">{{ __('Lieu de naissance') }}</label>
                                                                <input type="text" class="form-control" id="birth_place" name="birth_place" value="{{ old('birth_place', $partner->birth_place ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address">{{ __('Adresse complète') }}</label>
                                                        <textarea class="form-control" id="address" name="address" rows="3">{!! old('address', $partner->address ?? '') !!}</textarea>
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
                                                                    <option value="cin" {{ old('id_type', $partner->id_type ?? '') == 'cin' ? 'selected' : '' }}>
                                                                        {{ __('CIN') }}
                                                                    </option>
                                                                    <option value="passport" {{ old('id_type', $partner->id_type ?? '') == 'passport' ? 'selected' : '' }}>
                                                                        {{ __('Passeport') }}
                                                                    </option>
                                                                    <option value="other" {{ old('id_type', $partner->id_type ?? '') == 'other' ? 'selected' : '' }}>
                                                                        {{ __('Other') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 ">
                                                            <div class="form-group d-none" id="id_type_other_container">
                                                                <label for="id_type_other">{{ __("Pièce d'identité") }}</label>
                                                                <input type="text" class="form-control" id="id_type_other" name="id_type_other" value="{{ old('id_type_other', $partner->id_type_other ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_number">{{ __('Numéro CIN / Passeport') }}</label>
                                                                <input type="text" class="form-control" id="id_number" name="id_number" value="{{ old('id_number', $partner->id_number ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_issue_place">{{ __('Lieu de délivrance') }}</label>
                                                                <input type="text" class="form-control" id="id_issue_place" name="id_issue_place" value="{{ old('id_issue_place', $partner->id_issue_place ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_issue_date">{{ __('Date de délivrance') }}</label>
                                                                <input type="date" class="form-control" id="id_issue_date" name="id_issue_date"  value="{{ old('id_issue_date', $partner->id_issue_date ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="id_expiry_date">{{ __('Date d\'expiration') }}</label>
                                                                <input type="date" class="form-control" id="id_expiry_date" name="id_expiry_date" value="{{ old('id_expiry_date', $partner->id_expiry_date ?? '') }}">
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
                                                            @if(isset($partner) && $partner->contacts->count() > 0)
                                                                @foreach($partner->contacts as $contact)
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
                                                                <input type="text" class="form-control" id="profession" name="profession" value="{{ old('profession', $partner->profession ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="job_title">{{ __('Job Title') }}</label>
                                                                <input type="text" class="form-control" id="job_title" name="job_title" value="{{ old('job_title', $partner->job_title ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="employer">{{ __('Employeur') }}</label>
                                                                <input type="text" class="form-control" id="employer" name="employer" value="{{ old('employer', $partner->employer ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="work_phone">{{ __('Téléphone professionnel') }}</label>
                                                                <input type="text" class="form-control" id="work_phone" name="work_phone" value="{{ old('work_phone', $partner->work_phone ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="work_address">{{ __('Adresse professionnelle') }}</label>
                                                        <textarea class="form-control" id="work_address" name="work_address" rows="3">{{ old('work_address', $partner->work_address ?? '') }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="activity">{{ __('Activité') }}</label>
                                                        <input type="text" class="form-control" id="activity" name="activity" value="{{ old('activity', $partner->activity ?? '') }}">
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
                                                                    value="{{ old('tax_id', $partner->tax_id ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="tax_regime">{{ __('Régime fiscal') }}</label>
                                                                <input type="text" class="form-control" id="tax_regime" name="tax_regime" 
                                                                    value="{{ old('tax_regime', $partner->tax_regime ?? '') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="commerce_register_number">{{ __('Numéro de registre de commerce') }}</label>
                                                                <input type="text" class="form-control" id="commerce_register_number" name="commerce_register_number" 
                                                                    value="{{ old('commerce_register_number', $partner->commerce_register_number ?? '') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="business_sector">{{ __('Secteur d\'activité') }}</label>
                                                                <input type="text" class="form-control" id="business_sector" name="business_sector" 
                                                                    value="{{ old('business_sector', $partner->business_sector ?? '') }}">
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
                    </form>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('modern-admin/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            ajaxForm('#partnerForm');
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